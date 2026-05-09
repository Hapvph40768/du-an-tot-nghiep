<?php

namespace App\Services\Payments\Gateways;

use App\Services\Payments\PaymentGatewayInterface;
use App\Models\Transaction;
use Illuminate\Http\Request;

class StripeGateway implements PaymentGatewayInterface
{
    public function process(Transaction $transaction, Request $request): array
    {
        // Code gọi API Stripe trừ tiền qua thẻ Visa/Mastercard trực tiếp
        // Không cần chuyển hướng như VNPay
        
        return [
            'success' => true,
            'is_redirect' => false,
            'message' => 'Thanh toán thẻ thành công',
            'transaction_id' => 'ch_1Mxyz...'
        ];
    }

    public function verifyWebhook(Request $request): array
    {
        // Stripe Webhook logic
        return ['success' => true, 'transaction_id' => $request->data['object']['id']];
    }
}