{{-- Modal Hapus --}}

<template x-if="showDeleteModal">
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm animate-fadeIn"
         @click="showDeleteModal = false">

        <div class="bg-white rounded-2xl w-[450px] p-6 transform transition-all duration-300 shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)] animate-scaleIn"
             @click.stop>

            <h2 class="flex items-center gap-1.5 text-2xl text-white rounded-xl shadow-md font-bold px-4 py-2 bg-gradient-to-r from-[#00A6FF] to-[#045595]">
                {{-- Ikon --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                    <line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/>
                </svg>
                Confirm Delete
            </h2>

            <p class="my-6 text-gray-800">
                Are you sure you want to delete <b x-text="deleteName"></b>?
            </p>

            <div class="flex justify-end gap-3">
                <button @click="showDeleteModal = false"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-lg bg-[#4680FF] text-white font-semibold hover:bg-[#3d70df] active:scale-95 cursor-pointer shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)]">
                    ✕ Cancel
                </button>

                <form :action="deleteUrl" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="flex items-center gap-1.5 px-4 py-2 rounded-lg bg-[#FF0004] text-white font-semibold hover:bg-[#b90003] active:scale-95 cursor-pointer shadow-[inset_0px_4px_27px_1.8px_rgba(0,0,0,0.25),0px_4px_13.5px_1.8px_rgba(0,0,0,0.25)]">
                        ✓ Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
