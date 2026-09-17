@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="bg-[#F3F5FF] min-h-full py-6">

        {{-- =====================================================
        CONTAINER DASHBOARD
        JARAK KIRI DAN KANAN = 75PX
        ====================================================== --}}
        <div class="w-[calc(100%-150px)] ml-[75px] mr-[75px]">

            {{-- =====================================================
            PROFILE + STATISTIK
            ====================================================== --}}
            <div class="grid grid-cols-[1fr_1.45fr] gap-8 mb-6">


                {{-- =================================================
                PROFILE ADMIN
                ================================================== --}}
                @include('components.admin.dashboard.profile-card')


                {{-- =================================================
                STATISTIK PEMBAYARAN
                ================================================== --}}
                @include('components.admin.dashboard.payment-statistics')

            </div>



            {{-- =====================================================
            SEARCH + FILTER + KELAS
            ====================================================== --}}
            <div class="flex items-center gap-3 mb-5">


                <!-- SEARCH -->
                <div class="
                                w-[330px]
                                h-[45px]
                                bg-white
                                rounded-full
                                shadow-sm
                                flex
                                items-center
                                px-4
                            ">

                    <img src="{{ asset('images/icons/icon_cari.png') }}" alt="Cari" class="
                                    w-[20px]
                                    h-[20px]
                                    object-contain
                                    mr-3
                                ">

                    <input type="text" placeholder="Search" class="
                                    w-full
                                    bg-transparent
                                    text-[18px]
                                    text-gray-600
                                    focus:outline-none
                                ">

                </div>



                <!-- FILTER -->
                <button class="
                                w-[120px]
                                h-[45px]
                                bg-white
                                rounded-full
                                shadow-sm
                                flex
                                items-center
                                justify-center
                                gap-2
                                text-gray-600
                                font-semibold
                                text-[18px]
                            ">

                    <img src="{{ asset('images/icons/filter.png') }}" alt="Filter" class="
                                    w-[20px]
                                    h-[20px]
                                    object-contain
                                ">

                    <span>
                        Filter
                    </span>

                </button>

                <x-admin.class-filter label="Kelas 10" />
                <x-admin.class-filter label="Kelas 11" />
                <x-admin.class-filter label="Kelas 12" />

            </div>


            <!-- TABLE SISWA -->
            @include('components.admin.dashboard.student-table')

        </div>

    </div>

@endsection