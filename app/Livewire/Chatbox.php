<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Log;  
use Livewire\Attributes\On;
class Chatbox extends Component
{
    public $isOpen = false;
    public $step = 'list';
    public $selectedTicketId = null;
    public $newMessage = '';

    protected $listeners = ['selectTicket' => 'selectTicket'];

    #[On('toggle-chat-force')]
    public function forceOpenChat($state) {
        $this->isOpen = $state;
    }

    public function selectTicket($id)
    {
        $this->selectedTicketId = $id;
        $this->step = 'chat';
        $this->dispatch('scroll-to-bottom');
    }

    public function sendMessage()
    {
        if (empty(trim($this->newMessage))) return;

        SupportMessage::create([
            'support_ticket_id' => $this->selectedTicketId,
            'sender_id' => Auth::id(),
            'sender_type' => 'user',
            'message' => $this->newMessage
        ]);

        $userPrompt = $this->newMessage;
        $this->newMessage = '';
        $this->dispatch('scroll-to-bottom');

        $this->askGemini($userPrompt);
    }

    protected function askGemini($prompt)
    {
        $apiKey = config('services.gemini.key');

        try {
            // Http::withoutVerifying() là BẮT BUỘC trên Laragon để không lỗi SSL
            $response = Http::withoutVerifying()
                ->timeout(30)
                ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                    'contents' => [
                        ['parts' => [['text' => "Bạn là trợ lý ảo nhà xe Mạnh Hùng. Trả lời ngắn: " . $prompt]]]
                    ]
                ]);

            $aiReply = 'Xin lỗi, AI đang gặp sự cố kết nối.';

            if ($response->successful()) {
                $result = $response->json();
                // Kiểm tra kỹ cấu trúc trước khi lấy text
                if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                    $aiReply = $result['candidates'][0]['content']['parts'][0]['text'];
                }
            } else {
                Log::error('Gemini API Error: ' . $response->body());
                $aiReply = "Hệ thống AI đang bận (Mã: " . $response->status() . ")";
            }

            SupportMessage::create([
                'support_ticket_id' => $this->selectedTicketId,
                'sender_type' => 'ai',
                'message' => $aiReply
            ]);

            $this->dispatch('scroll-to-bottom');

        } catch (\Exception $e) {
            Log::error('Lỗi nghiêm trọng Chatbox: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $tickets = SupportTicket::where('user_id', Auth::id())->latest()->get();

        return view('livewire.chatbox', [
            'tickets' => $tickets,
            'chatHistory' => $this->selectedTicketId ? 
                SupportMessage::where('support_ticket_id', $this->selectedTicketId)->orderBy('created_at', 'asc')->get() : 
                collect()
        ]);
    }
}