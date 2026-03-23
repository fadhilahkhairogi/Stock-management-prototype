@extends('admin.layout')

@section('title', 'Manajemen Supplier')

@section('content')
<div x-data="{ showDeleteModal: false, deleteUrl: '', deleteName: '' }">

    <div class="bg-gradient-to-b from-[#00A6FF] to-[#045595] rounded-r-2xl p-5 shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)]">

        {{-- Header --}}
        <div class="flex justify-start items-center mb-6">
            <h1 class="text-4xl font-extrabold">Manajemen Supplier</h1>
        </div>

        <div class="flex justify-between items-center mb-3">
            {{-- Tombol Tambah --}}
            <a href="{{ route('admin.suppliers.create') }}"
               class="flex items-center h-9 gap-2 bg-gradient-to-r from-[#00A6FF] to-[#045595] px-4 py-2 rounded-xl shadow-lg font-semibold text-white hover:bg-[#045595] active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/>
                </svg>
                Tambah Supplier
            </a>

            {{-- Form Pencarian --}}
            <form method="GET" action="{{ route('admin.suppliers.index') }}">
                <div class="flex items-center bg-white opacity-60 h-9 px-4 py-2 rounded-xl shadow-lg w-[322px] overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-[#464C55] mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                    </svg>
                    <input type="search" name="search" placeholder="Cari Supplier..."
                           value="{{ request('search') }}"
                           class="bg-transparent text-black w-full text-[17px] placeholder-[#464C55] px-1 py-1 outline-none border-none" />
                </div>
            </form>
        </div>

        {{-- Tabel Data --}}
        <div class="bg-white text-black rounded-2xl shadow-xl overflow-hidden">

            {{-- Kolom Tabel --}}
            <div class="grid bg-gradient-to-r from-[#00A6FF] to-[#045595] text-white font-semibold py-4 px-5 text-xl h-20 items-center shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)]"
                 style="grid-template-columns: 80px 1fr 1fr 1.5fr 140px">
                <div class="flex justify-center items-center border-r-2 border-white">No.</div>
                <div class="flex justify-center items-center border-r-2 border-white">Nama</div>
                <div class="flex justify-center items-center border-r-2 border-white">Kontak</div>
                <div class="flex justify-center items-center border-r-2 border-white">Alamat</div>
                <div class="flex justify-center items-center">Action</div>
            </div>

            {{-- Body Tabel --}}
            <div class="px-5 py-1.5 shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)]">
                @forelse($suppliers as $index => $supplier)
                    <div class="grid py-4 border-b border-[#00A6FF] text-sm"
                         style="grid-template-columns: 80px 1fr 1fr 1.5fr 140px">
                        <div class="flex justify-center items-center">
                            {{ $suppliers->firstItem() + $index }}.
                        </div>
                        <div class="flex justify-center items-center">{{ $supplier->name }}</div>
                        <div class="flex justify-center items-center">{{ $supplier->contact }}</div>
                        <div class="flex justify-center items-center text-center">{{ Str::limit($supplier->address, 50) }}</div>

                        {{-- Aksi --}}
                        <div class="flex justify-center items-center gap-2">
                            {{-- Edit --}}
                            <a href="{{ route('admin.suppliers.edit', $supplier->id) }}"
                               class="border-2 border-[#00FF1A] text-[#00FF1A] hover:bg-[#00FF1A] hover:text-white px-3 py-1 rounded-lg text-xs active:scale-95 font-semibold shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/>
                                </svg>
                            </a>

                            {{-- Hapus --}}
                            <button type="button"
                                    @click="showDeleteModal = true; deleteUrl = '{{ route('admin.suppliers.destroy', $supplier->id) }}'; deleteName = '{{ addslashes($supplier->name) }}'"
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
                    <div class="text-center py-5 text-gray-500">Belum ada data supplier.</div>
                @endforelse
            </div>
        </div>

        {{-- Paginasi --}}
        @include('admin.partials.pagination', ['paginator' => $suppliers])
    </div>

    {{-- Modal Hapus --}}
    @include('admin.partials.delete-modal')
</div>
@endsection
