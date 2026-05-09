<?php

namespace App\Services\Payments\Gateways;

use App\Services\Payments\PaymentGatewayInterface;
use App\Models\Transaction;
use Illuminate\Http\Request;

class VnPayGateway implements PaymentGatewayInterface
{
    public function process(Transaction $transaction, Request $request): array
    {
        $vnp_TmnCode = env('VNP_TMN_CODE');
        $vnp_HashSecret = env('VNP_HASH_SECRET');
        $vnp_Url = env('VNP_URL');
        $vnp_Returnurl = env('VNP_RETURN_URL');

        $vnp_TxnRef = $transaction->order_code; // Mã đơn hàng (VD: INV-12345)
        $vnp_OrderInfo = "Thanh toan don hang " . $transaction->order_code;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $transaction->amount * 100; // VNPay yêu cầu nhân số tiền với 100
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $request->ip();

        // 1. Chuẩn bị mảng dữ liệu
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        // 2. Sắp xếp mảng theo thứ tự Alphabet (Bắt buộc theo tài liệu VNPay)
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";

        // 3. Tạo chuỗi query và chuỗi để băm chữ ký
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;

        // 4. Tạo chữ ký số (Secure Hash) bằng SHA512
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // 5. Trả về link để Controller phản hồi cho người dùng
        return [
            'success' => true,
            'is_redirect' => true,
            'redirect_url' => $vnp_Url
        ];
    }

    public function verifyWebhook(Request $request): array
    {
        // Tạm thời để trống, chúng ta sẽ làm ở Giai đoạn 3
        return [];
    }
}