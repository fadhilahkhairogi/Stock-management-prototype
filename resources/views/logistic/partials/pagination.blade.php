{{-- Paginasi Kustom --}}

@if($paginator->hasPages())
<div class="flex justify-between items-center mt-4">
    <p class="text-white">
        Showing
        <span class="font-bold">{{ $paginator->firstItem() }}-{{ $paginator->lastItem() }}</span>
        of <span class="font-bold">{{ $paginator->total() }}</span>
    </p>

    <div class="flex bg-white text-black rounded-md border border-[#CECECE] justify-center">
        {{-- Sebelumnya --}}
        @if($paginator->onFirstPage())
            <span class="px-3 py-1 border border-[#CECECE] opacity-40 cursor-not-allowed">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="px-3 py-1 border border-[#CECECE] cursor-pointer hover:bg-gradient-to-b hover:from-[#00A6FF] hover:to-[#045595] hover:text-white hover:font-semibold">
                Previous
            </a>
        @endif

        {{-- Nomor Halaman --}}
        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
            $start = max(1, $current - 2);
            $end = min($last, $start + 4);
            if ($end - $start < 4) $start = max(1, $end - 4);
        @endphp

        @for($page = $start; $page <= $end; $page++)
            @if($page == $current)
                <span class="px-3 py-1 border border-[#CECECE] bg-gradient-to-b from-[#00A6FF] to-[#045595] text-white font-semibold">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $paginator->url($page) }}"
                   class="px-3 py-1 border border-[#CECECE] cursor-pointer hover:bg-gradient-to-b hover:from-[#00A6FF] hover:to-[#045595] hover:text-white hover:font-semibold">
                    {{ $page }}
                </a>
            @endif
        @endfor

        {{-- Berikutnya --}}
        @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="px-3 py-1 border border-[#CECECE] cursor-pointer hover:bg-gradient-to-b hover:from-[#00A6FF] hover:to-[#045595] hover:text-white hover:font-semibold">
                Next
            </a>
        @else
            <span class="px-3 py-1 border border-[#CECECE] opacity-40 cursor-not-allowed">Next</span>
        @endif
    </div>
</div>
@endif
