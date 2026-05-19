<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard | Client Forms</title>

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
    </style>
</head>
<body class="bg-black text-zinc-100 antialiased min-h-screen relative overflow-x-hidden">

    <!-- Ambient Background Effects -->
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-purple-600/10 blur-[150px] rounded-full translate-x-1/3 -translate-y-1/3"></div>
    </div>

    <!-- Navigation -->
    <nav class="w-full z-50 bg-black/70 backdrop-blur-lg border-b border-white/5 transition-all">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <a href="/" class="text-xl font-bold tracking-tight text-white hover:opacity-80 transition-opacity">Dev<span class="text-sky-500">Portfolio</span></a>
            <div class="flex items-center space-x-4">
                <a href="/admin" class="px-5 py-2.5 text-sm font-semibold rounded-full {{ request()->is('admin') ? 'bg-zinc-900 border-zinc-800 text-white' : 'text-zinc-400 hover:text-white' }} border border-transparent hidden sm:block transition-colors">Form Submissions</a>
                <a href="/admin/chat" class="px-5 py-2.5 text-sm font-semibold rounded-full {{ request()->is('admin/chat') ? 'bg-zinc-900 border-zinc-800 text-white' : 'text-zinc-400 hover:text-white' }} border border-transparent hidden sm:block transition-colors">Private Chat</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-5 py-2.5 text-sm font-semibold rounded-full bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 text-red-400 transition-all">Sign Out</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight mb-2">Form Submissions</h1>
                <p class="text-zinc-400">View and manage applications & inquiries from your portfolio.</p>
            </div>
            
            <div class="mt-4 md:mt-0 flex items-center space-x-2 px-4 py-2 bg-[#0a0a0a] border border-zinc-800 rounded-lg shadow-xl text-sm font-medium">
                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                <span class="text-zinc-300">Total Entries: </span>
                <span class="text-white font-bold">{{ $contacts->count() }}</span>
            </div>
        </div>

        <div class="bg-[#0a0a0a]/80 backdrop-blur-md border border-zinc-900 rounded-2xl shadow-2xl overflow-hidden">
            @if($contacts->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-900/50 text-zinc-400 text-xs uppercase tracking-wider border-b border-zinc-800">
                            <th class="px-6 py-5 font-semibold">Client Name</th>
                            <th class="px-6 py-5 font-semibold">Contact Email</th>
                            <th class="px-6 py-5 font-semibold w-1/2">Message Query</th>
                            <th class="px-6 py-5 font-semibold text-right">Received At</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50">
                        @foreach($contacts as $contact)
                        <tr class="hover:bg-zinc-900/30 transition-colors group">
                            <td class="px-6 py-5">
                                <div class="flex items-center text-sm">
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold mr-3 shadow-lg flex-shrink-0">
                                        {{ substr($contact->name, 0, 1) }}
                                    </div>
                                    <span class="font-medium text-zinc-200">{{ $contact->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-sm text-zinc-400 group-hover:text-sky-400 transition-colors">
                                    {{ $contact->email }}
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm text-zinc-400 bg-[#050505] border border-zinc-900 p-4 rounded-xl leading-relaxed whitespace-pre-wrap break-words border-l-2 border-l-indigo-500/50">{{ $contact->message }}</div>
                            </td>
                            <td class="px-6 py-5 text-right whitespace-nowrap">
                                <span class="text-xs font-semibold text-zinc-500 bg-zinc-900 py-1.5 px-3 rounded-full border border-zinc-800">
                                    {{ $contact->created_at->format('M j, Y - g:i A') }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-16 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-zinc-900 rounded-full flex items-center justify-center mb-6 border border-zinc-800">
                    <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">No Submissions Yet</h3>
                <p class="text-zinc-500 max-w-sm">When clients fill out your contact form, their applications will securely appear here.</p>
            </div>
            @endif
        </div>
    </main>

</body>
</html>
