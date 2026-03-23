@extends('admin.layout')

@section('title', 'Tambah Supplier')

@section('content')
<div class="bg-gradient-to-b from-[#00A6FF] to-[#045595] rounded-r-2xl p-5 shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)]">

    {{-- Header --}}
    <div class="flex justify-start items-center mb-6">
        <h1 class="text-4xl font-extrabold">Tambah Supplier</h1>
    </div>

    {{-- Form --}}
    <div class="bg-white text-black rounded-xl shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)] p-6">

        {{-- Judul Form --}}
        <div class="pb-6">
            <h2 class="flex items-center gap-1.5 text-2xl text-white rounded-xl shadow-md font-bold px-4 py-2 bg-gradient-to-r from-[#00A6FF] to-[#045595]">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/>
                </svg>
                Tambah Supplier Baru
            </h2>
        </div>

        <form action="{{ route('admin.suppliers.store') }}" method="POST">
            @csrf

            <div class="rounded-2xl shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25)] px-6 py-6 space-y-4">

                {{-- Nama --}}
                <div class="flex flex-col w-full">
                    <label class="text-lg mb-1 font-medium">Nama Supplier</label>
                    <input type="text" name="name" placeholder="Masukkan nama supplier" value="{{ old('name') }}"
                           class="w-full p-2.5 border border-[#00A6FF] rounded-[13px]" required />
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Kontak --}}
                <div class="flex flex-col w-full">
                    <label class="text-lg mb-1 font-medium">Kontak</label>
                    <input type="text" name="contact" placeholder="Masukkan nomor telepon / email" value="{{ old('contact') }}"
                           class="w-full p-2.5 border border-[#00A6FF] rounded-[13px]" required />
                    @error('contact') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Alamat --}}
                <div class="flex flex-col w-full">
                    <label class="text-lg mb-1 font-medium">Alamat</label>
                    <textarea name="address" rows="3" placeholder="Masukkan alamat lengkap supplier"
                              class="w-full p-2.5 border border-[#00A6FF] rounded-[13px]" required>{{ old('address') }}</textarea>
                    @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Tombol Bawah --}}
            <div class="pt-6 flex justify-end gap-3">
                <a href="{{ route('admin.suppliers.index') }}"
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
