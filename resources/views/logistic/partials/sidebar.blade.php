@php
    $currentRoute = Route::currentRouteName();
@endphp

<aside class="w-72 z-10 bg-white shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)] p-5 flex flex-col rounded-r-2xl">
    <div class="space-y-4 mt-3">

        {{-- Menu Produk --}}
        <a href="{{ route('logistic.products.index') }}"
           class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-white shadow-md
                  {{ str_contains($currentRoute, 'logistic.products')
                      ? 'bg-[#045595] cursor-default'
                      : 'bg-gradient-to-r from-[#00A6FF] to-[#045595] hover:bg-[#045595]' }}">
            {{-- Ikon Produk --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                <path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/>
            </svg>
            <span class="font-medium text-lg">Manajemen Produk</span>
        </a>

        {{-- Menu Supplier --}}
        <a href="{{ route('logistic.suppliers.index') }}"
           class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-white shadow-md
                  {{ str_contains($currentRoute, 'logistic.suppliers')
                      ? 'bg-[#045595] cursor-default'
                      : 'bg-gradient-to-r from-[#00A6FF] to-[#045595] hover:bg-[#045595]' }}">
            {{-- Ikon Supplier --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/>
                <path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/>
                <circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/>
            </svg>
            <span class="font-medium text-lg">Manajemen Supplier</span>
        </a>

    </div>
</aside>
