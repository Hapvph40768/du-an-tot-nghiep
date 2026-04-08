<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ticket;
use App\Models\StaffLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckInController extends Controller
{
    public function index(Request $request)
    {
        // 1. Lọc danh sách các Tuyến (Route) có chuyến sắp chạy
        $routesQuery = \App\Models\Trip::with(['route.startLocation', 'route.endLocation'])
            ->whereDate('trip_date', '>=', now()->toDateString())
            ->whereDate('trip_date', '<=', now()->addDay()->toDateString());
        
        $routes = $routesQuery->get()
            ->pluck('route')
            ->unique('id');

        $selectedRoute = null;
        $trips = collect();
        $tickets = collect();

        // 2. Nếu đã chọn Tuyến -> Lấy danh sách các chuyến xe của tuyến đó
        if ($request->filled('route_id')) {
            $selectedRoute = \App\Models\Route::with(['startLocation', 'endLocation'])->find($request->route_id);
            
            $trips = \App\Models\Trip::with(['vehicle', 'driver'])
                ->where('route_id', $request->route_id)
                ->whereDate('trip_date', '>=', now()->toDateString())
                ->whereDate('trip_date', '<=', now()->addDay()->toDateString())
                ->orderBy('trip_date', 'asc')
                ->orderBy('departure_time', 'asc')
                ->get();
            
            // Phân loại chuyến xe theo thời gian (Logic vận hành)
            $trips->map(function($trip) {
                $now = now();
                $tripDateTime = \Carbon\Carbon::parse($trip->trip_date . ' ' . $trip->departure_time);
                $diffInMinutes = $now->diffInMinutes($tripDateTime, false);

                if ($diffInMinutes < -60) {
                    $trip->operational_status = 'departed'; // Đã khởi hành quá 1 tiếng
                } elseif ($diffInMinutes <= 30 && $diffInMinutes >= -60) {
                    $trip->operational_status = 'departing'; // Đang khởi hành (Trong vòng 30p tới hoặc mới chạy)
                } elseif ($diffInMinutes > 30 && $diffInMinutes <= 120) {
                    $trip->operational_status = 'ready'; // Chuẩn bị khởi hành (Trong vòng 2 tiếng)
                } else {
                    $trip->operational_status = 'upcoming'; // Sắp khởi hành (Còn lâu mới chạy)
                }
                return $trip;
            });
        }

        // 3. Nếu đã chọn Chuyến xe (hoặc Tìm kiếm trực tiếp) -> Lấy danh sách vé
        if ($request->filled('trip_id') || $request->filled('search')) {
            $query = Ticket::with(['booking.user', 'trip.route', 'seat']);

            if ($request->filled('trip_id')) {
                $query->where('trip_id', $request->trip_id);
            }

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('ticket_code', 'LIKE', "%{$search}%")
                      ->orWhereHas('booking', function($qb) use ($search) {
                          $qb->where('contact_phone', 'LIKE', "%{$search}%")
                             ->orWhere('contact_name', 'LIKE', "%{$search}%");
                      });
                });
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $tickets = $query->orderBy('status', 'asc')->paginate(100)->withQueryString();
        }

        return view('staff.checkin.index', compact('routes', 'trips', 'tickets', 'selectedRoute'));
    }

    public function process($id)
    {
        return DB::transaction(function () use ($id) {
            $ticket = Ticket::lockForUpdate()->find($id);
            if (!$ticket) return back()->with('error', 'Không tìm thấy vé.');

            if ($ticket->status === 'used') {
                return back()->with('error', 'Vé này đã được sử dụng.');
            }

            if ($ticket->status === 'no_show') {
                return back()->with('error', 'Vé này đã bị đánh dấu Không đến.');
            }

            if ($ticket->booking->status !== 'paid') {
                return back()->with('warning', 'Đơn hàng này chưa được thanh toán. Hãy xác nhận thanh toán trước khi check-in.');
            }

            $ticket->update(['status' => 'used']);

            StaffLog::create([
                'user_id' => Auth::id(),
                'action' => 'check_in',
                'model_type' => Ticket::class,
                'model_id' => $ticket->id,
                'description' => "Check-in cho khách hàng: {$ticket->booking->contact_name} (Vé: {$ticket->ticket_code})",
                'ip_address' => request()->ip(),
            ]);

            return back()->with('success', 'Check-in thành công! Chúc hành khách chuyến đi tốt đẹp.');
        });
    }

    public function noShow($id)
    {
        return DB::transaction(function () use ($id) {
            $ticket = Ticket::lockForUpdate()->find($id);
            if (!$ticket) return back()->with('error', 'Không tìm thấy vé.');

            if ($ticket->status === 'used') {
                return back()->with('error', 'Khách đã lên xe, không thể hủy bỏ.');
            }

            $ticket->update(['status' => 'no_show']);

            StaffLog::create([
                'user_id' => Auth::id(),
                'action' => 'mark_no_show',
                'model_type' => Ticket::class,
                'model_id' => $ticket->id,
                'description' => "Đánh dấu Không đến chuyến cho khách hàng: {$ticket->booking->contact_name} (Vé: {$ticket->ticket_code})",
                'ip_address' => request()->ip(),
            ]);

            return back()->with('success', 'Đã lưu trạng thái: Khách không đến.');
        });
    }

    public function resetStatus($id)
    {
        return DB::transaction(function () use ($id) {
            $ticket = Ticket::lockForUpdate()->find($id);
            if (!$ticket) return back()->with('error', 'Không tìm thấy vé.');

            $oldStatus = $ticket->status;
            $ticket->update(['status' => 'pending']);

            StaffLog::create([
                'user_id' => Auth::id(),
                'action' => 'reset_checkin',
                'model_type' => Ticket::class,
                'model_id' => $ticket->id,
                'description' => "Hoàn tác trạng thái vé {$ticket->ticket_code} (Từ {$oldStatus} về Chờ điểm danh)",
                'ip_address' => request()->ip(),
            ]);

            return back()->with('success', 'Đã hoàn tác trạng thái vé về Chờ điểm danh.');
        });
    }
}
