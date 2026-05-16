<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message');
        $apiKey = config('services.gemini.key');
        $user = auth()->user();
        $userId = auth()->id();
        $userName = $user ? $user->name : 'Anh/Chị';
        $sessionId = session()->getId();

        // 1. Kiểm tra hoặc tạo Session Chat
        $chatSession = \App\Models\ChatSession::firstOrCreate(
            ['session_id' => $sessionId],
            ['user_id' => $userId, 'status' => 'bot']
        );

        // 2. Lưu tin nhắn người dùng vào database
        \Illuminate\Support\Facades\DB::table('chat_histories')->insert([
            'user_id' => $userId,
            'session_id' => $sessionId,
            'role' => 'user',
            'message' => $message,
            'created_at' => now(),
        ]);

        // 3. Nếu đang trong chế độ nhân viên ĐÃ trả lời (staff_replying), AI không can thiệp
        if ($chatSession->status === 'staff_replying') {
            return response()->json([
                'status' => 'staff_replying',
                'response' => 'Dạ, nhân viên đang hỗ trợ ' . $userName . ' trực tiếp. Vui lòng đợi trong giây lát ạ!'
            ]);
        }

        if (!$apiKey) {
            return response()->json(['response' => 'Xin lỗi, hệ thống Chat AI chưa được cấu hình API Key.']);
        }

        try {
            // Lấy 10 tin nhắn gần nhất để làm ngữ cảnh (Memory)
            $history = \Illuminate\Support\Facades\DB::table('chat_histories')
                ->where(function($query) use ($userId, $sessionId) {
                    $query->where('user_id', $userId)->orWhere('session_id', $sessionId);
                })
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get()
                ->reverse();

            $contents = [];
            foreach ($history as $chat) {
                $role = ($chat->role === 'staff') ? 'model' : $chat->role; // Staff message seen as model context
                $contents[] = [
                    'role' => $role,
                    'parts' => [['text' => $chat->message]]
                ];
            }

            $systemPrompt = "
                BẠN LÀ: 'Trợ lý Mạnh Hùng' - Nhân viên hỗ trợ trực tuyến của Nhà xe Mạnh Hùng.

                NGUYÊN TẮC CỐT LÕI: 
                - TRẢ LỜI CỰC KỲ NGẮN GỌN, ĐI THẲNG VÀO VẤN ĐỀ.
                - GỌI KHÁCH LÀ {$userName}.

                QUY TẮC CHUYỂN ĐỔI NHÂN VIÊN (QUAN TRỌNG):
                1. Nếu khách hàng báo MẤT ĐỒ, QUÊN ĐỒ (thực tế đang xảy ra), hoặc KHIẾU NẠI GAY GẮT tài xế/phụ xe, hoặc yêu cầu GẶP NGƯỜI THẬT: 
                   -> Hãy trả lời khách là bạn đang kết nối với nhân viên, và BẮT ĐẦU câu trả lời bằng mã: [HUMAN_REQUIRED]
                2. Nếu khách hàng nói 'không cần nữa', 'tìm thấy đồ rồi', hoặc 'thôi' khi đang ở chế độ chờ nhân viên:
                   -> Hãy xác nhận và BẮT ĐẦU bằng mã: [RESUME_BOT]
                3. Nếu chỉ là câu hỏi giả định hoặc hỏi thông tin chung (Ví dụ: 'Nếu mất đồ thì sao?'): 
                   -> ĐỪNG dùng mã [HUMAN_REQUIRED], hãy tự trả lời theo kiến thức.

                KIẾN THỨC TỔNG LỰC:
                - Quên đồ: Cần số ghế, biển số xe.
                - Hoàn vé: Trước 24h miễn phí, 12-24h phí 30%, dưới 12h phí 50%.
                - Giá vé: Hà Nội - Đà Nẵng 450k, Sài Gòn - Đà Lạt 300k.
            ";

            $response = Http::withoutVerifying()
                ->timeout(30)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])->post("https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash-latest:generateContent?key={$apiKey}", [
                    'contents' => array_merge([
                        ['role' => 'user', 'parts' => [['text' => "SYSTEM CONTEXT: " . $systemPrompt]]]
                    ], $contents)
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $aiResponse = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
                
                // Kiểm tra mã điều khiển từ AI
                if (str_contains($aiResponse, '[HUMAN_REQUIRED]')) {
                    $chatSession->update(['status' => 'waiting_staff']);
                    $aiResponse = str_replace('[HUMAN_REQUIRED]', '', $aiResponse);
                } elseif (str_contains($aiResponse, '[RESUME_BOT]')) {
                    $chatSession->update(['status' => 'bot']);
                    $aiResponse = str_replace('[RESUME_BOT]', '', $aiResponse);
                }

                // Lưu phản hồi của AI vào database
                \Illuminate\Support\Facades\DB::table('chat_histories')->insert([
                    'user_id' => $userId,
                    'session_id' => $sessionId,
                    'role' => 'model',
                    'message' => $aiResponse,
                    'created_at' => now(),
                ]);

                return response()->json([
                    'status' => $chatSession->fresh()->status,
                    'response' => trim($aiResponse)
                ]);
            }

            Log::error('Gemini API Details:', [
                'status' => $response->status(),
                'body' => $response->json(),
            ]);
            return response()->json(['response' => 'Trợ lý Mạnh Hùng đang bận xử lý lịch trình một chút, Anh/Chị vui lòng nhắn lại sau giây lát ạ! 🚌'], 500);

        } catch (\Exception $e) {
            Log::error('Chat Error: ' . $e->getMessage());
            return response()->json(['response' => 'Xin lỗi, hệ thống đang gặp sự cố.'], 500);
        }
    }

    public function poll(Request $request)
    {
        $sessionId = session()->getId();
        $userId = auth()->id();

        // Lấy tin nhắn trong vòng 30 giây qua để đảm bảo khách nhận được phản hồi từ nhân viên
        $messages = \Illuminate\Support\Facades\DB::table('chat_histories')
            ->where(function($query) use ($userId, $sessionId) {
                $query->where('user_id', $userId)->orWhere('session_id', $sessionId);
            })
            ->whereIn('role', ['model', 'staff'])
            ->where('created_at', '>=', now()->subSeconds(30))
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json(['messages' => $messages]);
    }
}
