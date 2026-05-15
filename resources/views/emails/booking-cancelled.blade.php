<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo hủy vé - Mạnh Hùng Transport</title>
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

        {{-- CANCEL BADGE --}}
        <div style="background-color: #fef2f2; border-bottom: 1px solid #fecaca; padding: 24px 30px; text-align: center;">
            <div style="width: 60px; height: 60px; background-color: #ef4444; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <span style="color: white; font-size: 28px;">✕</span>
            </div>
            <h2 style="color: #b91c1c; margin: 0 0 6px; font-size: 20px; font-weight: 700;">Vé đã được hủy</h2>
            <p style="color: #4b5563; margin: 0; font-size: 14px;">Yêu cầu hủy vé của bạn đã được xử lý thành công.</p>
        </div>

        {{-- BOOKING INFO --}}
        <div style="padding: 30px;">
            <h3 style="color: #1f2937; font-size: 15px; font-weight: 700; margin: 0 0 16px; text-transform: uppercase; letter-spacing: 0.5px; border-left: 4px solid #ef4444; padding-left: 12px;">
                Thông tin vé đã hủy
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
                @if($booking->trip)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Tuyến đường</td>
                    <td style="padding: 10px 0; color: #111827; font-weight: 600;">
                        {{ $booking->trip->route->startLocation->name ?? '—' }} → {{ $booking->trip->route->endLocation->name ?? '—' }}
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Ngày khởi hành</td>
                    <td style="padding: 10px 0; color: #111827;">{{ \Carbon\Carbon::parse($booking->trip->trip_date)->format('d/m/Y') }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Giờ khởi hành</td>
                    <td style="padding: 10px 0; color: #111827; font-weight: 600;">{{ substr($booking->trip->departure_time, 0, 5) }}</td>
                </tr>
                @endif
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Số vé hủy</td>
                    <td style="padding: 10px 0; color: #111827;">{{ $booking->tickets->count() }} vé</td>
                </tr>
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Tổng tiền vé</td>
                    <td style="padding: 10px 0; color: #111827;">{{ number_format($booking->total_amount, 0, ',', '.') }}đ</td>
                </tr>
                @if($booking->penalty_fee > 0)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 10px 0; color: #6b7280;">Phí hủy vé (10%)</td>
                    <td style="padding: 10px 0; color: #ef4444; font-weight: 600;">- {{ number_format($booking->penalty_fee, 0, ',', '.') }}đ</td>
                </tr>
                @endif
                <tr>
                    <td style="padding: 14px 0 0; color: #374151; font-size: 15px; font-weight: 700;">Số tiền hoàn lại</td>
                    <td style="padding: 14px 0 0; color: #22c55e; font-size: 20px; font-weight: 800;">{{ number_format($booking->refund_amount ?? 0, 0, ',', '.') }}đ</td>
                </tr>
            </table>
        </div>

        {{-- REFUND NOTE --}}
        @if(($booking->refund_amount ?? 0) > 0)
        <div style="margin: 0 30px 24px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 16px 20px;">
            <p style="color: #166534; font-size: 13px; margin: 0; line-height: 1.7;">
                💰 <strong>Thông tin hoàn tiền:</strong> Số tiền <strong>{{ number_format($booking->refund_amount, 0, ',', '.') }}đ</strong> 
                sẽ được hoàn lại vào phương thức thanh toán ban đầu của bạn trong vòng <strong>3–5 ngày làm việc</strong>.
            </p>
        </div>
        @endif

        {{-- NOTE --}}
        <div style="margin: 0 30px 30px; background: #fffbeb; border: 1px solid #fcd34d; border-radius: 12px; padding: 16px 20px;">
            <p style="color: #92400e; font-size: 13px; margin: 0; line-height: 1.7;">
                ⚠️ Nếu bạn <strong>không thực hiện yêu cầu hủy vé này</strong>, vui lòng liên hệ ngay với nhà xe để được hỗ trợ.
            </p>
        </div>

        {{-- FOOTER --}}
        <div style="background-color: #f9fafb; padding: 20px 30px; border-top: 1px solid #f3f4f6; text-align: center;">
            <p style="color: #9ca3af; font-size: 12px; margin: 0;">&copy; {{ date('Y') }} Mạnh Hùng Transport. All rights reserved.</p>
            <p style="color: #d1d5db; font-size: 11px; margin: 6px 0 0;">Email này được gửi tự động, vui lòng không trả lời.</p>
        </div>
    </div>
</body>
</html>
