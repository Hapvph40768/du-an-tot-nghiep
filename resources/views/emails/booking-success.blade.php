<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt vé thành công - Mạnh Hùng Transport</title>
</head>
<body style="font-family: 'Segoe UI', Arial, sans-serif; background-color: #f0f4f8; margin: 0; padding: 40px 0;">
    <div style="max-width: 620px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
        
        {{-- HEADER --}}
        <div style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%); padding: 30px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0 0 4px; font-size: 26px; font-weight: 800; letter-spacing: -0.5px;">
                Mạnh <span style="color: #f97316;">Hùng</span>
            </h1>
            <p style="color: rgba(255,255,255,0.6); font-size: 11px; text-transform: uppercase; letter-spacing: 3px; margin: 0;">Transport</p>
        </div>

        {{-- SUCCESS BADGE --}}
        <div style="background-color: #f0fdf4; border-bottom: 1px solid #d1fae5; padding: 24px 30px; text-align: center;">
            <div style="width: 60px; height: 60px; background-color: #22c55e; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <span style="color: white; font-size: 28px;">✓</span>
            </div>
            <h2 style="color: #15803d; margin: 0 0 6px; font-size: 20px; font-weight: 700;">Đặt vé thành công!</h2>
            <p style="color: #4b5563; margin: 0; font-size: 14px;">Cảm ơn bạn đã tin tưởng sử dụng dịch vụ của chúng tôi.</p>
        </div>

        {{-- BOOKING INFO --}}
        <div style="padding: 30px;">
            <h3 style="color: #1f2937; font-size: 15px; font-weight: 700; margin: 0 0 16px; text-transform: uppercase; letter-spacing: 0.5px; border-left: 4px solid #f97316; padding-left: 12px;">
                Thông tin đơn đặt vé
            </h3>

            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280; width: 45%;">Mã đơn</td>
                    <td style="padding: 10px 0; color: #111827; font-weight: 700; font-family: monospace; font-size: 15px;">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Hành khách</td>
                    <td style="padding: 10px 0; color: #111827; font-weight: 600;">{{ $booking->contact_name }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Điện thoại</td>
                    <td style="padding: 10px 0; color: #111827;">{{ $booking->contact_phone }}</td>
                </tr>
                @if($booking->trip)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Tuyến đường</td>
                    <td style="padding: 10px 0; color: #111827; font-weight: 600;">
                        {{ $booking->trip->route->startLocation->name ?? '—' }} → {{ $booking->trip->route->endLocation->name ?? '—' }}
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Ngày khởi hành</td>
                    <td style="padding: 10px 0; color: #111827;">
                        {{ \Carbon\Carbon::parse($booking->trip->trip_date)->format('d/m/Y') }}
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Giờ khởi hành</td>
                    <td style="padding: 10px 0; color: #111827; font-weight: 600;">{{ substr($booking->trip->departure_time, 0, 5) }}</td>
                </tr>
                @endif
                @if($booking->pickupPoint)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280; vertical-align: top;">Điểm đón</td>
                    <td style="padding: 10px 0; color: #111827;">
                        <strong>{{ $booking->pickupPoint->name }}</strong>
                        <div style="font-size: 12px; color: #6b7280; margin-top: 2px; line-height: 1.4;">{{ $booking->pickupPoint->address }}</div>
                    </td>
                </tr>
                @endif
                @if($booking->dropoffPoint)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280; vertical-align: top;">Điểm trả</td>
                    <td style="padding: 10px 0; color: #111827;">
                        <strong>{{ $booking->dropoffPoint->name }}</strong>
                        <div style="font-size: 12px; color: #6b7280; margin-top: 2px; line-height: 1.4;">{{ $booking->dropoffPoint->address }}</div>
                    </td>
                </tr>
                @endif
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Số vé</td>
                    <td style="padding: 10px 0; color: #111827;">{{ $booking->tickets->count() }} vé</td>
                </tr>
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

                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Giá vé</td>
                    <td style="padding: 10px 0; color: #111827;">{{ number_format($booking->trip->price, 0, ',', '.') }}đ x {{ max(1, $booking->tickets->count()) }}</td>
                </tr>

                @if($booking->discount_amount > 0)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Giảm giá</td>
                    <td style="padding: 10px 0; color: #22c55e;">- {{ number_format($booking->discount_amount, 0, ',', '.') }}đ</td>
                </tr>
                @endif

                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Tổng tiền vé</td>
                    <td style="padding: 10px 0; color: #111827; font-weight: bold;">{{ number_format($baseTotal, 0, ',', '.') }}đ</td>
                </tr>

                @if($penaltyFee > 0)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Phụ phí đổi vé (10%)</td>
                    <td style="padding: 10px 0; color: #ef4444; font-weight: bold;">+{{ number_format($penaltyFee, 0, ',', '.') }}đ</td>
                </tr>
                @endif

                <tr>
                    <td style="padding: 14px 0 0; color: #6b7280; font-size: 15px; font-weight: 600;">Tổng tiền</td>
                    <td style="padding: 14px 0 0; color: #f97316; font-size: 20px; font-weight: 800;">{{ number_format($grossTotal, 0, ',', '.') }}đ</td>
                </tr>
            </table>
        </div>

        {{-- TICKETS & CONTACT INFO --}}
        @if($booking->tickets->count() > 0)
        <div style="margin: 0 30px 30px; background: #f8fafc; border-radius: 12px; padding: 16px 20px;">
            <p style="color: #374151; font-weight: 700; margin: 0 0 10px; font-size: 14px;">🎫 Mã QR / Vé điện tử:</p>
            <div style="margin-bottom: 15px; text-align: center;">
                @foreach($booking->tickets as $ticket)
                <div style="display: inline-block; background-color: #ffffff; border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px; margin: 0 8px 10px 0; text-align: center;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ urlencode($ticket->ticket_code) }}" alt="QR Code {{ $ticket->ticket_code }}" style="display: block; margin: 0 auto; width: 100px; height: 100px;">
                    <span style="display: block; margin-top: 8px; color: #1e1b4b; font-weight: 700; font-size: 13px; letter-spacing: 1px; background-color: #f1f5f9; padding: 4px; border-radius: 4px;">
                        {{ $ticket->ticket_code }}
                    </span>
                </div>
                @endforeach
            </div>
            <p style="color: #374151; font-weight: 700; margin: 0 0 10px; font-size: 14px; border-top: 1px dashed #cbd5e1; padding-top: 15px;">📞 Thông tin liên hệ xe:</p>
            <p style="margin: 0; font-size: 14px; color: #4b5563; line-height: 1.6;">
                Biển số xe: <strong>{{ $booking->trip->vehicle->license_plate ?? 'Đang cập nhật' }}</strong><br>
                Tài xế / Phụ xe: <strong>{{ $booking->trip->driver->name ?? 'Đang cập nhật' }}</strong><br>
                SĐT Tài xế: <strong>{{ $booking->trip->driver->phone ?? '1900 6868 (Hotline)' }}</strong>
            </p>
        </div>
        @endif

        {{-- NOTE --}}
        <div style="margin: 0 30px 30px; background: #fffbeb; border: 1px solid #fcd34d; border-radius: 12px; padding: 16px 20px;">
            <p style="color: #92400e; font-size: 13px; margin: 0 0 10px; line-height: 1.7;">
                ⚠️ <strong>Lưu ý chung:</strong> Vui lòng có mặt tại điểm đón trước giờ khởi hành ít nhất <strong>15 phút</strong>. 
                Nếu cần hỗ trợ, vui lòng liên hệ nhà xe để được giải đáp.
            </p>
            <div style="border-top: 1px dashed #fcd34d; padding-top: 10px; margin-top: 10px;">
                <p style="color: #92400e; font-size: 13px; margin: 0 0 4px; font-weight: bold;">Chính sách Đổi / Hủy vé:</p>
                <ul style="color: #92400e; font-size: 12px; margin: 0; padding-left: 20px; line-height: 1.6;">
                    <li><strong>Hủy vé:</strong> Phải thực hiện trước giờ khởi hành <strong>4 tiếng</strong>. Hủy sau 30 phút từ lúc đặt sẽ chịu phí 10%.</li>
                    <li><strong>Đổi vé:</strong> Phải thực hiện trước giờ khởi hành <strong>2 tiếng</strong>. Phụ phí đổi chuyến là 10% giá vé cũ.</li>
                </ul>
            </div>
        </div>

        {{-- FOOTER --}}
        <div style="background-color: #f9fafb; padding: 20px 30px; border-top: 1px solid #f3f4f6; text-align: center;">
            <p style="color: #9ca3af; font-size: 12px; margin: 0;">&copy; {{ date('Y') }} Mạnh Hùng Transport. All rights reserved.</p>
            <p style="color: #d1d5db; font-size: 11px; margin: 6px 0 0;">Email này được gửi tự động, vui lòng không trả lời.</p>
        </div>
    </div>
</body>
</html>
