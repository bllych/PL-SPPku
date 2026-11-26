@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="min-h-full bg-[#F3F5FF] py-6">

        <div class="mx-auto w-[calc(100%-32px)] max-w-[1200px]">

            {{-- PROFILE + STATISTIK --}}
            <div class="mb-6 grid grid-cols-1 gap-5 md:grid-cols-[1fr_1.45fr]">

                @include('components.admin.dashboard.profile-card')

                @include('components.admin.dashboard.payment-statistics')

            </div>

            {{-- SEARCH + FILTER + KELAS --}}
            {{-- SEARCH + FILTER + KELAS --}}
            <form action="{{ route('admin.dashboard') }}" method="GET" class="mb-4 flex flex-wrap items-center gap-2.5">

                {{-- Pertahankan filter aktif saat mengetik search --}}
                @if (request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                @if (request('grade'))
                    <input type="hidden" name="grade" value="{{ request('grade') }}">
                @endif

                {{-- SEARCH --}}
                <div class="flex h-[38px] w-full max-w-[330px] items-center rounded-full bg-white px-3 shadow-sm">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search nama atau NISN..."
                        class="w-full bg-transparent text-sm text-[#4E4E4E] placeholder:text-[#999999] focus:outline-none">

                    <button type="submit" class="shrink-0 cursor-pointer">
                        <img src="{{ asset('images/icons/icon_cari.png') }}" alt="Cari" class="h-4 w-4 object-contain">
                    </button>
                </div>

                {{-- FILTER STATUS TAGIHAN --}}
                <details class="relative">
                    <summary
                        class="flex h-[38px] min-w-[115px] cursor-pointer list-none items-center justify-center gap-2 rounded-full bg-white px-4 text-sm {{ request('status') ? 'font-semibold text-[#45C0F4]' : 'text-[#999999]' }} shadow-sm transition hover:shadow-md select-none">
                        <span>
                            {{ match (request('status')) {
        'paid' => 'Lunas',
        'unpaid' => 'Belum Lunas',
        'overdue' => 'Terlambat',
        default => 'Filter',
    } }}
                        </span>
                        <img src="{{ asset('images/icons/filter.png') }}" alt="Filter" class="h-4 w-4 object-contain">
                    </summary>

                    <div
                        class="absolute left-0 z-20 mt-1.5 w-40 overflow-hidden rounded-xl bg-white py-1.5 shadow-lg border border-gray-100 text-sm">
                        <a href="{{ route('admin.dashboard', request()->except(['status', 'page'])) }}"
                            class="block px-4 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">
                            Semua Status
                        </a>
                        <a href="{{ route('admin.dashboard', array_merge(request()->except('page'), ['status' => 'paid'])) }}"
                            class="block px-4 py-1.5 {{ request('status') === 'paid' ? 'bg-sky-50 font-semibold text-[#45C0F4]' : 'text-[#4E4E4E]' }} hover:bg-sky-50 hover:text-[#45C0F4]">
                            Lunas
                        </a>
                        <a href="{{ route('admin.dashboard', array_merge(request()->except('page'), ['status' => 'unpaid'])) }}"
                            class="block px-4 py-1.5 {{ request('status') === 'unpaid' ? 'bg-sky-50 font-semibold text-[#45C0F4]' : 'text-[#4E4E4E]' }} hover:bg-sky-50 hover:text-[#45C0F4]">
                            Belum Lunas
                        </a>
                        <a href="{{ route('admin.dashboard', array_merge(request()->except('page'), ['status' => 'overdue'])) }}"
                            class="block px-4 py-1.5 {{ request('status') === 'overdue' ? 'bg-sky-50 font-semibold text-[#45C0F4]' : 'text-[#4E4E4E]' }} hover:bg-sky-50 hover:text-[#45C0F4]">
                            Terlambat
                        </a>
                    </div>
                </details>

                {{-- FILTER TINGKAT KELAS (10, 11, 12) --}}
                @foreach (['10' => 'Kelas 10', '11' => 'Kelas 11', '12' => 'Kelas 12'] as $gradeVal => $gradeLabel)
                    @php
                        $isGradeActive = request('grade') === $gradeVal;
                        $gradeUrl = $isGradeActive
                            ? route('admin.dashboard', request()->except(['grade', 'page']))
                            : route('admin.dashboard', array_merge(request()->except('page'), ['grade' => $gradeVal]));
                    @endphp
                    <a href="{{ $gradeUrl }}"
                        class="flex h-[38px] items-center justify-center rounded-full px-4 text-sm font-medium shadow-sm transition hover:shadow-md {{ $isGradeActive ? 'bg-[#45C0F4] text-white' : 'bg-white text-[#999999]' }}">
                        {{ $gradeLabel }}
                    </a>
                @endforeach

                {{-- TOMBOL RESET JIKA ADA FILTER AKTIF --}}
                @if (request()->hasAny(['search', 'status', 'grade']))
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex h-[38px] items-center justify-center rounded-full bg-gray-200 px-4 text-sm font-medium text-[#4E4E4E] hover:bg-gray-300 transition">
                        Reset
                    </a>
                @endif

            </form>

            {{-- TABLE SISWA --}}
            @include('components.admin.dashboard.student-table')

            {{-- PAGINATION --}}
            <div class="mt-5">
                {{ $students->withQueryString()->links('components.admin.pagination') }}
            </div>

        </div>

    </div>

@endsection