<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Chọn Phương Thức</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .method-card.active { border-color: #f97316; background-color: #fff7ed; transform: scale(1.02); box-shadow: 0 10px 15px -3px rgba(249, 115, 22, 0.2); }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-8 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6 uppercase tracking-wide">Xác nhận đơn hàng</h2>
        
        <div class="bg-gray-50 rounded-xl p-6 text-center mb-8 border border-gray-100">
            <span class="block text-sm text-gray-500 mb-1">Tổng thanh toán</span>
            <div class="text-4xl font-extrabold text-orange-500 tracking-tight">50.000 <span class="text-2xl">VNĐ</span></div>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
            @csrf
            <input type="hidden" name="payment_method" id="selectedMethod" value="vnpay">

            <p class="font-semibold text-gray-700 mb-4">Chọn phương thức thanh toán</p>
            <div class="space-y-3 mb-8">
                <div class="method-card active cursor-pointer border-2 border-gray-200 rounded-xl p-4 flex items-center gap-4 transition-all duration-300 hover:border-orange-300" onclick="selectMethod('vnpay', this)">
                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center font-bold">VN</div>
                    <span class="font-medium text-gray-700">Thanh toán VNPAY</span>
                </div>
                
                <div class="method-card cursor-pointer border-2 border-gray-200 rounded-xl p-4 flex items-center gap-4 transition-all duration-300 hover:border-orange-300" onclick="selectMethod('momo', this)">
                    <div class="w-10 h-10 bg-pink-100 text-pink-600 rounded-lg flex items-center justify-center font-bold">MM</div>
                    <span class="font-medium text-gray-700">Ví MoMo (Mock)</span>
                </div>

                <div class="method-card cursor-pointer border-2 border-gray-200 rounded-xl p-4 flex items-center gap-4 transition-all duration-300 hover:border-orange-300" onclick="selectMethod('bank_transfer', this)">
                    <div class="w-10 h-10 bg-green-100 text-green-600 rounded-lg flex items-center justify-center font-bold">CK</div>
                    <span class="font-medium text-gray-700">Chuyển khoản Ngân hàng (QR)</span>
                </div>
                
                <div class="method-card cursor-pointer border-2 border-gray-200 rounded-xl p-4 flex items-center gap-4 transition-all duration-300 hover:border-orange-300" onclick="selectMethod('cod', this)">
                    <div class="w-10 h-10 bg-gray-200 text-gray-600 rounded-lg flex items-center justify-center font-bold">COD</div>
                    <span class="font-medium text-gray-700">Thanh toán khi nhận vé</span>
                </div>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-orange-400 to-orange-600 text-white font-bold text-lg py-4 rounded-xl shadow-lg hover:shadow-orange-500/50 hover:scale-[1.02] transition-all duration-300">
                THANH TOÁN NGAY
            </button>
        </form>
    </div>

    <script>
        function selectMethod(method, element) {
            document.getElementById('selectedMethod').value = method;
            document.querySelectorAll('.method-card').forEach(el => el.classList.remove('active'));
            element.classList.add('active');
        }
    </script>
</body>
</html>