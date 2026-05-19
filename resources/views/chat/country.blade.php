<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Start Chat - Country Selection</title>

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
                <span>Step 1 of 3</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-6">
                <span class="block text-zinc-100 mb-2">Let's Get Started</span>
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-sky-400 via-indigo-500 to-purple-500">
                    Country & Mobile
                </span>
            </h1>
            
            <p class="text-lg text-zinc-400 max-w-2xl leading-relaxed">
                Please provide your country and mobile number to start the chat process.
            </p>
        </div>

        <div class="relative bg-[#0a0a0a]/50 border border-zinc-900 rounded-[2rem] p-8 md:p-12 backdrop-blur-sm">
            <form action="{{ route('chat.country.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="country" class="block text-sm font-medium text-zinc-300 mb-2">Country</label>
                    <select id="country" name="country" required
                            class="w-full bg-[#1e293b]/70 border border-transparent focus:border-indigo-500 focus:bg-[#1e293b] focus:ring-1 focus:ring-indigo-500 text-white text-sm rounded-lg py-3 px-4 transition-colors">
                        <option value="">Select your country</option>
                        <option value="United States">United States</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="Canada">Canada</option>
                        <option value="Australia">Australia</option>
                        <option value="India">India</option>
                        <option value="Germany">Germany</option>
                        <option value="France">France</option>
                        <option value="Italy">Italy</option>
                        <option value="Spain">Spain</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Japan">Japan</option>
                        <option value="China">China</option>
                        <option value="South Korea">South Korea</option>
                        <option value="Singapore">Singapore</option>
                        <option value="UAE">United Arab Emirates</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Other">Other</option>
                    </select>
                    @error('country')
                        <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="mobile" class="block text-sm font-medium text-zinc-300 mb-2">Mobile Number</label>
                    <input type="tel" id="mobile" name="mobile" value="{{ old('mobile') }}" required
                           placeholder="+1 234 567 8900"
                           class="w-full bg-[#1e293b]/70 border border-transparent focus:border-indigo-500 focus:bg-[#1e293b] focus:ring-1 focus:ring-indigo-500 text-white text-sm rounded-lg py-3 px-4 transition-colors">
                    @error('mobile')
                        <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" 
                            class="w-full font-semibold text-white py-3 px-4 rounded-lg bg-gradient-to-r from-[#4f46e5] to-[#a855f7] hover:opacity-90 transition-opacity">
                        Continue to Next Step
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('welcome') }}" class="text-zinc-400 hover:text-zinc-300 text-sm transition-colors">
                    Back to Home
                </a>
            </div>
        </div>
    </main>
</body>
</html>
