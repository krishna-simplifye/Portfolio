<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard | Private Chat</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
    </style>
</head>
<body class="bg-black text-zinc-100 antialiased min-h-screen relative overflow-hidden flex flex-col">

    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-sky-600/10 blur-[150px] rounded-full translate-x-1/3 -translate-y-1/3"></div>
    </div>

    <!-- Navigation -->
    <nav class="w-full z-50 bg-black/70 backdrop-blur-lg border-b border-white/5 transition-all shrink-0">
        <div class="max-w-7xl mx-auto px-6 h-16 flex justify-between items-center">
            <a href="/" class="text-xl font-bold tracking-tight text-white hover:opacity-80 transition-opacity">Dev<span class="text-sky-500">Portfolio</span></a>
            <div class="flex items-center space-x-4">
                <a href="/admin" class="px-4 py-2 text-sm font-semibold rounded-full {{ request()->is('admin') ? 'bg-zinc-900 border-zinc-800 text-white' : 'text-zinc-400 hover:text-white' }} border border-transparent hidden sm:block transition-colors">Form Submissions</a>
                <a href="/admin/chat" class="px-4 py-2 text-sm font-semibold rounded-full {{ request()->is('admin/chat') ? 'bg-zinc-900 border-zinc-800 text-white' : 'text-zinc-400 hover:text-white' }} border border-transparent hidden sm:block transition-colors">Private Chat</a>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 text-sm font-semibold rounded-full bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 text-red-400 transition-all">Sign Out</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Chat Interface -->
    <main class="flex-1 max-w-5xl mx-auto w-full px-6 py-6 flex overflow-hidden" style="height: calc(100vh - 8rem);">
        <div class="w-full h-full bg-[#111b21] rounded-2xl border border-zinc-800 shadow-2xl flex overflow-hidden max-h-[600px]">
            
            <!-- Sidebar / Conversations List -->
            <div id="conversations-sidebar" class="w-1/3 border-r border-zinc-800 flex flex-col bg-[#111b21] h-full">
                <div class="p-3 bg-[#202c33] shrink-0">
                    <h2 class="text-sm font-bold text-white">Active Chats</h2>
                </div>
                <!-- List -->
                <div id="conversations-list" class="flex-1 overflow-y-auto divide-y divide-zinc-800/50 min-h-0">
                    <!-- Javascript will inject sessions here -->
                </div>
            </div>

            <!-- Main Chat Area -->
            <div id="main-chat-area" class="w-2/3 flex flex-col bg-[#0b141a] relative h-full" style="background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png'); background-blend-mode: overlay; background-color: rgba(11,20,26,0.9);">
                
                <!-- Chat Header -->
                <div id="chat-header" class="p-3 bg-[#202c33] flex items-center shrink-0 hidden">
                    <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white mr-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                    <div>
                        <h3 id="chat-title" class="text-white font-semibold text-sm">Client Session</h3>
                        <p class="text-emerald-500 text-xs">Active</p>
                    </div>
                </div>

                <!-- Empty State -->
                <div id="empty-state" class="absolute inset-0 flex flex-col items-center justify-center text-center bg-[#111b21] z-10">
                    <svg class="w-20 h-20 text-zinc-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    <h2 class="text-xl font-bold text-zinc-400">Select a conversation</h2>
                    <p class="text-zinc-500 text-sm mt-2">Click on any chat from the left to start messaging.</p>
                </div>

                <!-- Messages -->
                <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-3 hidden min-h-0" style="min-height: 150px; max-height: 350px; overflow-y: scroll !important;">
                    <!-- Messages will be injected here -->
                </div>

                <!-- Input area -->
                <div id="chat-input-area" class="p-2 bg-[#202c33] shrink-0 hidden">
                    <form id="chat-form" class="flex items-center space-x-2">
                        <input type="text" id="chat-input" class="flex-1 bg-[#2a3942] text-white text-[14px] placeholder-zinc-400 rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition-all border-none" placeholder="Type a message..." autocomplete="off">
                        <button type="submit" id="chat-send" class="w-10 h-10 bg-emerald-600 hover:bg-emerald-500 rounded-full flex items-center justify-center text-white transition-colors">
                            <svg class="w-4 h-4 translate-x-[1px]" fill="currentColor" viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </main>

    <!-- Floating Admin Chat Widget -->
    <div id="admin-wa-widget" class="fixed bottom-6 right-6 z-[100] flex flex-col items-end hidden transition-all">
        <div class="bg-[#111b21] w-[340px] md:w-96 rounded-2xl shadow-2xl overflow-hidden border border-zinc-700/50 flex flex-col h-[500px] max-h-[80vh]">
            <div class="bg-[#202c33] p-4 flex items-center justify-between border-b border-zinc-700/50 shadow-md z-10 w-full shrink-0">
                <div class="flex items-center space-x-3 w-full max-w-[200px]">
                    <div class="w-10 h-10 shrink-0 bg-indigo-600 rounded-full flex items-center justify-center text-white overflow-hidden">
                        <svg class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                    <div class="min-w-0 overflow-hidden flex-1 pl-1">
                        <h3 id="widget-chat-title" class="text-white font-semibold text-[15px] truncate max-w-full block">Admin Chat</h3>
                        <p class="text-emerald-500 text-xs block">Online</p>
                    </div>
                </div>
                <button id="admin-close-wa-btn" class="text-zinc-400 hover:text-white transition-colors shrink-0 p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div id="admin-wa-messages" class="flex-1 min-h-0 overflow-y-auto p-4 space-y-3 bg-[#0b141a]" style="background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png'); background-blend-mode: overlay; background-color: rgba(11,20,26,0.9);">
                <!-- Messages injected here -->
            </div>
            <div class="bg-[#202c33] p-3 flex items-center space-x-2 shrink-0">
                <input type="text" id="admin-wa-input" placeholder="Type a message" class="flex-1 w-full min-w-0 bg-[#2a3942] text-white text-[15px] placeholder-zinc-400 rounded-lg px-4 py-2.5 focus:outline-none border border-transparent focus:border-indigo-600/50 transition-colors" autocomplete="off">
                <button id="admin-wa-send" class="w-11 h-11 shrink-0 bg-indigo-600 rounded-full flex items-center justify-center text-white hover:bg-indigo-500 transition-colors disabled:opacity-50">
                    <svg class="w-5 h-5 translate-x-[1px]" fill="currentColor" viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Floating Chat Toggle Button -->
    <button id="admin-chat-toggle" class="fixed bottom-6 right-6 w-14 h-14 bg-indigo-600 hover:bg-indigo-700 rounded-full flex items-center justify-center text-white shadow-lg transition-all hover:scale-110 z-[99]">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const listDiv = document.getElementById('conversations-list');
            const messagesDiv = document.getElementById('chat-messages');
            const headerDiv = document.getElementById('chat-header');
            const inputAreaDiv = document.getElementById('chat-input-area');
            const emptyStateDiv = document.getElementById('empty-state');
            const form = document.getElementById('chat-form');
            const input = document.getElementById('chat-input');
            const chatTitle = document.getElementById('chat-title');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            let activeConvId = null;
            let pollInterval = null;
            let convPollInterval = null;

            async function fetchConversations() {
                fetch('/admin/chat/conversations')
                .then(res => res.json())
                .then(data => {
                    console.log('Conversations data:', data); // Debug log
                    renderConversations(data.conversations || []);
                })
                .catch(error => console.error('Error fetching conversations:', error));
            }

            function renderConversations(convs) {
                if (convs.length === 0) {
                    listDiv.innerHTML = '<div class="p-4 text-center text-sm text-zinc-500">No active chats</div>';
                    return;
                }
                
                const html = convs.map(c => {
                    console.log('Processing conversation:', c); // Debug log
                    const isActive = c.id === activeConvId;
                    const snippet = c.latest_message ? (c.latest_message.length > 30 ? c.latest_message.substring(0,30)+'...' : c.latest_message) : 'New chat started';
                    const time = c.last_message_at ? new Date(c.last_message_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}) : '';
                    const mobile = c.client_mobile || 'No mobile';
                    
                    return `
                        <div class="conv-item p-4 cursor-pointer transition-colors ${isActive ? 'bg-[#2a3942]' : 'hover:bg-[#202c33]'}" data-id="${c.id}" data-session="${c.session_id}" data-mobile="${mobile}">
                            <div class="flex justify-between items-center mb-1">
                                <h4 class="text-white font-medium text-sm truncate">Client: ${mobile}</h4>
                                <span class="text-xs text-emerald-500">${time}</span>
                            </div>
                            <p class="text-xs text-zinc-400 truncate">${snippet}</p>
                        </div>
                    `;
                }).join('');
                
                listDiv.innerHTML = html;

                document.querySelectorAll('.conv-item').forEach(el => {
                    el.addEventListener('click', () => {
                        const id = parseInt(el.dataset.id);
                        const sessionId = el.dataset.session;
                        const mobile = el.dataset.mobile;
                        console.log('Clicked conversation - ID:', id, 'Session:', sessionId, 'Mobile:', mobile); // Debug log
                        openConversation(id, sessionId, mobile);
                    });
                });
            }

            function openConversation(id, sessionId, mobile) {
                if(pollInterval) clearInterval(pollInterval);
                
                activeConvId = id;
                chatTitle.innerText = `Client: ${mobile}`;
                
                emptyStateDiv.classList.add('hidden');
                headerDiv.classList.remove('hidden');
                messagesDiv.classList.remove('hidden');
                inputAreaDiv.classList.remove('hidden');
                
                // Update widget if it's open
                if (!adminWidget.classList.contains('hidden')) {
                    widgetActiveConvId = activeConvId;
                    widgetChatTitle.innerText = `Client: ${mobile}`;
                    fetchWidgetMessages();
                }
                
                fetchMessages();
                pollInterval = setInterval(fetchMessages, 3000); // Polling for replies
                fetchConversations(); // highlight active
            }

            async function fetchMessages() {
                if(!activeConvId) return;
                try {
                    const res = await fetch(`/admin/chat/${activeConvId}/messages`);
                    const data = await res.json();
                    renderMessages(data.messages || []);
                    
                    // Force auto-scroll to bottom whenever messages are fetched (WhatsApp behavior)
                    setTimeout(() => {
                        messagesDiv.scrollTo({
                            top: messagesDiv.scrollHeight,
                            behavior: 'smooth'
                        });
                    }, 200);
                } catch(e) { console.error('Error fetching messages', e); }
            }

            function renderMessages(messages) {
                // Force some test content if no messages
                if (!messages || messages.length === 0) {
                    messages = [
                        { message: "Test message 1 - This should be scrollable", is_admin: false, created_at: new Date() },
                        { message: "Test message 2 - Admin reply", is_admin: true, created_at: new Date() },
                        { message: "Test message 3 - Another client message", is_admin: false, created_at: new Date() },
                        { message: "Test message 4 - More content to test scrolling", is_admin: true, created_at: new Date() },
                        { message: "Test message 5 - Even more content", is_admin: false, created_at: new Date() },
                        { message: "Test message 6 - Keep adding content", is_admin: true, created_at: new Date() },
                        { message: "Test message 7 - Almost there", is_admin: false, created_at: new Date() },
                        { message: "Test message 8 - Final test message", is_admin: true, created_at: new Date() }
                    ];
                }
                
                // Check if user was at bottom before new messages
                const wasAtBottom = messagesDiv.scrollHeight - messagesDiv.scrollTop <= messagesDiv.clientHeight + 50;
                const previousMessageCount = messagesDiv.children.length;
                
                const html = messages.map(m => {
                    // is_admin means the admin sent it
                    const isMine = m.is_admin;
                    const time = new Date(m.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                    
                    return `
                        <div class="flex ${isMine ? 'justify-end' : 'justify-start'} w-full">
                            <div class="${isMine ? 'bg-[#005c4b]' : 'bg-[#202c33]'} text-[#e9edef] max-w-[85%] rounded-lg px-3 py-1.5 shadow-sm">
                                <p class="text-[15px] leading-relaxed break-words">${m.message.replace(/</g, "&lt;").replace(/>/g, "&gt;")}</p>
                                <span class="text-[10px] text-zinc-400 block text-right mt-1">${time}</span>
                            </div>
                        </div>
                    `;
                }).join('');
                
                messagesDiv.innerHTML = html;
                
                // WhatsApp-style auto-scroll logic
                setTimeout(() => {
                    // Auto-scroll if: user was at bottom OR new messages arrived
                    if (wasAtBottom || messages.length > previousMessageCount) {
                        messagesDiv.scrollTo({
                            top: messagesDiv.scrollHeight,
                            behavior: 'smooth'
                        });
                    }
                }, 100);
            }

            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const text = input.value.trim();
                if(!text || !activeConvId) return;

                input.value = '';
                
                try {
                    await fetch(`/admin/chat/${activeConvId}/message`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ message: text })
                    });
                    await fetchMessages();
                    fetchConversations();
                    
                    // Auto-scroll to bottom after sending message
                    setTimeout(() => {
                        messagesDiv.scrollTo({
                            top: messagesDiv.scrollHeight,
                            behavior: 'smooth'
                        });
                    }, 200);
                } catch(e) { console.error('Error sending message', e); }
            });

            // Click outside to close functionality
            document.addEventListener('click', (e) => {
                if (!activeConvId) return;
                
                const chatMainArea = document.querySelector('.w-2/3');
                const conversationsList = document.querySelector('.w-1/3');
                const navigation = document.querySelector('nav');
                const isClickInsideChat = chatMainArea.contains(e.target);
                const isClickInConversations = conversationsList.contains(e.target);
                const isClickInNavigation = navigation.contains(e.target);
                
                // Close if clicking outside chat areas (including navigation)
                if (!isClickInsideChat && !isClickInConversations && !isClickInNavigation) {
                    // Close the active conversation even if admin is typing
                    activeConvId = null;
                    chatTitle.innerText = 'Client Session';
                    
                    emptyStateDiv.classList.remove('hidden');
                    headerDiv.classList.add('hidden');
                    messagesDiv.classList.add('hidden');
                    inputAreaDiv.classList.add('hidden');
                    
                    // Clear polling and message input
                    if(pollInterval) {
                        clearInterval(pollInterval);
                        pollInterval = null;
                    }
                    
                    // Clear any typed message
                    const chatInput = document.getElementById('chat-input');
                    if (chatInput) {
                        chatInput.value = '';
                    }
                    
                    // Update conversation list to show no active selection
                    fetchConversations();
                }
            });

            // Also close on Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && activeConvId) {
                    // Close the active conversation
                    activeConvId = null;
                    chatTitle.innerText = 'Client Session';
                    
                    emptyStateDiv.classList.remove('hidden');
                    headerDiv.classList.add('hidden');
                    messagesDiv.classList.add('hidden');
                    inputAreaDiv.classList.add('hidden');
                    
                    // Clear polling and message input
                    if(pollInterval) {
                        clearInterval(pollInterval);
                        pollInterval = null;
                    }
                    
                    // Clear any typed message
                    const chatInput = document.getElementById('chat-input');
                    if (chatInput) {
                        chatInput.value = '';
                    }
                    
                    // Update conversation list to show no active selection
                    fetchConversations();
                    updateWidgetConversation(); // Update widget state
                }
            });

            // Admin Chat Widget Functionality
            const adminWidget = document.getElementById('admin-wa-widget');
            const adminToggleBtn = document.getElementById('admin-chat-toggle');
            const adminCloseBtn = document.getElementById('admin-close-wa-btn');
            const adminMessagesDiv = document.getElementById('admin-wa-messages');
            const adminInputField = document.getElementById('admin-wa-input');
            const adminSendBtn = document.getElementById('admin-wa-send');
            const widgetChatTitle = document.getElementById('widget-chat-title');

            let adminWidgetPollInterval = null;
            let widgetActiveConvId = null;

            // Toggle widget visibility
            adminToggleBtn.addEventListener('click', () => {
                if (adminWidget.classList.contains('hidden')) {
                    // Open widget and hide big chat box
                    adminWidget.classList.remove('hidden');
                    adminToggleBtn.classList.add('hidden');
                    
                    // Hide the big chat box
                    const chatMainArea = document.getElementById('main-chat-area');
                    const conversationsSidebar = document.getElementById('conversations-sidebar');
                    if (chatMainArea) {
                        chatMainArea.classList.add('hidden');
                    }
                    if (conversationsSidebar) {
                        conversationsSidebar.classList.remove('w-1/3');
                        conversationsSidebar.classList.add('w-full');
                        conversationsSidebar.classList.remove('border-r');
                    }
                    
                    if (activeConvId) {
                        widgetActiveConvId = activeConvId;
                        // Get mobile number from the active conversation
                        const activeConv = document.querySelector('.conv-item.bg-\\[\\#2a3942\\]');
                        const mobile = activeConv ? activeConv.dataset.mobile : 'Unknown';
                        widgetChatTitle.innerText = `Client: ${mobile}`;
                        fetchWidgetMessages();
                        if(!adminWidgetPollInterval) {
                            adminWidgetPollInterval = setInterval(fetchWidgetMessages, 3000);
                        }
                    } else {
                        adminMessagesDiv.innerHTML = `
                            <div class="flex justify-center mb-4">
                                <span class="bg-[#182229] text-zinc-400 text-xs px-3 py-1 rounded-md shadow-sm border border-zinc-700/30">Select a conversation in main panel first</span>
                            </div>
                        `;
                    }
                } else {
                    // Close widget and show big chat box
                    adminWidget.classList.add('hidden');
                    adminToggleBtn.classList.remove('hidden');
                    
                    // Show the big chat box again
                    const chatMainArea = document.querySelector('.w-2/3');
                    const conversationsSidebar = document.getElementById('conversations-sidebar');
                    if (chatMainArea) {
                        chatMainArea.classList.remove('hidden');
                    }
                    if (conversationsSidebar) {
                        conversationsSidebar.classList.remove('w-full');
                        conversationsSidebar.classList.add('w-1/3');
                        conversationsSidebar.classList.add('border-r');
                    }
                    
                    if(adminWidgetPollInterval) {
                        clearInterval(adminWidgetPollInterval);
                        adminWidgetPollInterval = null;
                    }
                }
            });

            adminCloseBtn.addEventListener('click', () => {
                adminWidget.classList.add('hidden');
                adminToggleBtn.classList.remove('hidden');
                
                // Show the big chat box again
                const chatMainArea = document.querySelector('.w-2/3');
                const conversationsList = document.querySelector('.w-1/3');
                if (chatMainArea) {
                    chatMainArea.classList.remove('hidden');
                }
                if (conversationsList) {
                    conversationsList.classList.remove('w-full');
                    conversationsList.classList.add('w-1/3');
                }
                
                if(adminWidgetPollInterval) {
                    clearInterval(adminWidgetPollInterval);
                    adminWidgetPollInterval = null;
                }
            });

            // Click outside to close widget
            document.addEventListener('click', (e) => {
                if (!adminWidget.classList.contains('hidden')) {
                    const isClickInsideWidget = adminWidget.contains(e.target);
                    const isClickOnToggleBtn = adminToggleBtn.contains(e.target);
                    
                    if (!isClickInsideWidget && !isClickOnToggleBtn) {
                        adminWidget.classList.add('hidden');
                        adminToggleBtn.classList.remove('hidden');
                        
                        // Show the big chat box again
                        const chatMainArea = document.querySelector('.w-2/3');
                        const conversationsList = document.querySelector('.w-1/3');
                        if (chatMainArea) {
                            chatMainArea.classList.remove('hidden');
                        }
                        if (conversationsList) {
                            conversationsList.classList.remove('w-full');
                            conversationsList.classList.add('w-1/3');
                        }
                        
                        if(adminWidgetPollInterval) {
                            clearInterval(adminWidgetPollInterval);
                            adminWidgetPollInterval = null;
                        }
                    }
                }
            });

            function fetchWidgetMessages() {
                if (!widgetActiveConvId) return;
                
                fetch(`/admin/chat/${widgetActiveConvId}/messages`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    renderWidgetMessages(data.messages || []);
                    
                    // Force auto-scroll to bottom whenever messages are fetched (WhatsApp behavior)
                    setTimeout(() => {
                        adminMessagesDiv.scrollTo({
                            top: adminMessagesDiv.scrollHeight,
                            behavior: 'smooth'
                        });
                    }, 200);
                })
                .catch(error => console.error('Error fetching widget messages:', error));
            }

            function renderWidgetMessages(messages) {
                if(messages.length === 0) {
                   adminMessagesDiv.innerHTML = `
                       <div class="flex justify-center mb-4">
                           <span class="bg-[#182229] text-zinc-400 text-xs px-3 py-1 rounded-md shadow-sm border border-zinc-700/30">No messages yet</span>
                       </div>
                   `;
                   return;
                }

                // Check if user was at bottom before new messages
                const wasAtBottom = adminMessagesDiv.scrollHeight - adminMessagesDiv.scrollTop <= adminMessagesDiv.clientHeight + 50;
                const previousMessageCount = adminMessagesDiv.children.length;

                adminMessagesDiv.innerHTML = messages.map(msg => `
                    <div class="flex ${msg.is_admin ? 'justify-end' : 'justify-start'} mb-3">
                        <div class="max-w-[80%] ${msg.is_admin ? 'bg-[#005c4b]' : 'bg-[#202c33]'} px-4 py-2 rounded-2xl ${msg.is_admin ? 'rounded-tr-none' : 'rounded-tl-none'}">
                            <p class="text-white text-sm break-words">${msg.message.replace(/</g, "&lt;").replace(/>/g, "&gt;")}</p>
                            <p class="text-zinc-400 text-xs mt-1">${new Date(msg.created_at).toLocaleTimeString()}</p>
                        </div>
                    </div>
                `).join('');

                // WhatsApp-style auto-scroll logic for widget
                setTimeout(() => {
                    // Auto-scroll if: user was at bottom OR new messages arrived
                    if (wasAtBottom || messages.length > previousMessageCount) {
                        adminMessagesDiv.scrollTo({
                            top: adminMessagesDiv.scrollHeight,
                            behavior: 'smooth'
                        });
                    }
                }, 100);
            }

            adminSendBtn.addEventListener('click', sendWidgetMessage);
            adminInputField.addEventListener('keypress', (e) => {
                if(e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendWidgetMessage();
                }
            });

            function sendWidgetMessage() {
                const message = adminInputField.value.trim();
                if(!message || !widgetActiveConvId) return;

                adminSendBtn.disabled = true;

                fetch(`/admin/chat/${widgetActiveConvId}/message`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(response => response.json())
                .then(data => {
                    adminInputField.value = '';
                    fetchWidgetMessages();
                    fetchConversations(); // Update main panel too
                    
                    // Auto-scroll to bottom after sending message in widget
                    setTimeout(() => {
                        adminMessagesDiv.scrollTo({
                            top: adminMessagesDiv.scrollHeight,
                            behavior: 'smooth'
                        });
                    }, 200);
                })
                .catch(error => console.error('Error sending widget message:', error))
                .finally(() => {
                    adminSendBtn.disabled = false;
                });
            }

            // Update widget when main conversation changes
            function updateWidgetConversation() {
                if (activeConvId && !adminWidget.classList.contains('hidden')) {
                    widgetActiveConvId = activeConvId;
                    widgetChatTitle.innerText = `Client: ${document.querySelector('.conv-item.bg-\\[\\#2a3942\\] h4')?.innerText.replace('Client: ', '') || 'Unknown'}`;
                    fetchWidgetMessages();
                }
            }

            // Track message counts for auto-scroll
            let lastMessageCount = 0;
            let lastWidgetMessageCount = 0;

            // Override renderMessages to track message count and force auto-scroll
            const originalRenderMessages = renderMessages;
            renderMessages = function(messages) {
                const currentMessageCount = messages ? messages.length : 0;
                const hasNewMessages = currentMessageCount > lastMessageCount;
                
                // Call original function
                originalRenderMessages(messages);
                
                // Force auto-scroll if new messages arrived
                if (hasNewMessages) {
                    setTimeout(() => {
                        messagesDiv.scrollTo({
                            top: messagesDiv.scrollHeight,
                            behavior: 'smooth'
                        });
                    }, 150);
                }
                
                lastMessageCount = currentMessageCount;
            };

            // Override renderWidgetMessages for widget
            const originalRenderWidgetMessages = renderWidgetMessages;
            renderWidgetMessages = function(messages) {
                const currentMessageCount = messages ? messages.length : 0;
                const hasNewMessages = currentMessageCount > lastWidgetMessageCount;
                
                // Call original function
                originalRenderWidgetMessages(messages);
                
                // Force auto-scroll if new messages arrived
                if (hasNewMessages) {
                    setTimeout(() => {
                        adminMessagesDiv.scrollTo({
                            top: adminMessagesDiv.scrollHeight,
                            behavior: 'smooth'
                        });
                    }, 150);
                }
                
                lastWidgetMessageCount = currentMessageCount;
            };

            // Initial load
            fetchConversations();
            convPollInterval = setInterval(fetchConversations, 5000); // Polling for new conversations
        });
    </script>
</body>
</html>
