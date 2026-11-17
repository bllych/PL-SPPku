
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
        <div class="mb-4 flex flex-wrap items-center gap-2.5">

            {{-- SEARCH --}}
            <div class="flex h-[38px] w-full max-w-[330px] items-center rounded-full bg-white px-3 shadow-sm">

                <input
                    type="text"
                    placeholder="Search"
                    class="w-full bg-transparent text-sm text-[#4E4E4E] placeholder:text-[#999999] focus:outline-none"
                >

                <img
                    src="{{ asset('images/icons/icon_cari.png') }}"
                    alt="Cari"
                    class="h-4 w-4 object-contain"
                >

            </div>

            {{-- FILTER --}}
            <button
                type="button"
                class="flex h-[38px] w-[105px] items-center justify-center gap-2 rounded-full bg-white text-sm text-[#999999] shadow-sm transition hover:shadow-md"
            >

                <span>Filter</span>

                <img
                    src="{{ asset('images/icons/filter.png') }}"
                    alt="Filter"
                    class="h-4 w-4 object-contain"
                >

            </button>

            <x-admin.class-filter label="Kelas 10" />
            <x-admin.class-filter label="Kelas 11" />
            <x-admin.class-filter label="Kelas 12" />

        </div>

        {{-- TABLE SISWA --}}
        @include('components.admin.dashboard.student-table')

    </div>

</div>

@endsection
