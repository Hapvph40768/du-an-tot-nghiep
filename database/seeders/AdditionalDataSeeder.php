<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Promotion;
use App\Models\PriceRule;
use App\Models\Parcel;
use App\Models\Review;
use App\Models\Notification;
use App\Models\ActivityLog;
use App\Models\StaffLog;
use App\Models\DailyReport;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\Route;
use App\Models\Trip;
use App\Models\User;

class AdditionalDataSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate tables to avoid duplicate key errors
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('promotions')->truncate();
        DB::table('price_rules')->truncate();
        DB::table('parcels')->truncate();
        DB::table('reviews')->truncate();
        DB::table('notifications')->truncate();
        DB::table('activity_logs')->truncate();
        DB::table('staff_logs')->truncate();
        DB::table('daily_reports')->truncate();
        DB::table('support_tickets')->truncate();
        DB::table('support_messages')->truncate();
        DB::table('transactions')->truncate();
        DB::table('orders')->truncate();
        DB::table('schedules')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $routeModels = Route::all();
        $tripModels = Trip::whereIn('status', ['active', 'completed'])->take(30)->get();
        $allCustomers = User::where('role', 'customer')->get();
        $admin = User::where('role', 'admin')->first();
        $staff = User::where('role', 'staff')->first();

        // 1. Promotions
        $promotionsData = [
            ['code' => 'KHACHMOI20', 'type' => 'percent', 'value' => 20, 'start_date' => now()->subDays(10), 'end_date' => now()->addDays(20), 'max_uses' => 100],
            ['code' => 'WEEKEND15', 'type' => 'percent', 'value' => 15, 'start_date' => now()->subDays(5), 'end_date' => now()->addDays(30), 'max_uses' => 50],
            ['code' => 'SUMMER25', 'type' => 'percent', 'value' => 25, 'start_date' => now()->addDays(10), 'end_date' => now()->addDays(60), 'max_uses' => 200],
            ['code' => 'LOYALTY10', 'type' => 'percent', 'value' => 10, 'start_date' => now()->subDays(30), 'end_date' => now()->addDays(90), 'max_uses' => 500],
        ];
        foreach ($promotionsData as $p) {
            Promotion::create([
                'code' => $p['code'], 'type' => $p['type'],
                'value' => $p['value'], 'start_date' => $p['start_date'],
                'end_date' => $p['end_date'], 'max_uses' => $p['max_uses']
            ]);
        }

        // 2. Price Rules
        $priceRulesData = [
            ['name' => 'Weekend Surcharge', 'start_date' => now()->subDays(30), 'end_date' => now()->addDays(60), 'type' => 'percentage', 'value' => 15],
            ['name' => 'Friday Discount', 'start_date' => now()->subDays(10), 'end_date' => now()->addDays(30), 'type' => 'percentage', 'value' => 10],
            ['name' => 'Summer Promotion', 'start_date' => now()->addDays(10), 'end_date' => now()->addDays(90), 'type' => 'fixed', 'value' => 50000],
        ];
        foreach ($priceRulesData as $rule) {
            \App\Models\PriceRule::create([
                'name' => $rule['name'],
                'start_date' => $rule['start_date'],
                'end_date' => $rule['end_date'],
                'type' => $rule['type'],
                'value' => $rule['value'],
            ]);
        }

        // 3. Parcels
        $parcelSenders = [
            ['name' => 'Trần Văn Bình', 'phone' => '0981111222', 'addr' => '123 Hoàn Kiếm, Hà Nội'],
            ['name' => 'Nguyễn Thị Cẩm', 'phone' => '0972222333', 'addr' => '456 Lê Lợi, TP.HCM'],
            ['name' => 'Lê Văn Dũng', 'phone' => '0963333444', 'addr' => '789 Hùng Vương, Đà Nẵng'],
        ];
        $parcelStatuses = ['pending', 'shipping', 'completed', 'cancelled'];
        for ($i = 0; $i < 15; $i++) {
            $route = $routeModels[array_rand($routeModels->toArray())];
            $sender = $parcelSenders[array_rand($parcelSenders)];
            $receiverNames = ['Phạm Thị Em', 'Hoàng Văn Phong', 'Vũ Đức Quân'];
            $receiverAddrs = ['456 Nguyễn Huệ, TP.HCM', '789 Trần Phú, Hà Nội', '123 Lạc Long Quân, Đà Lạt'];
            Parcel::create([S
                'sender_name' => $sender['name'], 'sender_phone' => $sender['phone'],
                'sender_address' => $sender['addr'],
                'receiver_name' => $receiverNames[rand(0, 2)],
                'receiver_phone' => '09' . rand(10000000, 99999999),
                'receiver_address' => $receiverAddrs[rand(0, 2)],
                'route_id' => $route->id, 'weight' => rand(1, 50),
                'price' => rand(30000, 200000),
                'description' => ['Tài liệu quan trọng', 'Quần áo, đồ dùng cá nhân', 'Đặc sản vùng miền'][rand(0, 2)],
                'status' => $parcelStatuses[array_rand($parcelStatuses)],
                'created_at' => now()->subDays(rand(0, 14)), 'updated_at' => now()
            ]);
        }

        // 4. Reviews
        $reviewsData = [
            ['rating' => 5, 'comment' => 'Tài xế lái xe rất an toàn, xe sạch sẽ thoáng mát!'],
            ['rating' => 4, 'comment' => 'Chuyến đi tốt, chỉ hơi trễ giờ khởi hành một chút.'],
            ['rating' => 5, 'comment' => 'Nhân viên phục vụ nhiệt tình, xe đời mới rất tiện nghi.'],
            ['rating' => 3, 'comment' => 'Xe hơi cũ, nhưng tài xế lái an toàn.'],
            ['rating' => 5, 'comment' => 'Tuyệt vời! Chuyến đi suôn sẻ, đúng giờ.'],
            ['rating' => 4, 'comment' => 'Giá cả hợp lý, chất lượng dịch vụ tốt.'],
            ['rating' => 5, 'comment' => 'Đã đi nhiều lần, lần nào cũng hài lòng.'],
        ];
        $allBookings = \App\Models\Booking::all();
        $usedPairs = [];
        for ($i = 0; $i < 20; $i++) {
            if ($allBookings->isEmpty() || $allCustomers->isEmpty()) break;
            $booking = $allBookings[array_rand($allBookings->toArray())];
            $customer = $allCustomers[array_rand($allCustomers->toArray())];
            $key = $booking->id . '-' . $customer->id;
            if (isset($usedPairs[$key])) continue;
            $usedPairs[$key] = true;
            $review = $reviewsData[array_rand($reviewsData)];
            Review::create([
                'user_id' => $customer->id, 'booking_id' => $booking->id,
                'rating' => $review['rating'], 'comment' => $review['comment'],
                'created_at' => now()->subDays(rand(0, 10))
            ]);
        }

        // 5. Notifications
        $notifTypes = ['booking_confirmed', 'payment_success', 'trip_reminder', 'promotion', 'system'];
        foreach ($allCustomers as $customer) {
            for ($i = 0; $i < rand(2, 5); $i++) {
                $type = $notifTypes[array_rand($notifTypes)];
                $titles = [
                    'booking_confirmed' => 'Xác nhận đặt vé',
                    'payment_success' => 'Thanh toán thành công',
                    'trip_reminder' => 'Nhắc nhở chuyến đi sắp tới',
                    'promotion' => 'Khuyến mãi hấp dẫn',
                    'system' => 'Thông báo hệ thống'
                ];
                Notification::create([
                    'user_id' => $customer->id,
                    'title' => $titles[$type],
                    'content' => 'Chi tiết thông báo cho khách hàng ' . $customer->name,
                    'type' => $type,
                    'is_read' => rand(0, 1),
                    'created_at' => now()->subDays(rand(0, 7))
                ]);
            }
        }

        // 6. Activity Logs
        $activities = [
            ['action' => 'login', 'description' => 'Đăng nhập hệ thống'],
            ['action' => 'create_booking', 'description' => 'Tạo đơn đặt vé mới'],
            ['action' => 'update_trip', 'description' => 'Cập nhật thông tin chuyến đi'],
            ['action' => 'export_report', 'description' => 'Xuất báo cáo doanh thu'],
        ];
        if ($admin) {
            for ($i = 0; $i < 20; $i++) {
                $activity = $activities[array_rand($activities)];
                ActivityLog::create([
                    'user_id' => $admin->id,
                    'action' => $activity['action'],
                    'description' => $activity['description'],
                    'ip_address' => '127.0.0.' . rand(1, 100),
                    'created_at' => now()->subDays(rand(0, 14))
                ]);
            }
        }

        // 7. Staff Logs
        if ($staff) {
            for ($i = 0; $i < 15; $i++) {
                $actions = ['checkin', 'checkout', 'booking_confirm'];
                StaffLog::create([
                    'user_id' => $staff->id,
                    'action' => $actions[array_rand($actions)],
                    'model_type' => [App\Models\Booking::class, App\Models\Trip::class][array_rand([App\Models\Booking::class, App\Models\Trip::class])],
                    'model_id' => rand(1, 10),
                    'description' => 'Nhật ký làm việc ngày ' . now()->subDays(rand(0, 7))->format('d/m/Y'),
                    'created_at' => now()->subDays(rand(0, 7))
                ]);
            }
        }

        // 8. Daily Reports
        for ($i = 0; $i < 10; $i++) {
            $date = now()->subDays($i);
            DailyReport::create([
                'date' => $date,
                'total_trips' => rand(10, 30),
                'total_bookings' => rand(20, 80),
                'total_revenue' => rand(5000000, 50000000),
                'note' => 'Báo cáo ngày ' . $date->format('d/m/Y'),
                'created_at' => $date
            ]);
        }

        // 9. Support Tickets
        $ticketStatuses = ['open', 'processing', 'closed'];
        $subjects = ['Không nhận được vé sau khi thanh toán', 'Xe đến trễ 30 phút', 'Yêu cầu hoàn tiền', 'Tài xế thái độ không tốt', 'Đổi giờ khởi hành'];
        for ($i = 0; $i < 10; $i++) {
            if ($allCustomers->isEmpty()) break;
            $customer = $allCustomers[array_rand($allCustomers->toArray())];
            $ticket = SupportTicket::create([
                'user_id' => $customer->id,
                'subject' => $subjects[array_rand($subjects)],
                'status' => $ticketStatuses[array_rand($ticketStatuses)],
                'created_at' => now()->subDays(rand(0, 10))
            ]);
            // Messages
            SupportMessage::create([
                'support_ticket_id' => $ticket->id,
                'sender_id' => $customer->id,
                'sender_type' => 'user',
                'message' => 'Tôi gặp sự cố: ' . $ticket->subject,
                'created_at' => $ticket->created_at
            ]);
            if (rand(0, 1)) {
                SupportMessage::create([
                    'support_ticket_id' => $ticket->id,
                    'sender_id' => $admin->id ?? null,
                    'sender_type' => 'admin',
                    'message' => 'Chúng tôi đã tiếp nhận và đang xử lý...',
                    'created_at' => $ticket->created_at->addHours(2)
                ]);
            }
        }

        // 10. More Transactions
        $transTypes = ['booking_payment', 'refund', 'topup'];
        for ($i = 0; $i < 30; $i++) {
            if ($allCustomers->isEmpty()) break;
            $customer = $allCustomers[array_rand($allCustomers->toArray())];
            Transaction::create([
                'user_id' => $customer->id,
                'amount' => rand(100000, 2000000),
                'type' => $transTypes[array_rand($transTypes)],
                'status' => ['success', 'pending', 'failed'][array_rand(['success', 'pending', 'failed'])],
                'payment_method' => ['vnpay', 'momo', 'cash'][array_rand(['vnpay', 'momo', 'cash'])],
                'created_at' => now()->subDays(rand(0, 14))
            ]);
        }

        // 11. Orders
        for ($i = 0; $i < 10; $i++) {
            if ($allCustomers->isEmpty()) break;
            $customer = $allCustomers[array_rand($allCustomers->toArray())];
            Order::create([
                'user_id' => $customer->id,
                'order_code' => 'ORD-' . now()->format('Y') . '-' . strtoupper(substr(md5(uniqid()),0,8)),
                'total_amount' => rand(500000, 5000000),
                'status' => ['pending', 'paid', 'cancelled', 'waiting_verify'][array_rand(['pending', 'paid', 'cancelled', 'waiting_verify'])],
                'payment_method' => ['vnpay', 'momo', 'cash'][array_rand(['vnpay', 'momo', 'cash'])],
                'created_at' => now()->subDays(rand(0, 10))
            ]);
        }

        // 12. Schedules
        $times = ['06:00:00', '08:00:00', '14:00:00', '20:00:00'];
        foreach ($routeModels as $r) {
            foreach ($times as $time) {
                Schedule::create([
                    'route_id' => $r->id,
                    'departure_time' => $time,
                    'days_of_week' => json_encode(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']),
                    'is_active' => true
                ]);
            }
        }
    }
}
