<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Route;
use App\Models\ParcelPrice;

class ParcelPriceSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy tất cả các tuyến đường
        $routes = Route::all();

        if ($routes->isEmpty()) {
            $this->command->info('Chưa có tuyến đường nào trong database.');
            return;
        }

        // Xóa dữ liệu cũ
        ParcelPrice::truncate();

        // Tạo bảng giá cho từng tuyến
        foreach ($routes as $route) {
            // Bảng giá mẫu: 0-2kg, 2-5kg, 5-10kg, 10kg+
            ParcelPrice::create([
                'route_id' => $route->id,
                'weight_from' => 0,
                'weight_to' => 2,
                'price' => 30000,
                'description' => 'Hàng nhẹ (dưới 2kg)',
            ]);

            ParcelPrice::create([
                'route_id' => $route->id,
                'weight_from' => 2,
                'weight_to' => 5,
                'price' => 50000,
                'description' => 'Hàng nhẹ vừa (2-5kg)',
            ]);

            ParcelPrice::create([
                'route_id' => $route->id,
                'weight_from' => 5,
                'weight_to' => 10,
                'price' => 80000,
                'description' => 'Hàng vừa (5-10kg)',
            ]);

            ParcelPrice::create([
                'route_id' => $route->id,
                'weight_from' => 10,
                'weight_to' => 20,
                'price' => 120000,
                'description' => 'Hàng nặng (10-20kg)',
            ]);

            ParcelPrice::create([
                'route_id' => $route->id,
                'weight_from' => 20,
                'weight_to' => 50,
                'price' => 180000,
                'description' => 'Hàng rất nặng (20-50kg)',
            ]);
        }

        $this->command->info('Đã tạo bảng giá ký gửi mẫu cho ' . $routes->count() . ' tuyến đường.');
    }
}

