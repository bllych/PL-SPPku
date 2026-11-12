<div class="mb-8 flex flex-wrap items-center gap-3">

    {{-- Search --}}
    <div class="relative w-full md:w-[370px]">
        <input type="text" placeholder="Search" class="h-[44px] w-full rounded-full border border-gray-200 bg-white
                           px-4 pr-11 text-[17px] text-gray-600 shadow-md
                           outline-none placeholder:text-gray-400
                           focus:border-[#38b8ed]">

        <svg class="absolute right-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor"
            stroke-width="1.8" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7"></circle>
            <path d="m20 20-4-4"></path>
        </svg>
    </div>


    {{-- Filter --}}
    <button type="button" class="flex h-[44px] w-[150px] items-center justify-between
                       rounded-full border border-gray-200 bg-white px-5
                       text-[17px] text-gray-400 shadow-md
                       hover:border-[#38b8ed]">
        <span>Filter</span>

        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <path d="M4 6h16M7 12h10M10 18h4"></path>
        </svg>
    </button>


    {{-- Bulan --}}
    <button type="button" class="flex h-[44px] w-[140px] items-center gap-3
                       rounded-full border border-gray-200 bg-white px-4
                       text-[17px] text-gray-400 shadow-md
                       hover:border-[#38b8ed]">
        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7"></circle>
            <path d="m20 20-4-4"></path>
        </svg>

        Januari
    </button>


    {{-- Tahun --}}
    <button type="button" class="flex h-[44px] w-[140px] items-center gap-3
                       rounded-full border border-gray-200 bg-white px-4
                       text-[17px] text-gray-400 shadow-md
                       hover:border-[#38b8ed]">
        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7"></circle>
            <path d="m20 20-4-4"></path>
        </svg>

        2026
    </button>


    {{-- Kelas --}}
    <button type="button" class="flex h-[44px] w-[140px] items-center gap-3
                       rounded-full border border-gray-200 bg-white px-4
                       text-[17px] text-gray-400 shadow-md
                       hover:border-[#38b8ed]">
        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7"></circle>
            <path d="m20 20-4-4"></path>
        </svg>

        Kelas 12
    </button>

</div>