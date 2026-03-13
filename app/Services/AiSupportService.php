<?php

namespace App\Services;

use App\Models\SupportTicket;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiSupportService
{
    public function generateReply(SupportTicket $ticket, string $userMessage)
    {
        $apiKey = env('GEMINI_API_KEY');

        // Fallback message if no API key is set
        $fallbackMessage = 'Hệ thống đã ghi nhận phản hồi của bạn. Một quản trị viên sẽ hỗ trợ bạn trong giây lát.';

        if (empty($apiKey)) {
            return $fallbackMessage;
        }

        try {
            // Build conversation history for better context (optional but good for chat)
            $messages = $ticket->messages()->with('sender')->orderBy('created_at', 'asc')->get();
            
            $historyPrompt = "Bối cảnh cuộc trò chuyện hỗ trợ khách hàng:\n";
            foreach ($messages as $msg) {
                $role = ($msg->sender_id === null || optional($msg->sender)->role === 'admin') ? 'Nhân viên (hoặc Hệ thống)' : 'Khách hàng';
                $historyPrompt .= "{$role}: {$msg->message}\n";
            }
            
            if ($userMessage !== '') {
               // $historyPrompt .= "Khách hàng (mới gửi): {$userMessage}\n"; 
            }

            $prompt = $historyPrompt . "\nBạn là trợ lý AI chuyên hỗ trợ khách hàng Đặt vé xe khách, trả lời lịch sự, thân thiện và ngắn gọn bằng tiếng Việt. Hãy dựa vào bối cảnh cuộc hội thoại trên để đưa ra một câu trả lời phù hợp (Đóng vai nhân viên CSKH). Không cần lặp lại thông báo nhận được.";

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    return $data['candidates'][0]['content']['parts'][0]['text'];
                }
            }

            Log::error('Gemini API Error: ' . $response->body());
            return 'Xin lỗi, hệ thống trả lời tự động đang bận hoặc quá tải. Quản trị viên của chúng tôi sẽ phản hồi lại bạn sớm nhất có thể.';

        } catch (\Exception $e) {
            Log::error('AI Service Exception: ' . $e->getMessage());
            return $fallbackMessage;
        }
    }
}
