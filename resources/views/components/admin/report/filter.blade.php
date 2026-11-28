@props([
    'availableClasses' => collect(),
])

@php
    $months = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    $selectedMonth = (int) request('month', 0);
    $selectedYear = (int) request('year', 0);
    $selectedClass = (string) request('class', '');
    $selectedSort = (string) request('sort', 'latest');
    $hasActiveFilter = request()->filled('search')
        || $selectedMonth > 0
        || $selectedYear > 0
        || $selectedClass !== ''
        || $selectedSort !== 'latest';
@endphp

<form method="GET" action="{{ url()->current() }}" class="mb-8 flex flex-wrap items-center gap-3">

    {{-- Search --}}
    <div class="relative w-full md:w-[370px]">
        <input type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search"
            class="h-[44px] w-full rounded-full border border-gray-200 bg-white
                   px-4 pr-11 text-[17px] text-gray-600 shadow-md
                   outline-none placeholder:text-gray-400
                   focus:border-[#38b8ed]">

        <button type="submit" aria-label="Cari laporan"
            class="absolute right-4 top-1/2 -translate-y-1/2 cursor-pointer text-gray-400 hover:text-[#38b8ed]">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="7"></circle>
                <path d="m20 20-4-4"></path>
            </svg>
        </button>
    </div>

    {{-- Filter / Urutkan --}}
    <div class="relative">
        <select name="sort" onchange="this.form.submit()"
            aria-label="Urutkan laporan"
            class="h-[44px] w-[150px] cursor-pointer appearance-none rounded-full border
                   {{ $selectedSort !== 'latest' ? 'border-[#38b8ed] text-[#38b8ed]' : 'border-gray-200 text-gray-500' }}
                   bg-white pl-5 pr-10 text-[16px] shadow-md outline-none hover:border-[#38b8ed]">
            <option value="latest" @selected($selectedSort === 'latest')>Terbaru</option>
            <option value="oldest" @selected($selectedSort === 'oldest')>Terlama</option>
            <option value="name" @selected($selectedSort === 'name')>Nama A-Z</option>
        </select>

        <svg class="pointer-events-none absolute right-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400"
            fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <path d="M4 6h16M7 12h10M10 18h4"></path>
        </svg>
    </div>

    {{-- Bulan --}}
    <div class="relative">
        <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400"
            fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7"></circle>
            <path d="m20 20-4-4"></path>
        </svg>

        <select name="month" onchange="this.form.submit()"
            aria-label="Filter bulan"
            class="h-[44px] w-[155px] cursor-pointer appearance-none rounded-full border
                   {{ $selectedMonth > 0 ? 'border-[#38b8ed] text-[#38b8ed]' : 'border-gray-200 text-gray-500' }}
                   bg-white pl-11 pr-7 text-[16px] shadow-md outline-none hover:border-[#38b8ed]">
            <option value="">Bulan</option>
            @foreach ($months as $num => $label)
                <option value="{{ $num }}" @selected($selectedMonth === $num)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    {{-- Tahun --}}
    <div class="relative">
        <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400"
            fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7"></circle>
            <path d="m20 20-4-4"></path>
        </svg>

        <select name="year" onchange="this.form.submit()"
            aria-label="Filter tahun"
            class="h-[44px] w-[135px] cursor-pointer appearance-none rounded-full border
                   {{ $selectedYear > 0 ? 'border-[#38b8ed] text-[#38b8ed]' : 'border-gray-200 text-gray-500' }}
                   bg-white pl-11 pr-7 text-[16px] shadow-md outline-none hover:border-[#38b8ed]">
            <option value="">Tahun</option>
            <option value="2026" @selected($selectedYear === 2026)>2026</option>
            <option value="2027" @selected($selectedYear === 2027)>2027</option>
        </select>
    </div>

    {{-- Kelas --}}
    <div class="relative">
        <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400"
            fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7"></circle>
            <path d="m20 20-4-4"></path>
        </svg>

        <select name="class" onchange="this.form.submit()"
            aria-label="Filter kelas"
            class="h-[44px] w-[155px] cursor-pointer appearance-none rounded-full border
                   {{ $selectedClass !== '' ? 'border-[#38b8ed] text-[#38b8ed]' : 'border-gray-200 text-gray-500' }}
                   bg-white pl-11 pr-7 text-[16px] shadow-md outline-none hover:border-[#38b8ed]">
            <option value="">Semua Kelas</option>
            @foreach ($availableClasses as $cls)
                <option value="{{ $cls }}" @selected($selectedClass === $cls)>{{ $cls }}</option>
            @endforeach
        </select>
    </div>

    {{-- Reset Filter (muncul hanya saat ada filter aktif) --}}
    @if ($hasActiveFilter)
        <a href="{{ url()->current() }}"
            class="flex h-[44px] items-center rounded-full border border-red-200 bg-white px-4 text-sm font-semibold text-red-500 shadow-md transition hover:bg-red-50">
            Reset
        </a>
    @endif

</form>