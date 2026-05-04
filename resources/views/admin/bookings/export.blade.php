<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>In Vé Khách Hàng - Đơn #{{ $booking->id }}}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #fff;
            color: #000;
            margin: 0;
            padding: 20px;
        }} .ticket-wrapper {
            max-width: 800px;
            margin: 0 auto;
            border: 2px dashed #ccc;
            padding: 20px;
        }} .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }} .header h1 { margin: 0; font-size: 24px; text-transform: uppercase; }} .header p { margin: 5px 0 0; font-size: 14px; }} .row { display: flex; justify-content: space-between; margin-bottom: 10px; }} .col { flex: 1; }} .label { font-weight: bold; color: #555; font-size: 13px; text-transform: uppercase; }} .value { font-size: 16px; font-weight: bold; margin-top: 2px; }} table { width: 100%; border-collapse: collapse; margin-top: 20px; }} th, td { border: 1px solid #000; padding: 10px; text-align: left; }} th { background-color: #f5f5f5; text-transform: uppercase; font-size: 13px;}} .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }} .text-right { text-align: right; }} .text-center { text-align: center; }} @media print {
            body { padding: 0; }} .ticket-wrapper { border: none; }} button.print-btn { display: none; }}}</style>
</head>
<body>
    <div style="text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()" class="print-btn" style="padding: 10px 20px; cursor: pointer; font-size: 16px;">
            🖨️ Tiến hành in vé
        </button>
    </div>

    <div class="ticket-wrapper">
        <div class="header">
            <h1>VÉ ĐIỆN TỬ / E-TICKET</h1>
            <p>Hệ thống Đặt Vé Xe Khách Chuyên Nghiệp</p>
            <p><strong>Mã đơn hàng: #{{ $booking->id }}}</strong> | Ngày đặt: {{ $booking->created_at->format('d/m/Y H:i') }}}</p>
        </div>

        <div class="row">
            <div class="col">
                <div class="label">Khách hàng</div>
                <div class="value">{{ $booking->contact_name }}}</div>
            </div>
            <div class="col">
                <div class="label">{{{ __('phone') }}</div>
                <div class="value">{{ $booking->contact_phone }}}</div>
            </div>
            <div class="col">
                <div class="label">{{{ __('status') }} thanh toán</div>
                <div class="value">{{ strtoupper($booking->status) }}}</div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="label">{{{ __('routes') }}</div>
                <div class="value">{{ $booking->trip->route->startLocation->name ?? 'N/A' }}} ➔ {{ $booking->trip->route->endLocation->name ?? 'N/A' }}}</div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="label">{{{ __('date') }/Giờ xuất phát</div>
                <div class="value">{{ \Carbon\Carbon::parse($booking->trip->trip_date)->format('d/m/Y') }}} - {{ \Carbon\Carbon::parse($booking->trip->departure_time)->format('H:i') }}}</div>
            </div>
            <div class="col">
                <div class="label">Biển số xe / SĐT Xe</div>
                <div class="value">{{ $booking->trip->vehicle->license_plate ?? 'N/A' }}} / {{ $booking->trip->vehicle->phone_vehicles ?? 'N/A' }}}</div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="label">{{{ __('pickup_points') }}</div>
                <div class="value">{{ $booking->pickupPoint->name ?? ' Tại bến' }}} ({{ $booking->pickupPoint->address ?? '' }})</div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Vé</th>
                    <th class="text-center">Số Ghế</th>
                    <th class="text-right">Giá Tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($booking->tickets as $index => $ticket)
                <tr>
                    <td>{{ $index + 1 }}}</td>
                    <td><strong>{{ $ticket->ticket_code }}}</strong></td>
                    <td class="text-center"><strong>{{ $ticket->seat->seat_number }}}</strong></td>
                    <td class="text-right">{{ number_format($ticket->trip->price) }}} VNĐ</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right"><strong>TỔNG TIỀN (BAO GỒM GIẢM GIÁ NẾU CÓ):</strong></td>
                    <td class="text-right"><strong>{{ number_format($booking->total_amount) }}} VNĐ</strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="footer">
            <p>Vui lòng có mặt tại điểm đón trước 30 phút để sắp xếp hành lý. Xin cảm ơn quý khách!</p>
            <p><i>Phần mềm quản lý bán vé xe - Printed at {{ now()->format('d/m/Y H:i:s') }}}</i></p>
        </div>
    </div>
    
    <script>
        window.onload = function() {
            // Uncomment to auto print
            // window.print();
        }}</script>
</body>
</html>
