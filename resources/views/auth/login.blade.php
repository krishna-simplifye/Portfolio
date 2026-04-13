<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | Portfolio</title>
    
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
<body class="bg-black text-zinc-100 antialiased min-h-screen relative flex items-center justify-center overflow-hidden">

    <!-- Ambient Glow Effects -->
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-indigo-600/10 blur-[130px] rounded-full"></div>
    </div>

    <div class="w-full max-w-md px-6">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-white tracking-tight mb-2">Welcome Back</h1>
            <p class="text-zinc-500 text-sm">Sign in to securely access the portfolio dashboard.</p>
        </div>

        <div class="bg-[#0a0a0a]/80 backdrop-blur-md border border-zinc-900 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
            <!-- decorative overlay -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-sky-500/5 blur-[50px] rounded-full"></div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6 relative z-10">
                @csrf
                
                @if($errors->any())
                    <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label for="email" class="block text-sm font-medium text-zinc-400 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full bg-[#18181b] border border-zinc-800 focus:border-indigo-500 focus:bg-[#202024] focus:ring-1 focus:ring-indigo-500 text-white rounded-xl py-3 px-4 transition-colors" required autofocus placeholder="admin@example.com">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-zinc-400 mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full bg-[#18181b] border border-zinc-800 focus:border-indigo-500 focus:bg-[#202024] focus:ring-1 focus:ring-indigo-500 text-white rounded-xl py-3 px-4 transition-colors" required placeholder="••••••••">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 px-4 rounded-xl font-bold text-white bg-gradient-to-r from-[#4f46e5] to-[#a855f7] hover:opacity-90 shadow-[0_0_20px_rgba(79,70,229,0.3)] transition-opacity">
                        Authenticate Securely
                    </button>
                    
                    <a href="/" class="block text-center text-sm text-zinc-500 hover:text-zinc-300 transition-colors mt-6 font-medium">
                        &larr; Return to Portfolio site
                    </a>
                </div>
            </form>
        </div>
        
    </div>

</body>
</html>
