
@extends('layouts.app')

@section('title', $title)

@section('content')

@php
    $notifications = [
        [
            'name' => 'Britania Fisichella',
            'month' => 'Agustus 2026',
            'time' => '1 Menit yang lalu',
            'status' => 'pending',
        ],
        [
            'name' => 'Alice Holly Kristy',
            'month' => 'Agustus 2026',
            'time' => '5 Menit yang lalu',
            'status' => 'pending',
        ],
        [
            'name' => 'Billy',
            'month' => 'Agustus 2026',
            'time' => '2 Jam yang lalu',
            'status' => 'confirmed',
        ],
        [
            'name' => 'Gracia Queen A.',
            'month' => 'Agustus 2026',
            'time' => '1 Hari yang lalu',
            'status' => 'confirmed',
        ],
        [
            'name' => 'Edward Cornelius',
            'month' => 'Juli 2026',
            'time' => '2 Hari yang lalu',
            'status' => 'confirmed',
        ],
        [
            'name' => 'Arianto Widodo P.',
            'month' => 'September 2026',
            'time' => '2 Hari yang lalu',
            'status' => 'confirmed',
        ],
    ];
@endphp

<div class="min-h-full bg-[#F3F5FF]">

    {{-- Header halaman --}}
    <div class="mb-5 flex flex-wrap items-center justify-between gap-4">

        <h2 class="text-lg font-bold text-[#45C0F4]">
            NOTIFIKASI PEMBAYARAN SISWA
        </h2>

        {{-- Filter Dropdown --}}
        <div class="relative" id="filterContainer">

            <button
                type="button"
                id="filterButton"
                class="flex w-[150px] items-center justify-between rounded-full bg-white px-4 py-2 text-sm text-[#999999] shadow-md transition hover:shadow-lg"
            >
                <span id="filterLabel">Filter</span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/>
                    <circle cx="8" cy="7" r="2" fill="white"/>
                    <circle cx="16" cy="12" r="2" fill="white"/>
                    <circle cx="10" cy="17" r="2" fill="white"/>
                </svg>
            </button>

            {{-- Pilihan Filter --}}
            <div
                id="filterDropdown"
                class="absolute right-0 z-20 mt-2 hidden w-48 overflow-hidden rounded-lg bg-white py-2 shadow-lg"
            >
                <button
                    type="button"
                    data-filter="all"
                    class="filter-option w-full px-4 py-2 text-left text-sm font-medium text-[#999999] hover:bg-[#F3F5FF]"
                >
                    Semua
                </button>

                <button
                    type="button"
                    data-filter="pending"
                    class="filter-option w-full px-4 py-2 text-left text-sm font-medium text-[#999999] hover:bg-[#F3F5FF]"
                >
                    Perlu Dicek
                </button>

                <button
                    type="button"
                    data-filter="confirmed"
                    class="filter-option w-full px-4 py-2 text-left text-sm font-medium text-[#999999] hover:bg-[#F3F5FF]"
                >
                    Terkonfirmasi
                </button>
            </div>

        </div>

    </div>

    {{-- Daftar Notifikasi --}}
    <div class="rounded-md bg-white px-5 py-2 shadow-sm">

        @foreach ($notifications as $notification)
            <div
                class="notification-item flex flex-col justify-between gap-3 border-b border-[#E5E5E5] py-3 last:border-b-0 sm:flex-row sm:items-center"
                data-status="{{ $notification['status'] }}"
            >

                {{-- Informasi Pembayaran --}}
                <div class="min-w-0 flex-1">

                    <div class="flex flex-wrap items-center gap-x-5 gap-y-1">

                        <p class="text-base font-semibold text-[#4E4E4E]">
                            Pembayaran SPP {{ $notification['name'] }}
                        </p>

                        <div class="flex items-center gap-1.5">
                            <span class="text-sm text-[#B0B0B0]">
                                {{ $notification['time'] }}
                            </span>

                            @if ($notification['status'] === 'pending')
                                <span class="h-2 w-2 rounded-full bg-[#45C0F4]"></span>
                            @endif
                        </div>

                    </div>

                    <p class="mt-1 text-sm text-[#999999]">
                        Pembayaran SPP bulan {{ $notification['month'] }}
                    </p>

                </div>

                {{-- Status / Tombol --}}
                <div class="shrink-0">

                    @if ($notification['status'] === 'pending')
                        <a
                            href="{{ url('/admin/payments') }}"
                            class="flex min-w-[148px] items-center justify-center rounded-md bg-[#45C0F4] px-4 py-1.5 text-sm font-semibold text-white transition hover:bg-sky-500"
                        >
                            Cek Pembayaran
                        </a>
                    @else
                        <span class="flex min-w-[148px] items-center justify-center rounded-md border border-green-500 px-4 py-1.5 text-sm font-semibold text-green-500">
                            Terkonfirmasi
                        </span>
                    @endif

                </div>

            </div>
        @endforeach

        {{-- Pesan jika tidak ada hasil --}}
        <p id="emptyMessage" class="hidden py-8 text-center text-sm text-[#999999]">
            Tidak ada notifikasi untuk filter ini.
        </p>

    </div>

    {{-- See More --}}
    <div class="mt-4 flex justify-center">
        <button
            type="button"
            class="text-lg font-bold text-[#45C0F4] transition hover:text-sky-600"
        >
            See More
        </button>
    </div>

</div>

{{-- JavaScript Filter --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterButton = document.getElementById('filterButton');
        const filterDropdown = document.getElementById('filterDropdown');
        const filterLabel = document.getElementById('filterLabel');
        const filterOptions = document.querySelectorAll('.filter-option');
        const notifications = document.querySelectorAll('.notification-item');
        const emptyMessage = document.getElementById('emptyMessage');

        // Buka dan tutup dropdown
        filterButton.addEventListener('click', function () {
            filterDropdown.classList.toggle('hidden');
        });

        // Pilih filter
        filterOptions.forEach(function (option) {
            option.addEventListener('click', function () {
                const selectedFilter = this.dataset.filter;

                const labels = {
                    all: 'Semua',
                    pending: 'Perlu Dicek',
                    confirmed: 'Terkonfirmasi'
                };

                filterLabel.textContent = labels[selectedFilter];

                let visibleCount = 0;

                notifications.forEach(function (notification) {
                    const status = notification.dataset.status;

                    if (selectedFilter === 'all' || status === selectedFilter) {
                        notification.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        notification.classList.add('hidden');
                    }
                });

                // Tampilkan pesan jika hasil kosong
                emptyMessage.classList.toggle('hidden', visibleCount > 0);

                // Tutup dropdown
                filterDropdown.classList.add('hidden');
            });
        });

        // Tutup dropdown ketika klik di luar
        document.addEventListener('click', function (event) {
            if (!document.getElementById('filterContainer').contains(event.target)) {
                filterDropdown.classList.add('hidden');
            }
        });
    });
</script>

@endsection
