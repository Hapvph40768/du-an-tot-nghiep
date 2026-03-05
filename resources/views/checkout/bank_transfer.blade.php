<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chuyển khoản ngân hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-8 border border-slate-100">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Thanh toán chuyển khoản</h2>
            <p class="text-slate-500 text-sm mt-1">Vui lòng quét mã QR để thanh toán</p>
        </div>

        <div class="relative group mb-6">
            <div class="absolute -inset-1 bg-gradient-to-r from-orange-500 to-yellow-500 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
            <div class="relative bg-white p-4 rounded-2xl border border-slate-100">
                <img src="https://img.vietqr.io/image/970419-123456789-compact2.jpg?amount={{ $order->amount }}&addInfo={{ $order->order_code }}&accountName=CONG TY BAN VE" 
                     class="w-full h-auto rounded-lg shadow-inner" alt="QR Code">
            </div>
        </div>

        <div class="bg-slate-50 rounded-2xl p-5 space-y-3 mb-8 border border-slate-100">
            <div class="flex justify-between text-sm">
                <span class="text-slate-500 font-medium">Số tiền:</span>
                <span class="text-slate-900 font-bold text-lg">{{ number_format($order->amount) }} VNĐ</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-slate-500 font-medium">Nội dung:</span>
                <span class="text-orange-600 font-black uppercase tracking-wider">{{ $order->order_code }}</span>
            </div>
        </div>

        <form action="{{ route('checkout.bank_transfer.upload', $order->id) }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-slate-900 hover:bg-black text-white font-bold py-4 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                TÔI ĐÃ CHUYỂN KHOẢN XONG
            </button>
        </form>
    </div>
</body>
</html>