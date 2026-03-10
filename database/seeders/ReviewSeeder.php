<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get real IDs from database
        $users = DB::table('users')->limit(2)->pluck('id')->toArray();
        $bookings = DB::table('bookings')->limit(3)->pluck('id')->toArray();
        $trips = DB::table('trips')->limit(3)->pluck('id')->toArray();

        // Only seed if data exists
        if (empty($users) || empty($bookings) || empty($trips)) {
            $this->command->info('Cần có users, bookings, và trips trước khi seed reviews.');
            return;
        }

        $reviews = [
            [
                'user_id' => $users[0],
                'booking_id' => $bookings[0],
                'trip_id' => $trips[0],
                'rating' => 5,
                'comment' => 'Dịch vụ tuyệt vời! Tài xế rất thân thiện và xe sạch sẽ.'
            ],
            [
                'user_id' => $users[0],
                'booking_id' => $bookings[1],
                'trip_id' => $trips[1],
                'rating' => 4,
                'comment' => 'Tốt, nhưng có chút trễ. Tuy nhiên tài xế rất lịch sự.'
            ],
            [
                'user_id' => $users[1],
                'booking_id' => $bookings[2],
                'trip_id' => $trips[2],
                'rating' => 3,
                'comment' => 'Bình thường, có thể cải thiện chất lượng âm thanh trong xe.'
            ],
        ];

        foreach ($reviews as $review) {
            // Kiểm tra booking chưa có review
            if (!Review::where('booking_id', $review['booking_id'])->exists()) {
                Review::create($review);
            }
        }

        $this->command->info('Đã tạo ' . count($reviews) . ' review mẫu.');
    }
}
