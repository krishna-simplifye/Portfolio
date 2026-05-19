<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Private Chat - Radhey Krishna</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'] } } }
            }
        </script>
    @endif
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-grid-pattern {
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 3rem 3rem;
        }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #000000; }
        ::-webkit-scrollbar-thumb { background: #18181b; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #27272a; }
    </style>
</head>
<body class="bg-black text-zinc-100 antialiased relative overflow-x-hidden">

    <!-- Ambient Background Effects -->
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-indigo-600/10 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-sky-600/5 blur-[150px] rounded-full"></div>
    </div>

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 bg-black/70 backdrop-blur-lg border-b border-white/5 transition-all">
        <div class="max-w-6xl mx-auto px-6 h-20 flex justify-between items-center">
            <a href="{{ route('welcome') }}" class="text-xl font-bold tracking-tight text-white">Dev<span class="text-sky-500">Portfolio</span></a>
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('welcome') }}#about" class="text-sm font-medium text-zinc-400 hover:text-white transition-colors">About</a>
                <a href="{{ route('welcome') }}#skills" class="text-sm font-medium text-zinc-400 hover:text-white transition-colors">Expertise</a>
                <a href="{{ route('welcome') }}#projects" class="text-sm font-medium text-zinc-400 hover:text-white transition-colors">Projects</a>
            </div>
        </div>
    </nav>

    <main class="max-w-2xl mx-auto px-6 pt-32 pb-24">
        <div class="text-center mb-12">
            <div class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-green-900/50 border border-green-800 text-green-300 text-sm font-medium mb-8">
                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                <span>Step 3 of 3 - Ready to Chat!</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-6">
                <span class="block text-zinc-100 mb-2">Welcome to</span>
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-emerald-500 to-sky-500">
                    Private Chat
                </span>
            </h1>
            
            <p class="text-lg text-zinc-400 max-w-2xl leading-relaxed">
                Your chat session is ready! Click the button below to start the conversation.
            </p>
        </div>

        <div class="relative bg-[#0a0a0a]/50 border border-zinc-900 rounded-[2rem] p-8 md:p-12 backdrop-blur-sm">
            <!-- User Information Summary -->
            <div class="mb-8 p-6 rounded-xl bg-zinc-900/30 border border-zinc-800">
                <h3 class="text-sm font-medium text-zinc-400 mb-4">Your Chat Information:</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-zinc-500 text-sm">Country:</span>
                        <span class="text-zinc-300 text-sm font-medium">{{ session('chat_country') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-zinc-500 text-sm">Mobile:</span>
                        <span class="text-zinc-300 text-sm font-medium">{{ session('chat_mobile') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-zinc-500 text-sm">Reason:</span>
                        <span class="text-zinc-300 text-sm font-medium">{{ session('chat_reason') }}</span>
                    </div>
                </div>
            </div>

            <!-- Start Chat Button -->
            <div class="text-center">
                <button id="start-chat-btn" 
                        class="inline-flex items-center px-8 py-4 rounded-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold transition-all hover:scale-105 shadow-[0_0_20px_rgba(34,197,94,0.3)] hover:shadow-[0_0_30px_rgba(34,197,94,0.4)]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Start Private Chat
                </button>
            </div>

            <div class="mt-8 text-center">
                <p class="text-zinc-500 text-sm mb-4">
                    The chat widget will open in the bottom right corner of your screen.
                </p>
                <a href="{{ route('welcome') }}" class="text-zinc-400 hover:text-zinc-300 text-sm transition-colors">
                    Back to Home
                </a>
            </div>
        </div>
    </main>

    <!-- WhatsApp Widget (Hidden by default) -->
    <div id="wa-widget" class="fixed bottom-6 right-6 z-[100] flex flex-col items-end hidden transition-all">
        <div class="bg-[#111b21] w-[340px] md:w-96 rounded-2xl shadow-2xl overflow-hidden border border-zinc-700/50 flex flex-col h-[500px] max-h-[80vh]">
            <div class="bg-[#202c33] p-4 flex items-center justify-between border-b border-zinc-700/50 shadow-md z-10 w-full shrink-0">
                <div class="flex items-center space-x-3 w-full max-w-[200px]">
                    <div class="w-10 h-10 shrink-0 bg-emerald-600 rounded-full flex items-center justify-center text-white overflow-hidden">
                        <svg class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                    </div>
                    <div class="min-w-0 overflow-hidden flex-1 pl-1">
                        <h3 class="text-white font-semibold text-[15px] truncate max-w-full block" title="Radhey Krishna">Radhey Krishna</h3>
                        <p class="text-emerald-500 text-xs block">Online</p>
                    </div>
                </div>
                <button id="close-wa-btn" class="text-zinc-400 hover:text-white transition-colors shrink-0 p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div id="wa-messages" class="flex-1 min-h-0 overflow-y-auto p-4 space-y-3 bg-[#0b141a]" style="background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png'); background-blend-mode: overlay; background-color: rgba(11,20,26,0.9);">
                <!-- Messages injected here -->
            </div>
            <div class="bg-[#202c33] p-3 flex items-center space-x-2 shrink-0">
                <input type="text" id="wa-input" placeholder="Type a message" class="flex-1 w-full min-w-0 bg-[#2a3942] text-white text-[15px] placeholder-zinc-400 rounded-lg px-4 py-2.5 focus:outline-none border border-transparent focus:border-emerald-600/50 transition-colors" autocomplete="off">
                <button id="wa-send" class="w-11 h-11 shrink-0 bg-emerald-600 rounded-full flex items-center justify-center text-white hover:bg-emerald-500 transition-colors disabled:opacity-50">
                    <svg class="w-5 h-5 translate-x-[1px]" fill="currentColor" viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const startChatBtn = document.getElementById('start-chat-btn');
            const widget = document.getElementById('wa-widget');
            const closeBtn = document.getElementById('close-wa-btn');
            const messagesDiv = document.getElementById('wa-messages');
            const inputField = document.getElementById('wa-input');
            const sendBtn = document.getElementById('wa-send');

            let deviceId = localStorage.getItem('chat_device_id');
            if (!deviceId) {
                deviceId = 'guest_' + Math.random().toString(36).substr(2, 9);
                localStorage.setItem('chat_device_id', deviceId);
            }

            let pollInterval = null;

            startChatBtn.addEventListener('click', () => {
                widget.classList.remove('hidden');
                fetchMessages();
                if(!pollInterval) {
                    pollInterval = setInterval(fetchMessages, 3000);
                }
                // Send initial message with user info
                sendInitialMessage();
            });

            closeBtn.addEventListener('click', () => {
                widget.classList.add('hidden');
                if(pollInterval) {
                    clearInterval(pollInterval);
                    pollInterval = null;
                }
            });

            // Click outside to close functionality
            document.addEventListener('click', (e) => {
                if (widget.classList.contains('hidden')) return;
                
                const isClickInsideWidget = widget.contains(e.target);
                const isClickOnStartButton = startChatBtn.contains(e.target);
                
                if (!isClickInsideWidget && !isClickOnStartButton) {
                    widget.classList.add('hidden');
                    if(pollInterval) {
                        clearInterval(pollInterval);
                        pollInterval = null;
                    }
                }
            });

            function sendInitialMessage() {
                const userInfo = `New chat session started:\nCountry: {{ session('chat_country') }}\nMobile: {{ session('chat_mobile') }}\nReason: {{ session('chat_reason') }}`;
                
                fetch('/chat/message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Device-Id': deviceId,
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: userInfo })
                });
            }

            function fetchMessages() {
                fetch('/chat/messages', {
                    headers: {
                        'X-Device-Id': deviceId
                    }
                })
                .then(response => response.json())
                .then(data => {
                    renderMessages(data.messages || []);
                })
                .catch(error => console.error('Error fetching messages:', error));
            }

            function renderMessages(messages) {
                if(messages.length === 0) {
                   messagesDiv.innerHTML = `
                       <div class="flex justify-center mb-4">
                           <span class="bg-[#182229] text-zinc-400 text-xs px-3 py-1 rounded-md shadow-sm border border-zinc-700/30">Chat started successfully!</span>
                       </div>
                   `;
                   return;
                }

                let isAtBottom = messagesDiv.scrollHeight - messagesDiv.scrollTop <= messagesDiv.clientHeight + 50;

                messagesDiv.innerHTML = messages.map(msg => `
                    <div class="flex ${msg.is_admin ? 'justify-start' : 'justify-end'} mb-3">
                        <div class="max-w-[80%] ${msg.is_admin ? 'bg-[#202c33]' : 'bg-[#005c4b]'} px-4 py-2 rounded-2xl ${msg.is_admin ? 'rounded-tl-none' : 'rounded-tr-none'}">
                            <p class="text-white text-sm break-words">${msg.message}</p>
                            <p class="text-zinc-400 text-xs mt-1">${new Date(msg.created_at).toLocaleTimeString()}</p>
                        </div>
                    </div>
                `).join('');

                if(isAtBottom) {
                    messagesDiv.scrollTop = messagesDiv.scrollHeight;
                }
            }

            sendBtn.addEventListener('click', sendMessage);
            inputField.addEventListener('keypress', (e) => {
                if(e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            function sendMessage() {
                const message = inputField.value.trim();
                if(!message) return;

                sendBtn.disabled = true;

                fetch('/chat/message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Device-Id': deviceId,
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(response => response.json())
                .then(data => {
                    inputField.value = '';
                    fetchMessages();
                })
                .catch(error => console.error('Error sending message:', error))
                .finally(() => {
                    sendBtn.disabled = false;
                });
            }
        });
    </script>
</body>
</html>
