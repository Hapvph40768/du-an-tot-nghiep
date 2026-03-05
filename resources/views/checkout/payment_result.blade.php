<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả giao dịch</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-8 border overflow-hidden relative text-center">
        
        @if($status === 'success')
            <div class="w-20 h-20 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">✓</div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Thanh toán thành công 🎉</h2>
            <p class="text-gray-500 mb-6">Đơn hàng của bạn đã được thanh toán.</p>
        @elseif($status === 'waiting')
            <div class="w-20 h-20 bg-blue-100 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">⏱</div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Đang chờ xác nhận</h2>
            <p class="text-gray-500 mb-6">Chúng tôi đang kiểm tra giao dịch chuyển khoản của bạn.</p>
        @elseif($status === 'cod')
            <div class="w-20 h-20 bg-gray-100 text-gray-600 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">📦</div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Đặt vé thành công</h2>
            <p class="text-gray-500 mb-6">Vui lòng thanh toán khi nhận vé.</p>
        @else
            <div class="w-20 h-20 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">✗</div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Thanh toán thất bại ❌</h2>
            <p class="text-gray-500 mb-6">Đã có lỗi xảy ra hoặc bạn đã hủy giao dịch.</p>
        @endif

        <div class="bg-gray-50 rounded-xl p-4 text-left border mb-6 text-sm">
            <div class="flex justify-between mb-2">
                <span class="text-gray-500">Mã đơn hàng:</span>
                <span class="font-bold">{{ $order->order_code ?? 'N/A' }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span class="text-gray-500">Số tiền:</span>
                <span class="font-bold text-orange-500">{{ number_format($order->amount ?? 0) }} VNĐ</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Phương thức:</span>
                <span class="font-bold uppercase">{{ $order->payment_method ?? 'N/A' }}</span>
            </div>
        </div>

        <a href="/checkout" class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 rounded-xl transition-all">
            Quay lại cửa hàng
        </a>
    </div>

</body>
</html>