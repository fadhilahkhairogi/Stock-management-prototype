@extends('admin.layout')

@section('title', 'Manajemen Produk')

@section('content')
<div x-data="{ showDeleteModal: false, deleteUrl: '', deleteName: '' }">

    <div class="bg-gradient-to-b from-[#00A6FF] to-[#045595] rounded-r-2xl p-5 shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)]">

        {{-- HEADER --}}
        <div class="flex justify-start items-center mb-6">
            <h1 class="text-4xl font-extrabold">Manajemen Produk</h1>
        </div>

        <div class="flex justify-between items-center mb-3">
            {{-- CREATE BUTTON --}}
            <a href="{{ route('admin.products.create') }}"
               class="flex items-center h-9 gap-2 bg-gradient-to-r from-[#00A6FF] to-[#045595] px-4 py-2 rounded-xl shadow-lg font-semibold text-white hover:bg-[#045595] active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/>
                </svg>
                Tambah Produk
            </a>

            {{-- SEARCH BAR --}}
            <form method="GET" action="{{ route('admin.products.index') }}">
                <div class="flex items-center bg-white opacity-60 h-9 px-4 py-2 rounded-xl shadow-lg w-[322px] overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-[#464C55] mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                    </svg>
                    <input type="search" name="search" placeholder="Cari Produk..."
                           value="{{ request('search') }}"
                           class="bg-transparent text-black w-full text-[17px] placeholder-[#464C55] px-1 py-1 outline-none border-none" />
                </div>
            </form>
        </div>

        {{-- TABLE --}}
        <div class="bg-white text-black rounded-2xl shadow-xl overflow-hidden">

            {{-- TABLE HEADER --}}
            <div class="grid bg-gradient-to-r from-[#00A6FF] to-[#045595] text-white font-semibold py-4 px-5 text-xl h-20 items-center shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)]"
                 style="grid-template-columns: 60px 1fr 1fr 1fr 1fr 1fr 1fr 1fr 140px">
                <div class="flex justify-center items-center border-r-2 border-white">No.</div>
                <div class="flex justify-center items-center border-r-2 border-white">Nama</div>
                <div class="flex justify-center items-center border-r-2 border-white">Kategori</div>
                <div class="flex justify-center items-center border-r-2 border-white">Barcode</div>
                <div class="flex justify-center items-center border-r-2 border-white">Harga Beli</div>
                <div class="flex justify-center items-center border-r-2 border-white">Harga Jual</div>
                <div class="flex justify-center items-center border-r-2 border-white">Stok</div>
                <div class="flex justify-center items-center border-r-2 border-white">Min Stok</div>
                <div class="flex justify-center items-center">Action</div>
            </div>

            {{-- TABLE BODY --}}
            <div class="px-5 py-1.5 shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)]">
                @forelse($products as $index => $product)
                    <div class="grid py-4 border-b border-[#00A6FF] text-sm"
                         style="grid-template-columns: 60px 1fr 1fr 1fr 1fr 1fr 1fr 1fr 140px">
                        <div class="flex justify-center items-center">
                            {{ $products->firstItem() + $index }}.
                        </div>
                        <div class="flex justify-center items-center">{{ $product->name }}</div>
                        <div class="flex justify-center items-center">{{ $product->category->name ?? '-' }}</div>
                        <div class="flex justify-center items-center">{{ $product->barcode ?? '-' }}</div>
                        <div class="flex justify-center items-center">Rp {{ number_format($product->buy_price, 0, ',', '.') }}</div>
                        <div class="flex justify-center items-center">Rp {{ number_format($product->sell_price, 0, ',', '.') }}</div>
                        <div class="flex justify-center items-center">{{ $product->stock }}</div>
                        <div class="flex justify-center items-center">{{ $product->min_stock }}</div>

                        {{-- ACTION BUTTONS --}}
                        <div class="flex justify-center items-center gap-2">
                            {{-- EDIT --}}
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="border-2 border-[#00FF1A] text-[#00FF1A] hover:bg-[#00FF1A] hover:text-white px-3 py-1 rounded-lg text-xs active:scale-95 font-semibold shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/>
                                </svg>
                            </a>

                            {{-- DELETE --}}
                            <button type="button"
                                    @click="showDeleteModal = true; deleteUrl = '{{ route('admin.products.destroy', $product->id) }}'; deleteName = '{{ addslashes($product->name) }}'"
                                    class="border-2 border-[#FF0004] text-[#FF0004] hover:bg-[#FF0004] hover:text-white px-3 py-1 rounded-lg text-xs active:scale-95 font-semibold shadow-md cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    <line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-gray-500">Belum ada data produk.</div>
                @endforelse
            </div>
        </div>

        {{-- Paginasi --}}
        @include('admin.partials.pagination', ['paginator' => $products])

        {{-- Dashboard --}}
        <div class="mt-8 pt-6 border-t border-white/20">
            <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                Dashboard Ringkasan
            </h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                
                {{-- Kesehatan Stok --}}
                <div class="bg-white rounded-xl p-5 shadow-lg flex flex-col justify-center">
                    <div class="flex items-center gap-2 mb-2 text-black font-semibold text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                        Kesehatan Stok
                    </div>
                    <p class="text-sm text-gray-500 mb-4">Persentase jumlah stok produk di atas batas minimum</p>
                    
                    <div class="flex items-end gap-2 mb-2">
                        <span class="text-4xl font-extrabold text-black">{{ $dashboard['healthPercentage'] }}%</span>
                        <span class="text-sm text-gray-500 mb-1">Stok Terpenuhi</span>
                    </div>
                    
                    {{-- Bar --}}
                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden mt-2 relative">
                        @php
                            $healthColor = 'bg-red-500';
                            if ($dashboard['healthPercentage'] > 75) $healthColor = 'bg-[#00FF1A]';
                            elseif ($dashboard['healthPercentage'] > 45) $healthColor = 'bg-yellow-400';
                        @endphp
                        <div class="{{ $healthColor }} h-4 rounded-full transition-all duration-1000" style="width: {{ $dashboard['healthPercentage'] }}%"></div>
                    </div>

                    {{-- Info Aset --}}
                    <div class="mt-5 pt-4 border-t border-gray-100 flex justify-between items-end">
                        <div>
                            <div class="text-xs text-gray-500 mb-1">Total Modal (Beli)</div>
                            <div class="font-bold text-gray-800">Rp {{ number_format($dashboard['totalBuyValue'], 0, ',', '.') }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-gray-500 mb-1">Estimasi Nilai Jual</div>
                            <div class="font-bold text-gray-800 flex items-center justify-end gap-1">
                                Rp {{ number_format($dashboard['totalSellValue'], 0, ',', '.') }}
                                @if($dashboard['potentialProfitMargin'] > 0)
                                    <span class="text-xs bg-green-100 text-green-700 px-1.5 py-0.5 rounded font-bold">+{{ number_format($dashboard['potentialProfitMargin'], 1) }}%</span>
                                @elseif($dashboard['potentialProfitMargin'] < 0)
                                    <span class="text-xs bg-red-100 text-red-700 px-1.5 py-0.5 rounded font-bold">{{ number_format($dashboard['potentialProfitMargin'], 1) }}%</span>
                                @else
                                    <span class="text-xs bg-gray-100 text-gray-700 px-1.5 py-0.5 rounded font-bold">0%</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Info Restock --}}
                <div class="bg-white rounded-xl p-5 shadow-lg flex flex-col">
                    <div class="flex items-center gap-2 mb-3 text-black font-semibold text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" x2="12" y1="9" y2="13"/><line x1="12" x2="12.01" y1="17" y2="17"/></svg>
                        Perlu Restock
                    </div>
                    <div class="overflow-y-auto max-h-[160px] pr-2 custom-scrollbar">
                        @if($dashboard['lowStockProducts']->isEmpty())
                            <div class="flex items-center justify-center h-full text-gray-400 italic text-sm py-4">
                                Semua stok produk aman.
                            </div>
                        @else
                            <table class="w-full text-sm text-left text-gray-700">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="py-2 font-semibold">Produk</th>
                                        <th class="py-2 font-semibold text-right">Sisa</th>
                                        <th class="py-2 font-semibold text-right">Min</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dashboard['lowStockProducts'] as $lowProd)
                                        <tr class="border-b border-gray-100 last:border-0">
                                            <td class="py-2 truncate max-w-[120px]" title="{{ $lowProd->name }}">{{ $lowProd->name }}</td>
                                            <td class="py-2 text-right font-bold text-red-500">{{ $lowProd->stock }}</td>
                                            <td class="py-2 text-right text-gray-500">{{ $lowProd->min_stock }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

                {{-- Pie Chart --}}
                <div class="bg-white rounded-xl p-5 shadow-lg flex flex-col items-center justify-center min-h-[220px]">
                    @if($dashboard['pieChart'])
                        <div class="w-full pointer-events-none sm:pointer-events-auto">
                            {!! $dashboard['pieChart']->container() !!}
                        </div>
                    @else
                        <div class="text-gray-400 italic text-sm">Belum ada data stok yang cukup.</div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{-- DELETE MODAL --}}
    @include('admin.partials.delete-modal')
</div>

@if($dashboard['pieChart'])
    @push('scripts')
        <script src="{{ $dashboard['pieChart']->cdn() }}"></script>
        {!! $dashboard['pieChart']->script() !!}
    @endpush
@endif

<style>
/* Custom mini scrollbar for lists */
.custom-scrollbar::-webkit-scrollbar { width: 4px; }
.custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 4px; }
.custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }
</style>
@endsection
