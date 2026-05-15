<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>In Vé - Đơn #{{ $booking->id }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            margin: 0;
            padding: 40px 20px;
        }

        .ticket-wrapper {
            max-width: 700px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            position: relative;
        }

        .ticket-header {
            background: #1e1b4b;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }

        .ticket-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .ticket-header p {
            margin: 8px 0 0;
            color: #cbd5e1;
            font-size: 14px;
        }

        .ticket-body {
            padding: 30px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-item {
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .info-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
        }

        .ticket-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e1b4b;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .tickets-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        .qr-ticket {
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            background: #ffffff;
            width: 140px;
        }

        .qr-img {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .qr-code {
            font-family: monospace;
            font-weight: 800;
            font-size: 14px;
            color: #1e1b4b;
            background: #f1f5f9;
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-block;
        }

        table.pricing-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.pricing-table th, table.pricing-table td {
            padding: 12px;
            text-align: right;
            border-bottom: 1px solid #e2e8f0;
        }

        table.pricing-table th:first-child, table.pricing-table td:first-child {
            text-align: left;
        }

        .text-danger { color: #ef4444; }
        .text-success { color: #22c55e; }
        .font-bold { font-weight: 700; }
        .total-row td {
            font-size: 18px;
            font-weight: 800;
            color: #f97316;
            border-bottom: none;
            padding-top: 15px;
        }

        .footer {
            background: #fffbeb;
            border-top: 1px dashed #fcd34d;
            padding: 20px 30px;
            text-align: center;
        }

        .footer p {
            margin: 0 0 5px;
            font-size: 13px;
            color: #92400e;
            font-weight: 600;
        }
        
        .footer small {
            color: #b45309;
            font-size: 11px;
        }

        .print-btn-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .print-btn {
            background: #f97316;
            color: #ffffff;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgba(249, 115, 22, 0.3);
            transition: transform 0.2s;
        }

        .print-btn:hover {
            transform: translateY(-2px);
        }

        @media print {
            @page { size: A5 landscape; margin: 5mm; }
            body { background: #fff; padding: 0; font-size: 11px; }
            .ticket-wrapper { box-shadow: none; border: 2px solid #000; margin: 0 auto; max-width: 100%; border-radius: 0; page-break-inside: avoid; }
            .ticket-header { padding: 10px; }
            .ticket-header h1 { font-size: 20px; }
            .ticket-header p { font-size: 11px; margin-top: 4px; }
            .ticket-body { padding: 15px; }
            .info-grid { gap: 8px; margin-bottom: 15px; }
            .info-item { padding: 8px; border: 1px solid #000; background: transparent; }
            .info-label { font-size: 10px; margin-bottom: 2px; }
            .info-value { font-size: 12px; }
            .ticket-section { margin-bottom: 15px; }
            .section-title { padding-bottom: 4px; margin-bottom: 8px; font-size: 13px; border-bottom: 1px solid #000; }
            .qr-ticket { padding: 8px; width: 100px; border: 1px solid #000; }
            .qr-img { width: 70px; height: 70px; margin-bottom: 5px; }
            .qr-code { font-size: 11px; padding: 2px 4px; }
            table.pricing-table th, table.pricing-table td { padding: 6px; border-bottom: 1px dashed #ccc; }
            .total-row td { font-size: 14px; padding-top: 8px; }
            .footer { padding: 10px; background: transparent; border-top: 1px solid #000; }
            .print-btn-container { display: none; }
        }
    </style>
</head>
<body>

    <div class="print-btn-container">
        <button onclick="window.print()" class="print-btn">🖨️ IN VÉ NGAY</button>
    </div>

    <div class="ticket-wrapper">
        <div class="ticket-header">
            <h1>VÉ ĐIỆN TỬ</h1>
            <p>Mã đơn: <strong>#{{ $booking->id }}</strong> • Ngày đặt: {{ $booking->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="ticket-body">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Khách hàng</div>
                    <div class="info-value">{{ $booking->contact_name }} ({{ $booking->contact_phone }})</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Trạng thái</div>
                    <div class="info-value" style="color: {{ $booking->status == 'paid' ? '#22c55e' : '#f59e0b' }}">
                        {{ strtoupper($booking->status == 'paid' ? 'Đã thanh toán' : ($booking->status == 'pending' ? 'Chờ thanh toán' : 'Đã hủy')) }}
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tuyến đường</div>
                    <div class="info-value">{{ $booking->trip->route->startLocation->name ?? 'N/A' }} ➔ {{ $booking->trip->route->endLocation->name ?? 'N/A' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Khởi hành</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($booking->trip->departure_time)->format('H:i') }} • {{ \Carbon\Carbon::parse($booking->trip->trip_date)->format('d/m/Y') }}</div>
                </div>
                <div class="info-item" style="grid-column: span 2;">
                    <div class="info-label">Điểm đón</div>
                    <div class="info-value">
                        <strong>{{ $booking->pickupPoint->name ?? 'Tại bến' }}</strong>
                        <span style="font-size: 0.9em; color: #64748b; font-weight: normal; margin-left: 5px;">({{ $booking->pickupPoint->address ?? 'Không có địa chỉ chi tiết' }})</span>
                    </div>
                </div>
                <div class="info-item" style="grid-column: span 2;">
                    <div class="info-label">Điểm trả</div>
                    <div class="info-value">
                        <strong>{{ $booking->dropoffPoint->name ?? 'Tại bến' }}</strong>
                        <span style="font-size: 0.9em; color: #64748b; font-weight: normal; margin-left: 5px;">({{ $booking->dropoffPoint->address ?? 'Không có địa chỉ chi tiết' }})</span>
                    </div>
                </div>
                <div class="info-item" style="grid-column: span 2;">
                    <div class="info-label">Thông tin xe</div>
                    <div class="info-value">Biển số: {{ $booking->trip->vehicle->license_plate ?? 'N/A' }} • Tài xế: {{ $booking->trip->driver->name ?? 'N/A' }} ({{ $booking->trip->driver->phone ?? 'N/A' }})</div>
                </div>
            </div>

            <div class="ticket-section">
                <div class="section-title">Mã QR Check-in</div>
                <div class="tickets-list">
                    @foreach($booking->tickets as $ticket)
                    <div class="qr-ticket">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($ticket->ticket_code) }}" alt="QR" class="qr-img">
                        <div class="qr-code">{{ $ticket->ticket_code }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="ticket-section">
                <div class="section-title">Chi tiết thanh toán</div>
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
                <table class="pricing-table">
                    <tr>
                        <td>Giá vé ({{ number_format($booking->trip->price) }}đ x {{ max(1, $booking->tickets->count()) }})</td>
                        <td class="font-bold">{{ number_format($booking->trip->price * max(1, $booking->tickets->count())) }}đ</td>
                    </tr>
                    @if($booking->discount_amount > 0)
                    <tr>
                        <td>Giảm giá</td>
                        <td class="text-success font-bold">-{{ number_format($booking->discount_amount) }}đ</td>
                    </tr>
                    @endif
                    <tr>
                        <td>Tổng tiền vé</td>
                        <td class="font-bold">{{ number_format($baseTotal) }}đ</td>
                    </tr>
                    @if($penaltyFee > 0)
                    <tr>
                        <td>Phụ phí đổi vé (10%)</td>
                        <td class="text-danger font-bold">+{{ number_format($penaltyFee) }}đ</td>
                    </tr>
                    @endif
                    <tr class="total-row">
                        <td>TỔNG CỘNG</td>
                        <td>{{ number_format($grossTotal) }}đ</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="footer">
            <p>⚠️ Vui lòng có mặt tại điểm đón trước 15-30 phút để nhà xe sắp xếp chỗ ngồi.</p>
            <small>Hệ thống Quản lý Vé Xe Khách • In lúc {{ now()->format('H:i:s d/m/Y') }}</small>
        </div>
    </div>

    <script>
        window.onload = function() {
            // Uncomment line below to auto-print on load
            // window.print();
        };
    </script>
</body>
</html>