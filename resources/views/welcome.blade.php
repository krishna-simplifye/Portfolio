<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Radhey Krishna | Full Stack Developer</title>

    <!-- HTML Meta Tags -->
    <meta name="description" content="A comprehensive portfolio template for full stack developers. Showcase your end-to-end development expertise with a modern and professional design.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback Tailwind CSS script for development just in case Vite isn't compiled yet -->
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
        /* Custom scrollbar */
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
            <span class="text-xl font-bold tracking-tight text-white">Dev<span class="text-sky-500">Portfolio</span></span>
            <div class="hidden md:flex space-x-8">
                <a href="#about" class="text-sm font-medium text-zinc-400 hover:text-white transition-colors">About</a>
                <a href="#skills" class="text-sm font-medium text-zinc-400 hover:text-white transition-colors">Expertise</a>
                <a href="#projects" class="text-sm font-medium text-zinc-400 hover:text-white transition-colors">Projects</a>
            </div>
            <div class="relative">
                <a href="#contact" class="px-5 py-2.5 text-sm font-semibold rounded-full bg-white/5 hover:bg-white/10 border border-white/10 transition-all text-white backdrop-blur-md flex items-center gap-2">
                    Let's Talk
                    <span id="nav-chat-badge" class="hidden bg-emerald-500 text-black text-[10px] font-extrabold h-4.5 w-4.5 rounded-full flex items-center justify-center animate-pulse px-1.5 py-0.5">0</span>
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 pt-32 pb-24">
        <!-- Hero Section -->
        <section id="about" class="py-20 md:py-32 flex flex-col items-center text-center">
            <div class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-zinc-900 border border-zinc-800 text-zinc-300 text-sm font-medium mb-8">
                <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse"></span>
                <span>Available for new opportunities</span>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6">
                <span class="block text-zinc-100 mb-2">Radhey Krishna</span>
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-sky-400 via-indigo-500 to-purple-500 h-[1.2em]">
                    Full Stack Developer
                </span>
            </h1>
            
            <p class="mt-4 text-lg md:text-xl text-zinc-400 max-w-3xl leading-relaxed">
                I craft end-to-end solutions with 8+ years of experience building scalable applications and leading development teams. Previously Senior Full Stack Developer at <span class="text-white font-medium">Stripe</span> and Tech Lead at <span class="text-white font-medium">Vercel</span>.
            </p>
            
            <div class="mt-10 flex flex-wrap justify-center gap-4">
                <a href="#projects" class="px-8 py-4 rounded-full bg-zinc-100 hover:bg-white text-black font-semibold transition-all shadow-[0_0_20px_rgba(255,255,255,0.05)] hover:shadow-[0_0_30px_rgba(255,255,255,0.1)] hover:scale-105">
                    View My Work
                </a>
                <a href="#contact-form" class="px-8 py-4 rounded-full bg-gradient-to-r from-sky-500 to-indigo-500 hover:from-sky-600 hover:to-indigo-600 text-white font-semibold transition-all hover:scale-105 shadow-[0_0_20px_rgba(59,130,246,0.3)] hover:shadow-[0_0_30px_rgba(59,130,246,0.4)]">
                    Contact Me
                </a>
            </div>
        </section>

        <!-- Expertise/Skills Section -->
        <section id="skills" class="py-20">
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-zinc-100">Core Expertise</h2>
                <div class="w-20 h-1 bg-gradient-to-r from-sky-500 to-indigo-500 rounded-full mt-4"></div>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Frontend Card -->
                <div class="relative group p-8 rounded-3xl bg-[#0a0a0a]/80 border border-zinc-900 backdrop-blur-sm hover:bg-[#0f0f0f] transition-all duration-300 hover:-translate-y-1 hover:border-sky-500/30">
                    <div class="absolute inset-0 bg-gradient-to-br from-sky-500/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 flex items-center justify-center border border-sky-500/20 mb-6 text-sky-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-zinc-200 mb-4">Frontend Development</h3>
                    <ul class="space-y-3 text-zinc-500 text-sm">
                        <li class="flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-sky-500 mr-3"></span>Modern React Architectures</li>
                        <li class="flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-sky-500 mr-3"></span>Performance Optimization</li>
                        <li class="flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-sky-500 mr-3"></span>Responsive & Interactive UIs</li>
                    </ul>
                </div>

                <!-- Backend Card -->
                <div class="relative group p-8 rounded-3xl bg-[#0a0a0a]/80 border border-zinc-900 backdrop-blur-sm hover:bg-[#0f0f0f] transition-all duration-300 hover:-translate-y-1 hover:border-indigo-500/30">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 flex items-center justify-center border border-indigo-500/20 mb-6 text-indigo-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-zinc-200 mb-4">Backend Development</h3>
                    <ul class="space-y-3 text-zinc-500 text-sm">
                        <li class="flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-3"></span>API Design & Development</li>
                        <li class="flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-3"></span>Database Architecture</li>
                        <li class="flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-3"></span>Real-time Systems</li>
                    </ul>
                </div>

                <!-- DevOps Card -->
                <div class="relative group p-8 rounded-3xl bg-[#0a0a0a]/80 border border-zinc-900 backdrop-blur-sm hover:bg-[#0f0f0f] transition-all duration-300 hover:-translate-y-1 hover:border-purple-500/30">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 flex items-center justify-center border border-purple-500/20 mb-6 text-purple-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-zinc-200 mb-4">DevOps & Cloud</h3>
                    <ul class="space-y-3 text-zinc-500 text-sm">
                        <li class="flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-purple-500 mr-3"></span>AWS Infrastructure</li>
                        <li class="flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-purple-500 mr-3"></span>CI/CD Pipelines</li>
                        <li class="flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-purple-500 mr-3"></span>Scalable Architecture</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Projects Section -->
        <section id="projects" class="py-20">
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-zinc-100">Full Stack Projects</h2>
                <div class="w-20 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mt-4"></div>
            </div>

            <div class="space-y-12">
                <!-- Project 1 -->
                <div class="group relative bg-[#0a0a0a]/50 border border-zinc-900 rounded-[2rem] p-6 md:p-10 overflow-hidden hover:bg-[#0f0f0f] transition-colors">
                    <div class="absolute right-0 top-0 w-[60%] h-full bg-gradient-to-l from-indigo-500/5 to-transparent pointer-events-none"></div>
                    
                    <div class="grid md:grid-cols-2 gap-12 items-center relative z-10">
                        <div>
                            <div class="mb-6 flex flex-wrap gap-2">
                                <span class="px-3 py-1 rounded-full bg-zinc-900 text-xs font-semibold text-zinc-400 border border-zinc-800">React.js</span>
                                <span class="px-3 py-1 rounded-full bg-zinc-900 text-xs font-semibold text-zinc-400 border border-zinc-800">Laravel</span>
                                <span class="px-3 py-1 rounded-full bg-zinc-900 text-xs font-semibold text-zinc-400 border border-zinc-800">Mysql</span>
                                <span class="px-3 py-1 rounded-full bg-zinc-900 text-xs font-semibold text-zinc-400 border border-zinc-800">Python</span>
                            </div>
                            <h3 class="text-2xl font-bold text-zinc-100 mb-4">Enterprise E-commerce Platform</h3>
                            <p class="text-zinc-500 mb-8 leading-relaxed">
                                A high-performance e-commerce solution handling 100K+ daily transactions with real-time inventory and ML-powered recommendations.
                            </p>
                            
                            <div class="grid grid-cols-2 gap-6 mb-8">
                                <div>
                                    <h4 class="text-xs font-bold text-zinc-600 mb-3 uppercase tracking-widest">Frontend</h4>
                                    <ul class="space-y-2 text-sm text-zinc-500">
                                        <li class="flex items-center"><svg class="w-4 h-4 text-zinc-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Next.js Server Components</li>
                                        <li class="flex items-center"><svg class="w-4 h-4 text-zinc-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Real-time Cart</li>
                                        <li class="flex items-center"><svg class="w-4 h-4 text-zinc-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Stripe Integration</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-zinc-600 mb-3 uppercase tracking-widest">Backend</h4>
                                    <ul class="space-y-2 text-sm text-zinc-500">
                                        <li class="flex items-center"><svg class="w-4 h-4 text-zinc-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Node.js Microservices</li>
                                        <li class="flex items-center"><svg class="w-4 h-4 text-zinc-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Redis Caching</li>
                                        <li class="flex items-center"><svg class="w-4 h-4 text-zinc-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Kafka Streaming</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="flex items-center px-4 py-3 bg-[#0a0a0a] border border-zinc-900 rounded-xl">
                                <svg class="w-5 h-5 text-indigo-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                <span class="text-sm text-zinc-400 font-medium">99.99% Uptime • 300ms Avg Response</span>
                            </div>
                        </div>
                        
                        <div class="relative h-64 md:h-[420px] w-full rounded-2xl bg-[#050505] border border-zinc-900 overflow-hidden flex items-center justify-center group-hover:border-zinc-800 transition-colors shadow-2xl">
                            <div class="absolute inset-0 bg-grid-pattern opacity-[0.1]"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                            
                            <div class="relative z-10 flex flex-col items-center p-8 text-center">
                                <div class="w-20 h-20 bg-zinc-900/50 rounded-2xl flex items-center justify-center border border-zinc-800/50 mb-6 shadow-[0_0_30px_rgba(79,70,229,0.1)] group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                                </div>
                                <span class="text-zinc-500 font-bold tracking-widest uppercase text-xs">System Architecture</span>
                                <div class="mt-4 flex gap-2 justify-center opacity-40">
                                    <div class="h-1 w-8 bg-zinc-700 rounded"></div>
                                    <div class="h-1 w-4 bg-zinc-700 rounded"></div>
                                    <div class="h-1 w-12 bg-zinc-700 rounded"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project 2 -->
                <div class="group relative bg-[#0a0a0a]/50 border border-zinc-900 rounded-[2rem] p-6 md:p-10 overflow-hidden hover:bg-[#0f0f0f] transition-colors">
                    <div class="absolute right-0 top-0 w-[60%] h-full bg-gradient-to-l from-purple-500/5 to-transparent pointer-events-none"></div>
                    
                    <div class="grid md:grid-cols-2 gap-12 items-center relative z-10 md:flex-row-reverse flex-col-reverse">
                        
                        <div class="relative h-64 md:h-[420px] w-full rounded-2xl bg-[#050505] border border-zinc-900 overflow-hidden flex items-center justify-center group-hover:border-zinc-800 transition-colors shadow-2xl md:order-1 order-2">
                            <div class="absolute inset-0 bg-grid-pattern opacity-[0.1]"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                            
                            <div class="relative z-10 flex flex-col items-center p-8 text-center">
                                <div class="w-20 h-20 bg-zinc-900/50 rounded-2xl flex items-center justify-center border border-zinc-800/50 mb-6 shadow-[0_0_30px_rgba(168,85,247,0.1)] group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-10 h-10 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                </div>
                                <span class="text-zinc-500 font-bold tracking-widest uppercase text-xs">Data Flow Model</span>
                                <div class="mt-4 flex gap-2 justify-center opacity-40">
                                    <div class="h-8 w-2 bg-zinc-700 rounded"></div>
                                    <div class="h-12 w-2 bg-zinc-700 rounded"></div>
                                    <div class="h-6 w-2 bg-zinc-700 rounded"></div>
                                    <div class="h-10 w-2 bg-zinc-700 rounded"></div>
                                </div>
                            </div>
                        </div>

                        <div class="md:order-2 order-1">
                            <div class="mb-6 flex flex-wrap gap-2">
                                <span class="px-3 py-1 rounded-full bg-zinc-900 text-xs font-semibold text-zinc-400 border border-zinc-800">React</span>
                                <span class="px-3 py-1 rounded-full bg-zinc-900 text-xs font-semibold text-zinc-400 border border-zinc-800">Python</span>
                                <span class="px-3 py-1 rounded-full bg-zinc-900 text-xs font-semibold text-zinc-400 border border-zinc-800">ClickHouse</span>
                            </div>
                            <h3 class="text-2xl font-bold text-zinc-100 mb-4">Real-time Analytics Platform</h3>
                            <p class="text-zinc-500 mb-8 leading-relaxed">
                                A scalable analytics platform processing 1M+ events per minute with real-time dashboards and ML-powered insights.
                            </p>
                            
                            <div class="grid grid-cols-2 gap-6 mb-8">
                                <div>
                                    <h4 class="text-xs font-bold text-zinc-600 mb-3 uppercase tracking-widest">Frontend</h4>
                                    <ul class="space-y-2 text-sm text-zinc-500">
                                        <li class="flex items-center"><svg class="w-4 h-4 text-zinc-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Data Visualization</li>
                                        <li class="flex items-center"><svg class="w-4 h-4 text-zinc-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Interactive Dashboards</li>
                                        <li class="flex items-center"><svg class="w-4 h-4 text-zinc-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Custom Charts</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-zinc-600 mb-3 uppercase tracking-widest">Backend</h4>
                                    <ul class="space-y-2 text-sm text-zinc-500">
                                        <li class="flex items-center"><svg class="w-4 h-4 text-zinc-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Kafka Streams</li>
                                        <li class="flex items-center"><svg class="w-4 h-4 text-zinc-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> ClickHouse DB</li>
                                        <li class="flex items-center"><svg class="w-4 h-4 text-zinc-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg> Python Processing</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="flex items-center px-4 py-3 bg-[#0a0a0a] border border-zinc-900 rounded-xl">
                                <svg class="w-5 h-5 text-purple-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                <span class="text-sm text-zinc-400 font-medium">1M+ Events/Min • Sub-second Query</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-24">
            <div class="relative bg-transparent text-center">
                <!-- Decorative Elements -->
                <div class="absolute inset-0 pointer-events-none">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-purple-600/10 rounded-full blur-[100px] translate-x-1/3 -translate-y-1/3"></div>
                    <div class="absolute bottom-0 left-0 w-96 h-96 bg-sky-600/10 rounded-full blur-[100px] -translate-x-1/3 translate-y-1/3"></div>
                </div>
                
                <div class="relative z-10 px-6 max-w-2xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4 tracking-tight">Let's Build Something Amazing</h2>
                    <p class="text-[15px] text-zinc-400 mb-6">
                        Looking for a full-stack developer who can architect and implement complete solutions? Let's discuss your project.
                    </p>
                    
                    <div class="flex items-center justify-center text-zinc-400 text-sm mb-10">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Mathura, India
                    </div>

                    <!-- Success and errors are now handled by SweetAlert2 Popups below -->

                    <form id="contact-form" class="text-left space-y-5" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block text-[13px] font-medium text-zinc-300 mb-1.5">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full bg-[#1e293b]/70 border @error('name') border-red-500 @else border-transparent @enderror focus:border-indigo-500 focus:bg-[#1e293b] focus:ring-1 focus:ring-indigo-500 text-white text-sm rounded-lg py-3 px-4 transition-colors" required>
                            @error('name')
                                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-[13px] font-medium text-zinc-300 mb-1.5">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full bg-[#1e293b]/70 border @error('email') border-red-500 @else border-transparent @enderror focus:border-indigo-500 focus:bg-[#1e293b] focus:ring-1 focus:ring-indigo-500 text-white text-sm rounded-lg py-3 px-4 transition-colors" required>
                            @error('email')
                                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="message" class="block text-[13px] font-medium text-zinc-300 mb-1.5">Message</label>
                            <textarea id="message" name="message" rows="5" class="w-full bg-[#1e293b]/70 border @error('message') border-red-500 @else border-transparent @enderror focus:border-indigo-500 focus:bg-[#1e293b] focus:ring-1 focus:ring-indigo-500 text-white text-sm rounded-lg py-3 px-4 transition-colors resize-none" required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full font-semibold text-white py-3 px-4 rounded-lg bg-gradient-to-r from-[#4f46e5] to-[#a855f7] hover:opacity-90 transition-opacity">
                            Send Message
                        </button>
                    </form>

                    <div class="mt-8 flex justify-center">
                        <a href="#" class="inline-flex items-center px-6 py-2.5 rounded-lg border border-zinc-800 bg-transparent hover:bg-zinc-900 text-white text-sm font-medium transition-all">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 2l5 5h-5V4z"></path></svg>
                            View Resume
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="border-t border-zinc-900 bg-black mt-10">
        <div class="max-w-6xl mx-auto px-6 py-12 flex flex-col md:flex-row justify-between items-center text-zinc-500 text-sm">
            <div class="flex items-center gap-2 mb-4 md:mb-0">
                <span class="font-bold text-zinc-300">DevPortfolio</span>
                <span>&copy; {{ date('Y') }} Radhey Krishna. All rights reserved.</span>
            </div>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-zinc-300 transition-colors">GitHub</a>
                <a href="#" class="hover:text-zinc-300 transition-colors">LinkedIn</a>
                <a href="#" class="hover:text-zinc-300 transition-colors">Twitter</a>
            </div>
        </div>
    </footer>

    @if(session('success') || $errors->any())
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: '{!! session("success") !!}',
                    icon: 'success',
                    confirmButtonColor: '#4f46e5',
                    background: '#18181b',
                    color: '#fff'
                });
            @elseif($errors->any())
                Swal.fire({
                    title: 'Error',
                    text: '{!! $errors->first() !!}',
                    icon: 'error',
                    confirmButtonColor: '#ef4444',
                    background: '#18181b',
                    color: '#fff'
                });
            @endif
        });
    </script>
    @endif

    <!-- WhatsApp Widget -->
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
            const toggleBtns = document.querySelectorAll('a[href="#contact"]');
            const widget = document.getElementById('wa-widget');
            const closeBtn = document.getElementById('close-wa-btn');
            const messagesDiv = document.getElementById('wa-messages');
            const inputField = document.getElementById('wa-input');
            const sendBtn = document.getElementById('wa-send');
            const badge = document.getElementById('nav-chat-badge');

            let deviceId = localStorage.getItem('chat_device_id');
            if (!deviceId) {
                deviceId = 'guest_' + Math.random().toString(36).substr(2, 9);
                localStorage.setItem('chat_device_id', deviceId);
            }

            let pollInterval = null;

            async function checkUnreadCount() {
                if (!widget.classList.contains('hidden')) {
                    if (badge) badge.classList.add('hidden');
                    return;
                }
                try {
                    const res = await fetch('/chat/unread-count', {
                        headers: { 'X-Device-Id': deviceId, 'Accept': 'application/json' }
                    });
                    const data = await res.json();
                    const count = data.unread_count || 0;
                    if (count > 0 && badge) {
                        badge.innerText = count;
                        badge.classList.remove('hidden');
                    } else if (badge) {
                        badge.classList.add('hidden');
                    }
                } catch (e) { console.error('Error fetching unread count', e); }
            }

            checkUnreadCount();
            setInterval(checkUnreadCount, 10000);

            toggleBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault(); 
                    widget.classList.remove('hidden');
                    if (badge) badge.classList.add('hidden');
                    fetchMessages();
                    if(!pollInterval) {
                        pollInterval = setInterval(fetchMessages, 3000);
                    }
                });
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
                const isClickOnToggleButton = Array.from(toggleBtns).some(btn => btn.contains(e.target));
                
                if (!isClickInsideWidget && !isClickOnToggleButton) {
                    widget.classList.add('hidden');
                    if(pollInterval) {
                        clearInterval(pollInterval);
                        pollInterval = null;
                    }
                }
            });

            function renderMessages(messages) {
                if(messages.length === 0) {
                   messagesDiv.innerHTML = `
                       <div class="flex justify-center mb-4">
                           <span class="bg-[#182229] text-zinc-400 text-xs px-3 py-1 rounded-md shadow-sm border border-zinc-700/30">Connect with me directly via WhatsApp Chat</span>
                       </div>
                   `;
                   return;
                }

                let isAtBottom = messagesDiv.scrollHeight - messagesDiv.scrollTop <= messagesDiv.clientHeight + 50;

                const html = messages.map(m => {
                    const isMine = !m.is_admin;
                    const time = new Date(m.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                    return `
                        <div class="flex ${isMine ? 'justify-end' : 'justify-start'} w-full">
                            <div class="${isMine ? 'bg-[#005c4b]' : 'bg-[#202c33]'} text-[#e9edef] max-w-[85%] rounded-lg px-3 py-1.5 shadow-sm content-block">
                                <p class="text-[14px] leading-relaxed" style="word-break: break-word;">${m.message.replace(/</g, "&lt;").replace(/>/g, "&gt;")}</p>
                                <span class="text-[10px] text-zinc-400 block text-right mt-1 shrink-0">${time}</span>
                            </div>
                        </div>
                    `;
                }).join('');
                
                messagesDiv.innerHTML = html;
                
                if(isAtBottom) {
                    messagesDiv.scrollTop = messagesDiv.scrollHeight;
                }
            }

            async function fetchMessages() {
                try {
                    const res = await fetch('/chat/messages', {
                        headers: { 'X-Device-Id': deviceId, 'Accept': 'application/json' }
                    });
                    const data = await res.json();
                    renderMessages(data.messages || []);
                } catch (e) { console.error('Chat error', e); }
            }

            async function sendMessage() {
                const text = inputField.value.trim();
                if (!text) return;

                inputField.value = '';
                inputField.disabled = true;
                sendBtn.disabled = true;

                try {
                    const res = await fetch('/chat/message', {
                        method: 'POST',
                        headers: { 
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Device-Id': deviceId 
                        },
                        body: JSON.stringify({ message: text })
                    });
                    
                    messagesDiv.scrollTop = messagesDiv.scrollHeight;
                    await fetchMessages();
                } catch (e) {
                    console.error('Failed to send', e);
                } finally {
                    inputField.disabled = false;
                    sendBtn.disabled = false;
                    inputField.focus();
                }
            }

            sendBtn.addEventListener('click', sendMessage);
            inputField.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') sendMessage();
            });
        });
    </script>
</body>
</html>
