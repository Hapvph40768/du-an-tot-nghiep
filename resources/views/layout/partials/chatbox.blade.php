<!-- Floating Chat Button -->
<div id="chat-button" style="position: fixed; bottom: 30px; right: 30px; z-index: 999999; cursor: pointer;" class="transition-all duration-500 hover:scale-110 active:scale-95 group">
    <div class="relative flex h-16 w-16 items-center justify-center rounded-2xl liquid-gradient shadow-2xl shadow-brand-primary/40">
        <i data-lucide="message-circle" class="h-8 w-8 text-white transition-transform group-hover:rotate-12"></i>
        <span class="absolute -top-1 -right-1 flex h-4 w-4">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-accent opacity-75"></span>
            <span class="relative inline-flex rounded-full h-4 w-4 bg-brand-accent"></span>
        </span>
    </div>
</div>

<!-- Chat Window -->
<div id="chat-window" style="position: fixed; bottom: 110px; right: 30px; z-index: 999999;" class="w-[90vw] sm:w-[400px] overflow-hidden rounded-3xl glass-dark border border-white/10 shadow-2xl transition-all duration-500 translate-y-10 opacity-0 pointer-events-none scale-95 origin-bottom-right">
    <!-- Header -->
    <div class="flex items-center justify-between liquid-gradient p-5 text-white">
        <div class="flex items-center gap-3">
            <div class="h-12 w-12 rounded-2xl bg-white/20 p-0.5 backdrop-blur-md flex items-center justify-center border border-white/20">
                <i data-lucide="bot" class="w-7 h-7 text-white"></i>
            </div>
            <div>
                <h4 class="font-heading font-bold text-lg leading-tight">Trợ lý Mạnh Hùng</h4>
                <p class="text-xs text-white/80 flex items-center gap-1.5 mt-0.5">
                    <span class="h-2 w-2 rounded-full bg-green-400 animate-pulse"></span>
                    Hỗ trợ 24/7
                </p>
            </div>
        </div>
        <button id="close-chat" class="rounded-xl p-2 hover:bg-white/10 transition-colors text-white/80 hover:text-white">
            <i data-lucide="x" class="h-5 w-5"></i>
        </button>
    </div>

    <!-- Messages Container -->
    <div id="chat-messages" class="h-[400px] space-y-4 overflow-y-auto p-6 scrollbar-hide bg-black/20">
        <!-- AI Initial Message -->
        <div class="flex flex-col gap-2">
            <div class="max-w-[85%] rounded-2xl rounded-tl-none glass p-4 text-sm text-white/90 leading-relaxed">
                Chào {{ auth()->user()->name ?? 'bạn' }}! Trợ lý Mạnh Hùng có thể giúp gì cho mình ạ? 🚌
            </div>
            <span class="text-[10px] text-white/30 ml-1">Vừa xong</span>
        </div>
    </div>

    <!-- Input Area -->
    <div class="p-5 bg-black/40 border-t border-white/5">
        <form id="chat-form" class="flex gap-3">
            <input type="text" id="chat-input" placeholder="Hỏi Mạnh Hùng AI..." 
                class="flex-1 rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm text-white placeholder:text-white/30 focus:ring-2 focus:ring-brand-primary/50 transition-all outline-none backdrop-blur-md">
            <button type="submit" class="flex h-12 w-12 items-center justify-center rounded-2xl liquid-gradient text-white shadow-lg shadow-brand-primary/20 hover:scale-105 active:scale-90 transition-all">
                <i data-lucide="send" class="h-5 w-5"></i>
            </button>
        </form>
    </div>
</div>

<style>
    #chat-messages::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .chat-open {
        opacity: 1 !important;
        pointer-events: auto !important;
        transform: translateY(0) scale(1) !important;
    }
    .typing-indicator span {
        height: 4px;
        width: 4px;
        background: var(--color-brand-accent);
        border-radius: 50%;
        display: inline-block;
        animation: typing 1s infinite ease-in-out;
    }
    .typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
    .typing-indicator span:nth-child(3) { animation-delay: 0.4s; }
    @keyframes typing {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-4px); }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatButton = document.getElementById('chat-button');
    const chatWindow = document.getElementById('chat-window');
    const closeChat = document.getElementById('close-chat');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const chatMessages = document.getElementById('chat-messages');

    // Re-initialize icons for dynamic content
    function refreshIcons() {
        if (window.lucide) {
            window.lucide.createIcons();
        }
    }

    // Toggle Chat Window
    chatButton.addEventListener('click', () => {
        chatWindow.classList.toggle('chat-open');
        if (chatWindow.classList.contains('chat-open')) {
            chatInput.focus();
        }
    });

    closeChat.addEventListener('click', () => {
        chatWindow.classList.remove('chat-open');
    });

    let lastMessageId = 0;

    // Handle Form Submit
    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = chatInput.value.trim();
        if (!message) return;

        appendMessage('user', message);
        chatInput.value = '';

        const typingId = appendTypingIndicator();
        
        try {
            const response = await fetch('/ai-chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ message })
            });

            const data = await response.json();
            removeTypingIndicator(typingId);
            
            // Nếu là phản hồi từ AI hoặc thông báo chuyển nhân viên
            appendMessage('ai', data.response);

        } catch (error) {
            removeTypingIndicator(typingId);
            appendMessage('ai', 'Xin lỗi, hệ thống đang bận. Bạn vui lòng thử lại sau nhé!');
        }
    });

    // Tính năng Polling để lấy tin nhắn mới từ nhân viên
    async function pollMessages() {
        if (!chatWindow.classList.contains('chat-open')) return;

        try {
            const response = await fetch('/ai-chat-poll', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                }
            });
            const data = await response.json();
            
            if (data.messages && data.messages.length > 0) {
                data.messages.forEach(msg => {
                    // Tránh hiển thị trùng lặp tin nhắn của user vừa gửi
                    if (msg.role !== 'user') {
                        appendMessage(msg.role === 'staff' ? 'staff' : 'ai', msg.message, true);
                    }
                });
            }
        } catch (e) {
            console.error('Polling error:', e);
        }
    }

    // Kiểm tra tin nhắn mới mỗi 5 giây khi cửa sổ chat mở
    setInterval(pollMessages, 5000);

    function appendMessage(type, text, isFromPolling = false) {
        // Tránh trùng lặp tin nhắn nếu polling lấy lại tin cũ (đơn giản hóa bằng cách check nội dung cuối)
        if (isFromPolling) {
            const lastMsg = chatMessages.lastElementChild?.querySelector('.msg-content')?.innerText;
            if (lastMsg === text) return;
        }

        const div = document.createElement('div');
        div.className = `flex flex-col gap-2 ${type === 'user' ? 'items-end' : ''}`;
        
        let bubbleClass = '';
        let label = '';

        if (type === 'user') {
            bubbleClass = 'liquid-gradient text-white rounded-2xl rounded-tr-none shadow-lg shadow-brand-primary/20';
        } else if (type === 'staff') {
            bubbleClass = 'bg-blue-600 text-white rounded-2xl rounded-tl-none border border-blue-400 shadow-xl';
            label = '<span class="text-[10px] font-bold text-blue-300 uppercase mb-1 block">Nhân viên trực</span>';
        } else {
            bubbleClass = 'glass text-white/90 rounded-2xl rounded-tl-none';
            label = '<span class="text-[10px] font-bold text-brand-accent uppercase mb-1 block">Trợ lý AI</span>';
        }

        div.innerHTML = `
            <div class="max-w-[85%] p-4 text-sm leading-relaxed shadow-xl ${bubbleClass} animate-in fade-in slide-in-from-bottom-2 duration-500">
                ${label}
                <div class="msg-content">${text}</div>
            </div>
            <span class="text-[10px] text-white/30 mx-2">${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</span>
        `;
        chatMessages.appendChild(div);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function appendTypingIndicator() {
        const id = 'typing-' + Date.now();
        const div = document.createElement('div');
        div.id = id;
        div.className = 'flex flex-col gap-2';
        div.innerHTML = `
            <div class="max-w-[60px] p-4 glass rounded-2xl rounded-tl-none typing-indicator flex gap-1.5 items-center justify-center">
                <span></span><span></span><span></span>
            </div>
        `;
        chatMessages.appendChild(div);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        return id;
    }

    function removeTypingIndicator(id) {
        const el = document.getElementById(id);
        if (el) el.remove();
    }
});
</script>
