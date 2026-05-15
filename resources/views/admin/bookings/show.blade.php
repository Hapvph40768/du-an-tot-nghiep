@extends('layout.admin')

@section('title', 'Chi tiết Đặt vé')

@section('content-main')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Chi tiết đặt vé #{{ $booking->id }}</h1>
            <div>
                <a href="{{ route('admin.bookings.export', $booking->id) }}" target="_blank"
                    class="btn btn-info btn-sm text-white md-2">
                    <i class="fas fa-print"></i> In vé
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Quay lại danh sách
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Thông tin chung</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Khách hàng</h5>
                                <p><strong>Họ tên:</strong> {{ $booking->user->name ?? 'Khách vãng lai' }}</p>
                                <p><strong>{{ __('email') }}:</strong> {{ $booking->user->email ?? 'N/A' }}</p>
                                <p><strong>Số điện thoại:</strong> {{ $booking->user->phone ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Thông tin chuyến đi</h5>
                                <p><strong>Tuyến:</strong>
                                    {{ $booking->trip->route->startLocation->name }}<i
                                        class="fas fa-long-arrow-alt-right"></i>
                                    {{ $booking->trip->route->endLocation->name }}</p>
                                <p><strong>Khởi hành:</strong>
                                    {{ \Carbon\Carbon::parse($booking->trip->departure_time)->format('H:i d/m/Y') }}</p>
                                <p><strong>Số điện thoại xe:</strong> <a
                                        href="tel:{{ $booking->trip->vehicle->phone_vehicles ?? '' }}"
                                        class="text-primary">{{ $booking->trip->vehicle->phone_vehicles ?? 'Chưa có' }}</a>
                                </p>
                                <div class="mb-2">
                                    <strong>Điểm đón:</strong>
                                    <div class="ps-2 border-start border-primary ms-1 mt-1">
                                        <span class="text-dark font-weight-bold">{{ $booking->pickupPoint->name ?? 'Tại văn phòng' }}</span><br>
                                        <small class="text-muted">{{ $booking->pickupPoint->address ?? '' }}</small>
                                    </div>
                                </div>
                                <div>
                                    <strong>Điểm trả khách:</strong>
                                    <div class="ps-2 border-start border-success ms-1 mt-1">
                                        <span class="text-dark font-weight-bold">{{ $booking->dropoffPoint->name ?? 'Tại văn phòng' }}</span><br>
                                        <small class="text-muted">{{ $booking->dropoffPoint->address ?? '' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h5>Danh sách vé / Chỗ ngồi</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mã vé</th>
                                        <th>Mã QR</th>
                                        <th>Giá vé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($booking->tickets as $ticket)
                                        <tr>
                                            <td class="align-middle font-weight-bold text-primary">{{ $ticket->ticket_code }}
                                            </td>
                                            <td class="align-middle">
                                                <div class="bg-white p-1 d-inline-block border rounded">
                                                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(50)->generate($ticket->ticket_code) !!}
                                                </div>
                                            </td>
                                            <td class="align-middle">{{ number_format($ticket->trip->price) }}đ</td>
                                    </tr>@endforeach
                                </tbody>
                                <tfoot>
                                    @php
                                        $baseTotal = ($booking->trip->price * max(1, $booking->tickets->count())) - $booking->discount_amount;
                                        $diff = $booking->total_amount - $baseTotal;
                                        
                                        $penaltyFee = 0;
                                        if ($diff != 0) {
                                            $oldBooking = \App\Models\Booking::where('user_id', $booking->user_id)
                                                ->where('status', 'cancelled')
                                                ->where('penalty_fee', '>', 0)
                                                ->where('updated_at', '<=', $booking->created_at)
                                                ->orderBy('updated_at', 'desc')
                                                ->first();
                                                
                                            if ($oldBooking) {
                                                $penaltyFee = $oldBooking->penalty_fee;
                                            } else {
                                                $oldAmountEstimate = ($baseTotal - $booking->total_amount) / 0.9;
                                                $penaltyFee = $oldAmountEstimate * 0.1;
                                            }
                                        }
                                        $grossTotal = $baseTotal + $penaltyFee;
                                    @endphp

                                    <tr>
                                        <th colspan="2" class="text-end">Tổng tiền vé:</th>
                                        <th>{{ number_format($baseTotal) }}đ</th>
                                    </tr>
                                    
                                    @if($booking->discount_amount > 0)
                                    <tr>
                                        <th colspan="2" class="text-end">Giảm giá:</th>
                                        <th class="text-success">-{{ number_format($booking->discount_amount) }}đ</th>
                                    </tr>
                                    @endif

                                    @if($penaltyFee > 0)
                                    <tr>
                                        <th colspan="2" class="text-end">Phụ phí đổi vé (10%):</th>
                                        <th class="text-danger">+{{ number_format($penaltyFee) }}đ</th>
                                    </tr>
                                    @endif

                                    <tr>
                                        <th colspan="2" class="text-end h5 mb-0 text-primary">Tổng tiền:</th>
                                        <th class="text-danger h5 mb-0">{{ number_format($grossTotal) }}đ</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Chính sách Đổi / Hủy cho Admin -->
                        <div class="alert alert-info mt-4 mb-0">
                            <h6 class="font-weight-bold mb-2"><i class="fas fa-info-circle me-1"></i> Chính sách Đổi / Hủy vé (Lưu ý khách hàng)</h6>
                            <ul class="mb-0 small ps-3">
                                <li><strong>Hủy vé:</strong> Chỉ cho phép trước giờ khởi hành <strong>4 tiếng</strong>. Hủy sau 30 phút từ lúc đặt thu phí 10%.</li>
                                <li><strong>Đổi vé:</strong> Chỉ cho phép trước giờ khởi hành <strong>2 tiếng</strong>. Thu phụ phí 10% giá vé hiện tại.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('status') }} & Thanh toán</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">{{ __('status') }} hiện tại:</label>
                            <br>
                            @if($booking->status == 'pending')
                                <span class="badge bg-warning text-dark">Chờ thanh toán</span>
                            @elseif($booking->status == 'paid')
                                <span class="badge bg-success text-white">Đã thanh toán</span>
                            @else
                                <span class="badge bg-danger text-white">Đã hủy</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Phương thức thanh toán:</label>
                            <p>{{ strtoupper($booking->payment->payment_method ?? 'Chưa xác định') }}</p>
                        </div>

                        <hr>

                        @if($booking->status === 'pending')
                            <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="status" class="form-label font-weight-bold">{{ __('update') }} trạng
                                        thái:</label>
                                    <select name="status" id="status" class="form-select form-control">
                                        <option value="pending" selected>Chờ thanh toán</option>
                                        <option value="paid">Đã thanh toán</option>
                                        <option value="cancelled">{{ __('cancel') }} đơn hàng</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">{{ __('update') }} đơn hàng</button>
                            </form>
                        @else
                            <div class="alert alert-secondary mt-3 mb-0 text-center" role="alert">
                                <i class="fas fa-lock me-2"></i> Đơn hàng đã
                                <strong>{{ $booking->status == 'paid' ? 'Thanh toán' : 'Hủy' }}</strong>.
                                <br><small>Không thể chỉnh sửa trạng thái nữa.</small>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('vehicles') }} & Lái xe</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Biển số xe:</label>
                            <p>{{ $booking->trip->vehicle->license_plate ?? 'N/A' }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Lái xe:</label>
                            <p>{{ $booking->trip->driver->name ?? 'N/A' }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Số điện thoại lái xe:</label>
                            <p><a href="tel:{{ $booking->trip->driver->phone ?? '' }}"
                                    class="text-primary font-weight-bold">{{ $booking->trip->driver->phone ?? 'N/A' }}</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="small text-muted">Ngày đặt: {{ $booking->created_at->format('d/m/Y H:i:s') }}</p>
                        <p class="small text-muted">Cập nhật cuối: {{ $booking->updated_at->format('d/m/Y H:i:s') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection