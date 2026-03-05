<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng - {{ $order->order_code }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Tùy chỉnh thêm một chút gradient cho giống với yêu cầu màu sắc */
        .bg-brand-gradient {
            background: linear-gradient(to right, #ffb347, #ff7a18);
        }
        .text-brand {
            color: #ff7a18;
        }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex items-center justify-center p-4 font-sans text-gray-800">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 overflow-hidden border border-gray-100 relative group">
        
        <div class="absolute -inset-0.5 bg-brand-gradient opacity-0 group-hover:opacity-20 blur transition duration-500 rounded-2xl"></div>

        <div class="relative bg-brand-gradient p-8 text-center text-white overflow-hidden rounded-t-2xl">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-xl"></div>
            <div class="absolute -bottom-10 -left-10 w-24 h-24 bg-white/10 rounded-full blur-lg"></div>
            
            <div class="text-5xl mb-3 relative z-10">📦</div>
            <h2 class="text-2xl font-black uppercase tracking-widest relative z-10 text-white shadow-sm">Chi tiết đơn hàng</h2>
            <p class="text-white/90 text-sm mt-1 font-medium relative z-10">Mã: {{ $order->order_code }}</p>
        </div>

        <div class="relative bg-white p-6 sm:p-8 space-y-5 rounded-b-2xl z-10">
            
            <div class="flex justify-between items-center pb-4 border-b border-gray-100 hover:border-orange-200 transition-colors">
                <span class="text-gray-500 font-medium text-sm">Mã đơn hàng</span>
                <span class="text-gray-900 font-bold text-base">{{ $order->order_code }}</span>
            </div>

            <div class="flex justify-between items-center pb-4 border-b border-gray-100 hover:border-orange-200 transition-colors">
                <span class="text-gray-500 font-medium text-sm">Số tiền</span>
                <span class="text-brand font-black text-2xl drop-shadow-sm">{{ number_format($order->amount) }} VNĐ</span>
            </div>

            <div class="flex justify-between items-center pb-4 border-b border-gray-100 hover:border-orange-200 transition-colors">
                <span class="text-gray-500 font-medium text-sm">Phương thức</span>
                <span class="text-gray-700 bg-gray-100 px-3 py-1 rounded-xl font-bold text-sm uppercase tracking-wider">{{ $order->payment_method }}</span>
            </div>

            <div class="flex justify-between items-center pb-4 border-b border-gray-100 hover:border-orange-200 transition-colors">
                <span class="text-gray-500 font-medium text-sm">Ngày tạo</span>
                <span class="text-gray-800 font-semibold text-sm">{{ $order->created_at->format('H:i - d/m/Y') }}</span>
            </div>

            <div class="flex justify-between items-center pb-2">
                <span class="text-gray-500 font-medium text-sm">Trạng thái</span>
                <div>
                    @if($order->status == 'paid')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-100 text-green-700 rounded-xl text-xs font-black uppercase tracking-wider shadow-sm">
                            ✅ Đã thanh toán
                        </span>
                    @elseif($order->status == 'cancelled')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-100 text-red-700 rounded-xl text-xs font-black uppercase tracking-wider shadow-sm">
                            ❌ Đã huỷ
                        </span>
                    @elseif($order->status == 'pending')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-orange-100 text-orange-600 rounded-xl text-xs font-black uppercase tracking-wider shadow-sm">
                            ⏳ Chờ thanh toán
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-100 text-blue-700 rounded-xl text-xs font-black uppercase tracking-wider shadow-sm">
                            ℹ️ {{ $order->status }}
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="pt-6 space-y-3">
                @if($order->status == 'pending')
                    <a href="/checkout?order_id={{ $order->id }}" class="flex items-center justify-center gap-2 w-full bg-brand-gradient text-white font-bold py-4 rounded-xl shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:scale-105 hover:-translate-y-1 transition-all duration-300">
                        <span>💳</span> THANH TOÁN NGAY
                    </a>
                @endif

                <a href="javascript:history.back()" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3.5 rounded-xl hover:scale-105 transition-all duration-300">
                    Quay lại
                </a>
            </div>

        </div>
    </div>

</body>
</html>