@extends('admin.layout')

@section('title', 'Tambah Produk')

@section('content')
<div class="bg-gradient-to-b from-[#00A6FF] to-[#045595] rounded-r-2xl p-5 shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)]">

    {{-- Header --}}
    <div class="flex justify-start items-center mb-6">
        <h1 class="text-4xl font-extrabold">Tambah Produk</h1>
    </div>

    {{-- Form --}}
    <div class="bg-white text-black rounded-xl shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)] p-6">

        {{-- Judul Form --}}
        <div class="pb-6">
            <h2 class="flex items-center gap-1.5 text-2xl text-white rounded-xl shadow-md font-bold px-4 py-2 bg-gradient-to-r from-[#00A6FF] to-[#045595]">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/>
                </svg>
                Tambah Produk Baru
            </h2>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf

            <div class="rounded-2xl shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25)] px-6 py-6 space-y-4"
                 x-data="{
                     isCategoryOpen: false,
                     categoryId: '{{ old('category_id') }}',
                     categoryName: '{{ old('category_id') ? $categories->find(old('category_id'))?->name : '' }}'
                 }">

                {{-- Nama Produk --}}
                <div class="flex flex-col w-full">
                    <label class="text-lg mb-1 font-medium">Nama Produk</label>
                    <input type="text" name="name" placeholder="Masukkan nama produk" value="{{ old('name') }}"
                           class="w-full p-2.5 border border-[#00A6FF] rounded-[13px]" required />
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Kategori --}}
                    <div class="flex flex-col w-full">
                        <label class="text-lg mb-1 font-medium">Kategori</label>
                        <div class="relative">
                            <button type="button" @click="isCategoryOpen = !isCategoryOpen"
                                    class="w-full p-2.5 border border-[#00A6FF] rounded-[13px] bg-white flex justify-between items-center">
                                <span :class="categoryName ? 'text-black' : 'text-gray-400'" x-text="categoryName || 'Pilih Kategori'"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <template x-if="isCategoryOpen"><path d="m18 15-6-6-6 6"/></template>
                                    <template x-if="!isCategoryOpen"><path d="m6 9 6 6 6-6"/></template>
                                </svg>
                            </button>
                            <ul x-show="isCategoryOpen" @click.away="isCategoryOpen = false" x-transition
                                class="absolute z-10 mt-1 w-full bg-white border border-[#00A6FF] rounded-[13px] shadow-md max-h-48 overflow-y-auto">
                                @foreach($categories as $category)
                                    <li @click="categoryId = '{{ $category->id }}'; categoryName = '{{ $category->name }}'; isCategoryOpen = false"
                                        class="px-3 py-2 cursor-pointer hover:bg-blue-100">{{ $category->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="category_id" :value="categoryId" required />
                        @error('category_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Barcode --}}
                    <div class="flex flex-col w-full">
                        <label class="text-lg mb-1 font-medium">Barcode</label>
                        <input type="text" name="barcode" placeholder="Masukkan barcode (opsional)" value="{{ old('barcode') }}"
                               class="w-full p-2.5 border border-[#00A6FF] rounded-[13px]" />
                        @error('barcode') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Harga Beli --}}
                    <div class="flex flex-col w-full">
                        <label class="text-lg mb-1 font-medium">Harga Beli</label>
                        <input type="number" name="buy_price" placeholder="Masukkan harga beli" value="{{ old('buy_price') }}"
                               class="w-full p-2.5 border border-[#00A6FF] rounded-[13px]" required />
                        @error('buy_price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Harga Jual --}}
                    <div class="flex flex-col w-full">
                        <label class="text-lg mb-1 font-medium">Harga Jual</label>
                        <input type="number" name="sell_price" placeholder="Masukkan harga jual" value="{{ old('sell_price') }}"
                               class="w-full p-2.5 border border-[#00A6FF] rounded-[13px]" required />
                        @error('sell_price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Stok Aktif --}}
                    <div class="flex flex-col w-full">
                        <label class="text-lg mb-1 font-medium">Stok</label>
                        <input type="number" name="stock" placeholder="Masukkan jumlah stok" value="{{ old('stock', 0) }}"
                               class="w-full p-2.5 border border-[#00A6FF] rounded-[13px]" required />
                        @error('stock') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Min Stok --}}
                    <div class="flex flex-col w-full">
                        <label class="text-lg mb-1 font-medium">Minimum Stok</label>
                        <input type="number" name="min_stock" placeholder="Batas notifikasi stok minimum" value="{{ old('min_stock', 0) }}"
                               class="w-full p-2.5 border border-[#00A6FF] rounded-[13px]" required />
                        @error('min_stock') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Tombol Bawah --}}
            <div class="pt-6 flex justify-end gap-3">
                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center gap-1.5 px-4 py-2 rounded-lg bg-[#FF0004] text-white font-semibold hover:bg-[#b90003] active:scale-95 shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)]">
                    ✕ Batal
                </a>
                <button type="submit"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-lg bg-[#00FF1A] hover:bg-[#00df16] active:scale-95 text-white font-semibold shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)]">
                    ✓ Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
