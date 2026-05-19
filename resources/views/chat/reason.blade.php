<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Start Chat - Reason for Chat</title>

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
            <div class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-zinc-900 border border-zinc-800 text-zinc-300 text-sm font-medium mb-8">
                <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse"></span>
                <span>Step 2 of 3</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-6">
                <span class="block text-zinc-100 mb-2">Almost There</span>
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-sky-400 via-indigo-500 to-purple-500">
                    Why Chat With Me?
                </span>
            </h1>
            
            <p class="text-lg text-zinc-400 max-w-2xl leading-relaxed">
                Please tell me why you'd like to start a chat. This helps me provide better assistance.
            </p>

            <!-- Display selected country and mobile info -->
            <div class="mt-6 inline-flex items-center space-x-4 px-4 py-2 rounded-full bg-zinc-900/50 border border-zinc-800 text-zinc-300 text-sm">
                <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>{{ session('chat_country') }} - {{ session('chat_mobile') }}</span>
            </div>
        </div>

        <div class="relative bg-[#0a0a0a]/50 border border-zinc-900 rounded-[2rem] p-8 md:p-12 backdrop-blur-sm">
            <form action="{{ route('chat.reason.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="reason" class="block text-sm font-medium text-zinc-300 mb-2">Reason for Chat</label>
                    <textarea id="reason" name="reason" rows="4" required
                              placeholder="e.g., I'd like to discuss a project collaboration, ask about your services, or get technical advice..."
                              class="w-full bg-[#1e293b]/70 border border-transparent focus:border-indigo-500 focus:bg-[#1e293b] focus:ring-1 focus:ring-indigo-500 text-white text-sm rounded-lg py-3 px-4 transition-colors resize-none">{{ old('reason') }}</textarea>
                    @error('reason')
                        <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Quick options -->
                <div>
                    <p class="text-xs font-medium text-zinc-500 mb-3">Or select a common reason:</p>
                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" onclick="setReason('Project collaboration inquiry')" 
                                class="px-4 py-2 rounded-lg bg-zinc-900/50 border border-zinc-800 text-zinc-300 text-sm hover:bg-zinc-900 hover:border-zinc-700 transition-all">
                            Project Collaboration
                        </button>
                        <button type="button" onclick="setReason('Technical consultation')" 
                                class="px-4 py-2 rounded-lg bg-zinc-900/50 border border-zinc-800 text-zinc-300 text-sm hover:bg-zinc-900 hover:border-zinc-700 transition-all">
                            Technical Consultation
                        </button>
                        <button type="button" onclick="setReason('Service inquiry')" 
                                class="px-4 py-2 rounded-lg bg-zinc-900/50 border border-zinc-800 text-zinc-300 text-sm hover:bg-zinc-900 hover:border-zinc-700 transition-all">
                            Service Inquiry
                        </button>
                        <button type="button" onclick="setReason('General question')" 
                                class="px-4 py-2 rounded-lg bg-zinc-900/50 border border-zinc-800 text-zinc-300 text-sm hover:bg-zinc-900 hover:border-zinc-700 transition-all">
                            General Question
                        </button>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                            class="w-full font-semibold text-white py-3 px-4 rounded-lg bg-gradient-to-r from-[#4f46e5] to-[#a855f7] hover:opacity-90 transition-opacity">
                        Start Chat
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('chat.country') }}" class="text-zinc-400 hover:text-zinc-300 text-sm transition-colors">
                    Back to Previous Step
                </a>
            </div>
        </div>
    </main>

    <script>
        function setReason(reason) {
            document.getElementById('reason').value = reason;
        }
    </script>
</body>
</html>
