<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $orders = [
            [
                'user_id' => 1,
                'order_code' => 'ORD-' . time() . '-101',
                'amount' => 500000,
                'payment_method' => 'vnpay',
                'status' => 'paid',
                'created_at' => $now->copy()->subMinutes(15),
                'updated_at' => $now->copy()->subMinutes(15),
            ],
            [
                'user_id' => 1,
                'order_code' => 'ORD-' . time() . '-102',
                'amount' => 150000,
                'payment_method' => 'momo',
                'status' => 'paid',
                'created_at' => $now->copy()->subHours(1),
                'updated_at' => $now->copy()->subHours(1),
            ],
            [
                'user_id' => 1,
                'order_code' => 'ORD-' . time() . '-103',
                'amount' => 1250000,
                'payment_method' => 'bank_transfer',
                'status' => 'waiting_verify',
                'created_at' => $now->copy()->subHours(2),
                'updated_at' => $now->copy()->subHours(2),
            ],
            [
                'user_id' => 1,
                'order_code' => 'ORD-' . time() . '-104',
                'amount' => 85000,
                'payment_method' => 'cod',
                'status' => 'pending',
                'created_at' => $now->copy()->subHours(5),
                'updated_at' => $now->copy()->subHours(5),
            ],
            [
                'user_id' => 1,
                'order_code' => 'ORD-' . time() . '-105',
                'amount' => 300000,
                'payment_method' => 'vnpay',
                'status' => 'failed',
                'created_at' => $now->copy()->subDays(1),
                'updated_at' => $now->copy()->subDays(1),
            ],
            [
                'user_id' => 1,
                'order_code' => 'ORD-' . time() . '-106',
                'amount' => 450000,
                'payment_method' => 'bank_transfer',
                'status' => 'paid', // Đã xác nhận chuyển khoản
                'created_at' => $now->copy()->subDays(1)->subHours(3),
                'updated_at' => $now->copy()->subDays(1)->subHours(2),
            ],
            [
                'user_id' => 1,
                'order_code' => 'ORD-' . time() . '-107',
                'amount' => 99000,
                'payment_method' => 'cod',
                'status' => 'completed',
                'created_at' => $now->copy()->subDays(2),
                'updated_at' => $now->copy()->subDays(1),
            ],
            [
                'user_id' => 1,
                'order_code' => 'ORD-' . time() . '-108',
                'amount' => 250000,
                'payment_method' => 'momo',
                'status' => 'failed',
                'created_at' => $now->copy()->subDays(3),
                'updated_at' => $now->copy()->subDays(3),
            ],
            [
                'user_id' => 1,
                'order_code' => 'ORD-' . time() . '-109',
                'amount' => 650000,
                'payment_method' => 'vnpay',
                'status' => 'completed',
                'created_at' => $now->copy()->subDays(4),
                'updated_at' => $now->copy()->subDays(4),
            ],
            [
                'user_id' => 1,
                'order_code' => 'ORD-' . time() . '-110',
                'amount' => 75000,
                'payment_method' => 'bank_transfer',
                'status' => 'waiting_verify',
                'created_at' => $now->copy()->subDays(5),
                'updated_at' => $now->copy()->subDays(5),
            ],
        ];

        DB::table('orders')->insert($orders);
    }
}