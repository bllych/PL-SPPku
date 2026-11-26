@php
    $classes = [
        '10 TKJ 1' => 'X TKJ 1',
        '10 TKJ 2' => 'X TKJ 2',
        '10 AKL'   => 'X AKL',
        '10 BiD 1' => 'X BiD 1',
        '10 BiD 2' => 'X BiD 2',
        '11 TKJ 1' => 'XI TKJ 1',
        '11 TKJ 2' => 'XI TKJ 2',
        '11 TKJ 3' => 'XI TKJ 3',
        '11 AKL'   => 'XI AKL',
        '11 BiD 1' => 'XI BiD 1',
        '11 BiD 2' => 'XI BiD 2',
        '12 TKJ 1' => 'XII TKJ 1',
        '12 TKJ 2' => 'XII TKJ 2',
        '12 TKJ 3' => 'XII TKJ 3',
        '12 AKL'   => 'XII AKL',
        '12 BiD'   => 'XII BiD',
    ];

    $statuses = [
        'verified' => 'Terverifikasi',
        'pending'  => 'Menunggu',
        'rejected' => 'Ditolak',
    ];

    $months = [
        '2026-12' => 'Desember 2026',
        '2026-11' => 'November 2026',
        '2026-10' => 'Oktober 2026',
        '2026-09' => 'September 2026',
        '2026-08' => 'Agustus 2026',
        '2026-07' => 'Juli 2026',
        '2026-06' => 'Juni 2026',
        '2026-05' => 'Mei 2026',
        '2026-04' => 'April 2026',
        '2026-03' => 'Maret 2026',
        '2026-02' => 'Februari 2026',
        '2026-01' => 'Januari 2026',
    ];

    $activeClassLabel  = $classes[request('class')] ?? 'Semua Kelas';
    $activeStatusLabel = $statuses[request('status')] ?? 'Semua Status';
    $activeMonthLabel  = $months[request('month')] ?? 'Semua Bulan';
@endphp

<form action="{{ route('admin.payments') }}" method="GET"
    class="flex flex-col md:flex-row items-center justify-between gap-3 bg-white rounded-lg border-2 border-[#000000]/15 p-3">

    {{-- Pertahankan filter dropdown yang sedang aktif saat mengetik search --}}
    @if (request('class'))
        <input type="hidden" name="class" value="{{ request('class') }}">
    @endif
    @if (request('status'))
        <input type="hidden" name="status" value="{{ request('status') }}">
    @endif
    @if (request('month'))
        <input type="hidden" name="month" value="{{ request('month') }}">
    @endif

    <!-- 1. Searchbar -->
    <div class="relative w-full md:w-auto md:flex-1">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NISN..."
            class="w-full bg-white border border-[#000000]/15 text-[#4E4E4E] font-medium pl-9 pr-4 py-2 rounded-lg text-sm outline-none focus:border-[#45C0F4]">
        <svg class="w-4 h-4 text-[#999999] absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>

    <!-- Group Dropdown & Button -->
    <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">

        <!-- 2. Dropdown Kelas -->
        <details class="relative w-36 group">
            <summary
                class="flex items-center justify-between bg-white border border-[#000000]/15 {{ request('class') ? 'text-[#4E4E4E]' : 'text-[#999999]' }} font-medium pl-3 pr-2.5 py-2 rounded-lg text-sm cursor-pointer list-none select-none">
                <span class="truncate">{{ $activeClassLabel }}</span>
                <svg class="w-4 h-4 text-[#999999] group-open:rotate-180 transition-transform shrink-0" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </summary>

            <div
                class="absolute left-0 mt-1 w-full max-h-48 overflow-y-auto bg-white border border-[#000000]/15 rounded-lg shadow-md py-1 z-50 text-sm">
                <a href="{{ route('admin.payments', request()->except(['class', 'page', 'selected'])) }}"
                    class="block px-3 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">Semua Kelas</a>
                @foreach ($classes as $val => $label)
                    <a href="{{ route('admin.payments', array_merge(request()->except(['page', 'selected']), ['class' => $val])) }}"
                        class="block px-3 py-1.5 {{ request('class') === $val ? 'bg-sky-50 text-[#45C0F4] font-semibold' : 'text-[#4E4E4E]' }} hover:bg-sky-50 hover:text-[#45C0F4]">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </details>

        <!-- 3. Dropdown Status Pembayaran -->
        <details class="relative group">
            <summary
                class="flex items-center justify-between gap-3 bg-white border border-[#000000]/15 {{ request('status') ? 'text-[#4E4E4E]' : 'text-[#999999]' }} font-medium pl-3 pr-2.5 py-2 rounded-lg text-sm cursor-pointer list-none select-none">
                <span class="whitespace-nowrap">{{ $activeStatusLabel }}</span>
                <svg class="w-4 h-4 text-[#999999] group-open:rotate-180 transition-transform shrink-0" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </summary>

            <div
                class="absolute left-0 mt-1 w-40 bg-white border border-[#000000]/15 rounded-lg shadow-md py-1 z-50 text-sm">
                <a href="{{ route('admin.payments', request()->except(['status', 'page', 'selected'])) }}"
                    class="block px-3 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">Semua Status</a>
                @foreach ($statuses as $val => $label)
                    <a href="{{ route('admin.payments', array_merge(request()->except(['page', 'selected']), ['status' => $val])) }}"
                        class="block px-3 py-1.5 {{ request('status') === $val ? 'bg-sky-50 text-[#45C0F4] font-semibold' : 'text-[#4E4E4E]' }} hover:bg-sky-50 hover:text-[#45C0F4]">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </details>

        <!-- 4. Dropdown Bulan -->
        <details class="relative group">
            <summary
                class="flex items-center justify-between gap-3 bg-white border border-[#000000]/15 {{ request('month') ? 'text-[#4E4E4E]' : 'text-[#999999]' }} font-medium pl-3 pr-2.5 py-2 rounded-lg text-sm cursor-pointer list-none select-none">
                <span class="whitespace-nowrap">{{ $activeMonthLabel }}</span>
                <svg class="w-4 h-4 text-[#999999] group-open:rotate-180 transition-transform shrink-0" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </summary>

            <div
                class="absolute left-0 mt-1 w-44 max-h-48 overflow-y-auto bg-white border border-[#000000]/15 rounded-lg shadow-md py-1 z-50 text-sm">
                <a href="{{ route('admin.payments', request()->except(['month', 'page', 'selected'])) }}"
                    class="block px-4 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">Semua Bulan</a>
                @foreach ($months as $val => $label)
                    <a href="{{ route('admin.payments', array_merge(request()->except(['page', 'selected']), ['month' => $val])) }}"
                        class="block px-4 py-1.5 {{ request('month') === $val ? 'bg-sky-50 text-[#45C0F4] font-semibold' : 'text-[#4E4E4E]' }} hover:bg-sky-50 hover:text-[#45C0F4]">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </details>

        <!-- 5. Submit Button -->
        <button type="submit"
            class="bg-[#45C0F4] hover:bg-[#3ab0e0] text-white font-medium px-4 py-2 rounded-lg text-sm transition-colors cursor-pointer">
            Cari
        </button>

        {{-- Tombol Reset muncul jika ada filter yang aktif --}}
        @if (request()->hasAny(['search', 'class', 'status', 'month']))
            <a href="{{ route('admin.payments') }}"
                class="bg-gray-100 hover:bg-gray-200 text-[#4E4E4E] font-medium px-3 py-2 rounded-lg text-sm transition-colors">
                Reset
            </a>
        @endif
    </div>
</form>