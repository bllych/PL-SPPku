@extends('layouts.app')

@section('title', $title)

@section('content')
    @php
        $currentStatus = request('status', 'all');
        $filterLabels = [
            'all'      => 'Filter',
            'pending'  => 'Perlu Dicek',
            'verified' => 'Terkonfirmasi',
            'rejected' => 'Ditolak',
        ];
        $activeFilterLabel = $filterLabels[$currentStatus] ?? 'Filter';
    @endphp

    <div class="min-h-full bg-[#F3F5FF]">

        {{-- Header halaman --}}
        <div class="mb-5 flex flex-wrap items-center justify-between gap-4">

            <h2 class="text-lg font-bold text-[#45C0F4]">
                NOTIFIKASI PEMBAYARAN SISWA
            </h2>

            {{-- Filter Dropdown --}}
            <div class="relative" id="filterContainer">

                <button type="button" id="filterButton"
                    class="flex w-[160px] cursor-pointer items-center justify-between rounded-full bg-white px-4 py-2 text-sm {{ request('status') ? 'font-semibold text-[#45C0F4]' : 'text-[#999999]' }} shadow-md transition hover:shadow-lg">
                    <span>{{ $activeFilterLabel }}</span>

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
                        <circle cx="8" cy="7" r="2" fill="white" />
                        <circle cx="16" cy="12" r="2" fill="white" />
                        <circle cx="10" cy="17" r="2" fill="white" />
                    </svg>
                </button>

                {{-- Pilihan Filter --}}
                <div id="filterDropdown"
                    class="absolute right-0 z-20 mt-2 hidden w-48 overflow-hidden rounded-lg bg-white py-2 shadow-lg">
                    <a href="{{ route('admin.notification') }}"
                        class="block w-full px-4 py-2 text-left text-sm font-medium {{ !request('status') ? 'bg-[#F3F5FF] font-semibold text-[#45C0F4]' : 'text-[#999999]' }} hover:bg-[#F3F5FF]">
                        Semua
                    </a>

                    <a href="{{ route('admin.notification', ['status' => 'pending']) }}"
                        class="block w-full px-4 py-2 text-left text-sm font-medium {{ request('status') === 'pending' ? 'bg-[#F3F5FF] font-semibold text-[#45C0F4]' : 'text-[#999999]' }} hover:bg-[#F3F5FF]">
                        Perlu Dicek
                    </a>

                    <a href="{{ route('admin.notification', ['status' => 'verified']) }}"
                        class="block w-full px-4 py-2 text-left text-sm font-medium {{ request('status') === 'verified' ? 'bg-[#F3F5FF] font-semibold text-[#45C0F4]' : 'text-[#999999]' }} hover:bg-[#F3F5FF]">
                        Terkonfirmasi
                    </a>

                    <a href="{{ route('admin.notification', ['status' => 'rejected']) }}"
                        class="block w-full px-4 py-2 text-left text-sm font-medium {{ request('status') === 'rejected' ? 'bg-[#F3F5FF] font-semibold text-[#45C0F4]' : 'text-[#999999]' }} hover:bg-[#F3F5FF]">
                        Ditolak
                    </a>
                </div>

            </div>

        </div>

        {{-- Daftar Notifikasi --}}
        <div class="rounded-md bg-white px-5 py-2 shadow-sm">

            @forelse ($notifications as $notification)
                @php
                    $uiStatus = match ($notification->status) {
                        'verified' => 'confirmed',
                        'rejected' => 'rejected',
                        default    => 'pending',
                    };
                @endphp

                <div class="flex flex-col justify-between gap-3 border-b border-[#E5E5E5] py-3 last:border-b-0 sm:flex-row sm:items-center {{ $uiStatus !== 'pending' ? 'opacity-80' : '' }}">
                    {{-- Informasi Pembayaran --}}
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-x-5 gap-y-1">
                            <p class="text-base font-semibold text-[#4E4E4E]">
                                Pembayaran SPP {{ $notification->user->name ?? '-' }}
                            </p>

                            <div class="flex items-center gap-1.5">
                                <span class="text-sm text-[#B0B0B0]">
                                    {{ $notification->transaction_date->diffForHumans() }}
                                </span>

                                @if ($uiStatus === 'pending')
                                    <span class="h-2 w-2 rounded-full bg-[#45C0F4]"></span>
                                @endif
                            </div>
                        </div>

                        <p class="mt-1 text-sm text-[#999999]">
                            Pembayaran SPP sebesar Rp. {{ number_format($notification->amount, 2, ',', '.') }}
                            ({{ $notification->payment_method }})
                        </p>

                        @if ($uiStatus === 'rejected' && $notification->note)
                            <p class="mt-0.5 text-xs font-medium text-red-500">
                                Alasan: {{ $notification->note }}
                            </p>
                        @endif
                    </div>

                    {{-- Status / Tombol Aksi --}}
                    <div class="shrink-0">
                        @if ($uiStatus === 'pending')
                            <a href="{{ route('admin.payments', ['selected' => $notification->id]) }}"
                                class="flex min-w-[148px] items-center justify-center rounded-md bg-[#45C0F4] px-4 py-1.5 text-sm font-semibold text-white transition hover:bg-sky-500">
                                Cek Pembayaran
                            </a>
                        @elseif ($uiStatus === 'confirmed')
                            <a href="{{ route('admin.payments', ['selected' => $notification->id]) }}"
                                class="flex min-w-[148px] items-center justify-center rounded-md border border-green-500 bg-green-50/50 px-4 py-1.5 text-sm font-semibold text-green-600">
                                Terkonfirmasi
                            </a>
                        @else
                            <a href="{{ route('admin.payments', ['selected' => $notification->id]) }}"
                                class="flex min-w-[148px] items-center justify-center rounded-md border border-red-500 bg-red-50/50 px-4 py-1.5 text-sm font-semibold text-red-600">
                                Ditolak
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <p class="py-8 text-center text-sm text-[#999999]">
                    {{ request('status') ? 'Tidak ada notifikasi untuk filter ini.' : 'Belum ada notifikasi pembayaran.' }}
                </p>
            @endforelse

        </div>

        {{-- Pagination --}}
        <div class="mt-5">
            {{ $notifications->links('components.admin.pagination') }}
        </div>

    </div>

    {{-- JavaScript Toggle Dropdown --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterButton = document.getElementById('filterButton');
            const filterDropdown = document.getElementById('filterDropdown');

            filterButton.addEventListener('click', function () {
                filterDropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', function (event) {
                if (!document.getElementById('filterContainer').contains(event.target)) {
                    filterDropdown.classList.add('hidden');
                }
            });
        });
    </script>
@endsection