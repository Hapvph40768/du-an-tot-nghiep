<?php

namespace App\Services\Payments;

use App\Models\Transaction;
use Illuminate\Http\Request;

interface PaymentGatewayInterface
{
    /**
     * Tạo URL thanh toán hoặc xử lý trừ tiền trực tiếp
     */
    public function process(Transaction $transaction, Request $request): array;

    /**
     * Xử lý dữ liệu trả về từ cổng thanh toán (Webhook/IPN)
     */
    public function verifyWebhook(Request $request): array;
}