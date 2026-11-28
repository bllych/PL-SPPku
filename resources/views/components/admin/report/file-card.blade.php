@props([
    'name',
    'modified',
    'className' => '',
    'month' => null,
    'year' => null,
])

@php
    $fileUrl = ($month && $year)
        ? route('admin.reports.download', [
            'class' => $className,
            'month' => $month,
            'year' => $year,
            'name' => $name,
        ])
        : asset('Laporan_SPP_2026-2027.xlsx');
@endphp

<div
    class="report-card-item relative flex h-[164px] flex-col items-center justify-center rounded-lg border border-gray-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">

    {{-- More button (Titik Tiga) --}}
    <div class="report-menu-wrapper absolute right-3 top-3">
        <button type="button"
            onclick="this.nextElementSibling.classList.toggle('hidden')"
            class="cursor-pointer rounded-full p-1 text-gray-500 transition hover:bg-gray-100 hover:text-gray-700">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                <circle cx="12" cy="5" r="1.5" />
                <circle cx="12" cy="12" r="1.5" />
                <circle cx="12" cy="19" r="1.5" />
            </svg>
        </button>

        {{-- Dropdown Aksi File --}}
        <div
            class="report-menu-dropdown absolute right-0 z-20 mt-1 hidden w-36 overflow-hidden rounded-xl border border-gray-100 bg-white py-1 text-left text-sm shadow-lg">
            <a href="{{ $fileUrl }}"
                class="report-download-link block px-3.5 py-2 font-medium text-gray-700 hover:bg-sky-50 hover:text-[#38b8ed]">
                Download
            </a>

            <button type="button"
                onclick="renameReportCard(this)"
                class="block w-full cursor-pointer px-3.5 py-2 text-left font-medium text-gray-700 hover:bg-sky-50 hover:text-[#38b8ed]">
                Ubah Nama
            </button>

            <button type="button"
                onclick="this.closest('.report-card-item').remove()"
                class="block w-full cursor-pointer px-3.5 py-2 text-left font-medium text-red-500 hover:bg-red-50">
                Hapus
            </button>
        </div>
    </div>

    {{-- Klik ikon/nama file langsung download file --}}
    <a href="{{ $fileUrl }}" class="report-download-link flex flex-col items-center">
        <img src="{{ asset('images/icons/excel.png') }}" alt="Excel"
            class="mb-2 h-[84px] w-[70px] object-contain">

        <p class="report-file-title max-w-[210px] truncate text-[16px] font-semibold text-gray-600 hover:text-[#38b8ed]">
            {{ $name }}
        </p>

        <p class="mt-1 text-[15px] text-gray-400">
            Modified {{ $modified }}
        </p>
    </a>

</div>