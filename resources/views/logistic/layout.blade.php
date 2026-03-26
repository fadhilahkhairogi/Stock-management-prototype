<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Master Data')</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Fade Animation */
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes fadeOut { from { opacity: 1; } to { opacity: 0; } }
        .animate-fadeIn { animation: fadeIn 0.3s ease-out forwards; }
        .animate-fadeOut { animation: fadeOut 0.3s ease-in forwards; }

        /* Scale Animation */
        @keyframes scaleIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        @keyframes scaleOut { from { transform: scale(1); opacity: 1; } to { transform: scale(0.95); opacity: 0; } }
        .animate-scaleIn { animation: scaleIn 0.3s ease-out forwards; }
        .animate-scaleOut { animation: scaleOut 0.3s ease-in forwards; }

        /* Slide Animation */
        @keyframes slideIn { from { transform: translateX(120%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes slideOut { from { transform: translateX(0); opacity: 1; } to { transform: translateX(120%); opacity: 0; } }
        .animate-slideIn { animation: slideIn 0.3s ease-out forwards; }
        .animate-slideOut { animation: slideOut 0.3s ease-in forwards; }
    </style>
</head>
<body class="bg-[#00A6FF]">

    <div class="min-h-screen w-full text-white" style="background: linear-gradient(to bottom, rgba(0,0,0,0.85) 10%, rgba(0,0,0,0.57) 55%, rgba(0,0,0,1) 100%);">

        {{-- Navigasi --}}
        <header class="w-full h-32 flex items-center justify-between bg-transparent">
            <div class="h-16 ml-4.5 flex items-center">
                <img src="{{ asset('images/logo_umkm.png') }}" alt="Logo UMKM" class="h-12 w-12 rounded-full object-cover mr-3 shadow-md" />    
                <span class="text-3xl font-extrabold text-white tracking-wide">{{ config('app.name', 'UMKM App') }}</span>
            </div>
            <div class="flex items-center gap-3 mr-5">
                <span class="text-sm text-white/70">{{ Auth::user()->name ?? 'Admin' }}</span>
                <button class="p-2 rounded-full cursor-pointer border border-white hover:bg-white hover:text-gray-900 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </button>
            </div>
        </header>

        <div class="flex">
            {{-- Sidebar --}}
            @include('logistic.partials.sidebar')

            {{-- Konten Utama --}}
            <main class="flex-1 pr-5 py-8">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Alert --}}
    @include('logistic.partials.alert')

    @stack('scripts')
</body>
</html>
