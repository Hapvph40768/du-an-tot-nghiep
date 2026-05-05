<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Chatbox extends Component
{
    public $isOpen = false;
    public $step = 'list'; // list hoặc chat
    public $selectedTicketId = null;
    public $newMessage = '';

    protected $listeners = ['selectTicket' => 'selectTicket'];

    #[On('toggle-chat')]
    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;

        // Nếu mở chat và đang ở vai trò Customer
        if ($this->isOpen && Auth::check() && Auth::user()->role !== 'admin') {
            $lastTicket = \App\Models\SupportTicket::where('user_id', Auth::id())
                ->where('status', '!=', 'closed') // Chỉ lấy ticket chưa đóng
                ->latest()
                ->first();

            if ($lastTicket) {
                $this->selectedTicketId = $lastTicket->id;
                $this->step = 'chat';
                $this->dispatch('scroll-to-bottom');
            }
        }
    }
    public function selectTicket($id)
    {
        $this->selectedTicketId = $id;
        $this->step = 'chat';
        $this->isOpen = true;
        $this->dispatch('scroll-to-bottom');
    }

    public function backToList()
    {
        $this->step = 'list';
        $this->selectedTicketId = null;
    }

    public function sendMessage()
    {
        if (empty(trim($this->newMessage)) || !$this->selectedTicketId) return;

        SupportMessage::create([
            'support_ticket_id' => $this->selectedTicketId,
            'sender_id' => Auth::id(),
            'sender_type' => Auth::user()->role === 'admin' ? 'admin' : 'user',
            'message' => $this->newMessage
        ]);

        $ticket = SupportTicket::find($this->selectedTicketId);
        
        // Nếu là Admin nhắn, tự động chuyển ticket sang trạng thái 'processing'
        if (Auth::user()->role === 'admin') {
            $ticket->update([
                'status' => 'processing',
                'assigned_admin_id' => Auth::id()
            ]);
        } else {
            // Nếu là Khách hàng nhắn, tự động chuyển ticket về trạng thái 'open' để báo cho Admin
            if ($ticket->status !== 'open') {
                $ticket->update(['status' => 'open']);
            }
        }

        $this->newMessage = '';
        $this->dispatch('scroll-to-bottom');
    }

    public function render()
    {
        $user = Auth::user();
        if (!$user) return view('livewire.chatbox', ['tickets' => collect(), 'chatHistory' => collect()]);

        // Lấy danh sách ticket của khách
        $tickets = \App\Models\SupportTicket::where('user_id', $user->id)->latest()->get();

        // Tự động chọn ticket mới nhất nếu chưa chọn cái nào
        if (!$this->selectedTicketId && $tickets->isNotEmpty()) {
            $this->selectedTicketId = $tickets->first()->id;
            $this->step = 'chat';
        }

        $chatHistory = $this->selectedTicketId
            ? \App\Models\SupportMessage::where('support_ticket_id', $this->selectedTicketId)->orderBy('created_at', 'asc')->get()
            : collect();

        return view('livewire.chatbox', compact('tickets', 'chatHistory'));
    }
}
