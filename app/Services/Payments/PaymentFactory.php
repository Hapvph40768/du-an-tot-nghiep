<?php

namespace App\Services\Payments;

use App\Services\Payments\Gateways\VnPayGateway;
use App\Services\Payments\Gateways\StripeGateway;
use Exception;

class PaymentFactory
{
    public static function make(string $method): PaymentGatewayInterface
    {
        return match ($method) {
            'vnpay'  => new VnPayGateway(),
            'stripe' => new StripeGateway(),
            // Thêm 'momo' => new MoMoGateway() vào đây sau này cực kỳ dễ
            default  => throw new Exception("Cổng thanh toán [{$method}] không được hỗ trợ."),
        };
    }
}