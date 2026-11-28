@props([
    'months' => [
        '' => 'Semua Periode',
        '2026-07' => 'Juli 2026',
        '2026-08' => 'Agustus 2026',
        '2026-09' => 'September 2026',
        '2026-10' => 'Oktober 2026',
        '2026-11' => 'November 2026',
        '2026-12' => 'Desember 2026',
        '2027-01' => 'Januari 2027',
        '2027-02' => 'Februari 2027',
        '2027-03' => 'Maret 2027',
        '2027-04' => 'April 2027',
        '2027-05' => 'Mei 2027',
        '2027-06' => 'Juni 2027',
    ]
])

@php
    $selectedMonth = (string) request('month', '');
    $activeLabel = $months[$selectedMonth] ?? 'Semua Periode';
@endphp

<details class="relative group">
    <summary
        class="flex items-center justify-between bg-white border-2 border-[#000000]/15 text-[#999999] font-medium pl-4 pr-3 py-2 rounded-lg text-md cursor-pointer list-none select-none hover:border-[#45C0F4]">

        <span class="whitespace-nowrap mr-8 {{ $selectedMonth !== '' ? 'text-[#45C0F4] font-semibold' : '' }}">
            {{ $activeLabel }}
        </span>

        <svg
            class="w-6 h-6 text-[#999999] group-open:rotate-180 transition-transform shrink-0"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 9l-7 7-7-7">
            </path>

        </svg>
    </summary>

    <div
        class="absolute left-0 mt-1 w-full max-h-48 overflow-y-auto bg-white border-2 border-[#000000]/15 rounded-lg shadow-md py-1 z-50 text-md">

        @foreach ($months as $val => $month)
            <a href="{{ request()->fullUrlWithQuery(['month' => $val !== '' ? $val : null, 'page' => null]) }}"
                class="block px-4 py-1.5 hover:bg-sky-50 hover:text-[#45C0F4] {{ $selectedMonth === $val ? 'bg-sky-50/70 font-semibold text-[#45C0F4]' : 'text-[#4E4E4E]' }}">
                {{ $month }}
            </a>
        @endforeach

    </div>
</details>