{{-- Alert --}}
@if(session('success') || session('error'))
<div x-data="{ show: true, closing: false }"
     x-init="setTimeout(() => { closing = true; setTimeout(() => show = false, 300) }, 2500)"
     x-show="show"
     class="fixed top-6 right-6 z-[999]"
     :class="closing ? 'animate-slideOut' : 'animate-slideIn'">

    <div class="flex items-center gap-1.5 px-5 py-4 rounded-xl shadow-lg text-white
                {{ session('success') ? 'bg-gradient-to-r from-[#00FF1A] to-[#00df16]' : 'bg-gradient-to-r from-[#FF0004] to-[#b90003]' }}">

        @if(session('success'))
            {{-- Ikon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="size-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/>
            </svg>
        @else
            {{-- Ikon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="size-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/>
            </svg>
        @endif

        <span class="font-semibold">{{ session('success') ?? session('error') }}</span>

        <button @click="closing = true; setTimeout(() => show = false, 300)" class="text-white/80 hover:text-white ml-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
            </svg>
        </button>
    </div>
</div>
@endif
