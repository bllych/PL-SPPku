@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="min-h-full bg-[#F3F5FF] py-6">

        <div class="mx-auto w-[calc(100%-32px)] max-w-[1200px]">

            {{-- BANNER NOTIFIKASI SUKSES REMINDER --}}
            @if (session('success'))
                <div id="dashboardAlert"
                    class="mb-4 flex items-center justify-between rounded-xl border border-green-400 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700 shadow-sm">
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="document.getElementById('dashboardAlert').remove()"
                        class="cursor-pointer font-bold text-green-700 hover:text-green-900">&times;</button>
                </div>
            @endif

            {{-- PROFILE + STATISTIK --}}
            <div class="mb-6 grid grid-cols-1 gap-5 md:grid-cols-[1fr_1.45fr]">

                @include('components.admin.dashboard.profile-card')

                @include('components.admin.dashboard.payment-statistics')

            </div>

            {{-- SEARCH + FILTER + KELAS + REMINDER OTOMATIS (TETAP 1 BARIS) --}}
            @php
                $activeGrade = (string) request('grade', '');
            @endphp

            <div class="mb-4 flex flex-wrap items-center justify-between gap-2 lg:flex-nowrap">

                <form action="{{ route('admin.dashboard') }}" method="GET"
                    class="flex min-w-0 flex-1 flex-wrap items-center gap-2 lg:flex-nowrap">

                    @if (request('period'))
                        <input type="hidden" name="period" value="{{ request('period') }}">
                    @endif
                    @if (request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    @if ($activeGrade !== '')
                        <input type="hidden" name="grade" value="{{ $activeGrade }}">
                    @endif

                    {{-- SEARCH (Fleksibel menyesuaikan sisa lebar) --}}
                    <div class="flex h-[38px] min-w-[170px] flex-1 items-center rounded-full bg-white px-3.5 shadow-sm lg:max-w-[270px]">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search nama atau NISN..."
                            class="w-full min-w-0 bg-transparent text-sm text-[#4E4E4E] placeholder:text-[#999999] focus:outline-none">

                        <button type="submit" class="ml-1.5 shrink-0 cursor-pointer">
                            <img src="{{ asset('images/icons/icon_cari.png') }}" alt="Cari" class="h-4 w-4 object-contain">
                        </button>
                    </div>

                    {{-- FILTER STATUS TAGIHAN --}}
                    <details id="dashboardStatusFilter" class="relative shrink-0">
                        <summary
                            class="flex h-[38px] min-w-[105px] cursor-pointer list-none items-center justify-center gap-2 whitespace-nowrap rounded-full px-3.5 text-sm shadow-sm transition hover:shadow-md select-none {{ request('status') ? 'border border-[#45C0F4] bg-[#45C0F4]/10 font-semibold text-[#45C0F4]' : 'bg-white text-[#999999]' }}">
                            <span>
                                {{ match (request('status')) {
                                    'paid' => 'Lunas',
                                    'unpaid' => 'Belum Lunas',
                                    'overdue' => 'Terlambat',
                                    default => 'Filter',
                                } }}
                            </span>
                            <img src="{{ asset('images/icons/filter.png') }}" alt="Filter" class="h-4 w-4 shrink-0 object-contain">
                        </summary>

                        <div
                            class="absolute left-0 z-20 mt-1.5 w-44 overflow-hidden rounded-xl border border-gray-100 bg-white py-1.5 text-sm shadow-lg">
                            <a href="{{ route('admin.dashboard', request()->except(['status', 'page'])) }}"
                                class="block px-4 py-2 {{ !request('status') ? 'bg-sky-50 font-semibold text-[#45C0F4]' : 'text-[#4E4E4E]' }} hover:bg-sky-50 hover:text-[#45C0F4]">
                                Semua Status
                            </a>
                            <a href="{{ route('admin.dashboard', array_merge(request()->except('page'), ['status' => 'paid'])) }}"
                                class="block px-4 py-2 {{ request('status') === 'paid' ? 'bg-sky-50 font-semibold text-[#45C0F4]' : 'text-[#4E4E4E]' }} hover:bg-sky-50 hover:text-[#45C0F4]">
                                Lunas
                            </a>
                            <a href="{{ route('admin.dashboard', array_merge(request()->except('page'), ['status' => 'unpaid'])) }}"
                                class="block px-4 py-2 {{ request('status') === 'unpaid' ? 'bg-sky-50 font-semibold text-[#45C0F4]' : 'text-[#4E4E4E]' }} hover:bg-sky-50 hover:text-[#45C0F4]">
                                Belum Lunas
                            </a>
                            <a href="{{ route('admin.dashboard', array_merge(request()->except('page'), ['status' => 'overdue'])) }}"
                                class="block px-4 py-2 {{ request('status') === 'overdue' ? 'bg-sky-50 font-semibold text-[#45C0F4]' : 'text-[#4E4E4E]' }} hover:bg-sky-50 hover:text-[#45C0F4]">
                                Terlambat
                            </a>
                        </div>
                    </details>

                    {{-- FILTER TINGKAT KELAS (10, 11, 12) --}}
                    @foreach (['10' => 'Kelas 10', '11' => 'Kelas 11', '12' => 'Kelas 12'] as $gradeVal => $gradeLabel)
                        @php
                            $isGradeActive = $activeGrade === (string) $gradeVal;
                            $gradeUrl = $isGradeActive
                                ? route('admin.dashboard', request()->except(['grade', 'page']))
                                : route('admin.dashboard', array_merge(request()->except('page'), ['grade' => (string) $gradeVal]));
                        @endphp
                        <a href="{{ $gradeUrl }}"
                            aria-pressed="{{ $isGradeActive ? 'true' : 'false' }}"
                            class="flex h-[38px] shrink-0 items-center justify-center gap-1.5 whitespace-nowrap rounded-full px-3.5 text-sm transition {{ $isGradeActive ? 'bg-[#45C0F4] font-semibold text-white shadow-md ring-2 ring-[#45C0F4]/30 hover:bg-sky-500' : 'border border-gray-200 bg-white font-medium text-[#999999] shadow-sm hover:border-[#45C0F4] hover:text-[#45C0F4]' }}">
                            <span>{{ $gradeLabel }}</span>
                            @if ($isGradeActive)
                                <span class="text-xs font-bold leading-none">&times;</span>
                            @endif
                        </a>
                    @endforeach

                    @if (request()->hasAny(['search', 'status', 'grade']))
                        <a href="{{ route('admin.dashboard', request()->only('period')) }}"
                            class="flex h-[38px] shrink-0 items-center justify-center whitespace-nowrap rounded-full bg-gray-200 px-3.5 text-sm font-medium text-[#4E4E4E] transition hover:bg-gray-300">
                            Reset
                        </a>
                    @endif

                </form>

                {{-- TOMBOL KIRIM REMINDER OTOMATIS (PE-ELL #11) --}}
                <form action="{{ route('admin.reminders.send') }}" method="POST" class="shrink-0"
                    onsubmit="return confirm('Kirim pengingat pembayaran otomatis ke {{ $unpaidStudents }} siswa yang belum bayar pada periode {{ $selectedPeriodLabel }}?')">
                    @csrf
                    <input type="hidden" name="period" value="{{ $selectedPeriod }}">
                    <button type="submit"
                        class="flex h-[38px] shrink-0 cursor-pointer items-center gap-2 whitespace-nowrap rounded-full bg-[#45C0F4] px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-500">
                        <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span>Kirim Reminder ({{ $unpaidStudents }})</span>
                    </button>
                </form>

            </div>

            {{-- TABLE SISWA --}}
            @include('components.admin.dashboard.student-table')

            {{-- PAGINATION --}}
            <div class="mt-5">
                {{ $students->withQueryString()->links('components.admin.pagination') }}
            </div>

        </div>

    </div>

    <script>
        document.addEventListener('click', function (e) {
            const filterDetails = document.getElementById('dashboardStatusFilter');
            if (filterDetails && !filterDetails.contains(e.target)) {
                filterDetails.removeAttribute('open');
            }
        });
    </script>

@endsection