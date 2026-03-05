<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử đơn hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen p-4 md:p-8 flex items-start justify-center font-sans">
    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-xl border border-orange-100 overflow-hidden transition-all duration-300 hover:shadow-orange-500/20 mt-10">
        
        <div class="bg-gradient-to-r from-orange-500 to-orange-400 px-8 py-6 flex justify-between items-center">
            <h2 class="text-2xl font-black text-white uppercase tracking-wider">Lịch sử đơn hàng</h2>
            <a href="/" class="text-orange-50 bg-white/20 hover:bg-white/30 px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300">Trang chủ</a>
        </div>
        
        <div class="p-8 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-2 border-orange-100 text-gray-500 text-sm uppercase tracking-wider">
                        <th class="pb-4 font-bold pl-4">Mã đơn</th>
                        <th class="pb-4 font-bold">Số tiền</th>
                        <th class="pb-4 font-bold">Phương thức</th>
                        <th class="pb-4 font-bold">Trạng thái</th>
                        <th class="pb-4 font-bold">Ngày tạo</th>
                        <th class="pb-4 font-bold text-center pr-4">Hành động</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($orders as $order)
                        <tr class="group border-b border-gray-50 hover:bg-orange-50/50 transition-colors duration-300">
                            <td class="py-5 pl-4 font-bold text-gray-900 group-hover:text-orange-600 transition-colors">{{ $order->order_code }}</td>
                            <td class="py-5 font-black text-orange-500">{{ number_format($order->amount) }} ₫</td>
                            <td class="py-5 uppercase text-xs font-bold text-gray-500">{{ $order->payment_method }}</td>
                            <td class="py-5">
                                @if($order->status == 'paid' || $order->status == 'completed')
                                    <span class="px-3 py-1 bg-green-100 text-green-600 rounded-lg text-xs font-black uppercase tracking-wide">Đã thanh toán</span>
                                @elseif($order->status == 'waiting_verify')
                                    <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-xs font-black uppercase tracking-wide">Chờ xác nhận</span>
                                @elseif($order->status == 'failed')
                                    <span class="px-3 py-1 bg-red-100 text-red-600 rounded-lg text-xs font-black uppercase tracking-wide">Thất bại</span>
                                @else
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded-lg text-xs font-black uppercase tracking-wide">Chờ xử lý</span>
                                @endif
                            </td>
                            <td class="py-5 text-sm text-gray-500 font-medium">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="py-5 text-center pr-4">
                                <a href="{{ route('orders.show', $order->id) }}" class="inline-block bg-orange-100 text-orange-600 hover:bg-orange-500 hover:text-white px-5 py-2 rounded-xl text-sm font-bold shadow-sm hover:shadow-md hover:scale-105 transition-all duration-300">
                                    Chi tiết
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-gray-400 font-medium">Bạn chưa có đơn hàng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($orders->hasPages())
            <div class="px-8 py-4 bg-gray-50 border-t border-orange-100">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</body>
</html>