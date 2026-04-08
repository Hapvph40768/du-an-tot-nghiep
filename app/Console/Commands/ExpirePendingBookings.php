<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\SeatLock;
use App\Models\Ticket;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExpirePendingBookings extends Command
{
    /**
     * Lệnh: Tự động hủy đơn đặt vé quá 15 phút chưa thanh toán.
     */
    protected $signature = 'bookings:expire-pending';

    protected $description = 'Hủy các đơn đặt vé đang chờ thanh toán quá 15 phút và giải phóng ghế bị khóa.';

    public function handle()
    {
        $expiredBookings = Booking::where('status', 'pending')
            ->where('created_at', '<=', Carbon::now()->subMinutes(15))
            ->with(['tickets', 'seatLocks'])
            ->get();

        if ($expiredBookings->isEmpty()) {
            $this->info('Không có đơn nào cần hủy.');
            return Command::SUCCESS;
        }

        $count = 0;

        foreach ($expiredBookings as $booking) {
            DB::beginTransaction();
            try {
                // 1. Hủy vé
                Ticket::where('booking_id', $booking->id)
                    ->where('status', 'pending')
                    ->update(['status' => 'cancelled']);

                // 2. Xóa seat locks để trả lại ghế
                SeatLock::where('booking_id', $booking->id)->delete();

                // 3. Hoàn lượt dùng mã khuyến mãi nếu có
                if ($booking->promotion_id) {
                    Promotion::where('id', $booking->promotion_id)
                             ->where('current_uses', '>', 0)
                             ->decrement('current_uses');
                }

                // 4. Cập nhật trạng thái booking
                $booking->update(['status' => 'cancelled']);

                DB::commit();
                $count++;

                $this->line("  ✔ Đã hủy booking #{$booking->id} - {$booking->contact_name} ({$booking->created_at})");

            } catch (\Exception $e) {
                DB::rollBack();
                $this->error("  ✘ Lỗi hủy booking #{$booking->id}: " . $e->getMessage());
            }
        }

        $this->info("Hoàn tất: Đã hủy {$count} đơn đặt vé quá hạn và trả lại ghế.");
        return Command::SUCCESS;
    }
}
