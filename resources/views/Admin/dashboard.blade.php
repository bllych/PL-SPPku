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
            <div
            class=" 
            bg-white
            rounded-l-full
            rounded-r-[10px]
            shadow-sm
            h-[110px]
            relative
            "
            >

                <div class="h-full flex items-center">

                    {{-- =========================================
                        FOTO PROFILE
                        MENIMPA BAGIAN KIRI CARD
                    ========================================== --}}
                    <div
                        class="
                            absolute
                            left-[-12px]
                            top-1/2
                            -translate-y-1/2
                            w-[105px]
                            h-[105px]
                            rounded-full
                            overflow-hidden
                            z-10
                        "
                    >

                        <img
                            src="{{ asset('images/profile admin.png') }}"
                            alt="Profile Admin"
                            class="
                                w-full
                                h-full
                                object-cover
                            "
                        >

                    </div>


                    {{-- =========================================
                        INFORMASI ADMIN
                    ========================================== --}}
                    <div class="ml-[125px]">

                        <h2
                            class="
                                text-[#45C0F4]
                                font-bold
                                text-[18px]
                                leading-tight
                                whitespace-nowrap
                            "
                        >
                            RAYSON VELNOC
                        </h2>


                        <p
                            class="
                                text-gray-700
                                font-semibold
                                text-[18px]
                                mt-1
                                leading-tight
                                whitespace-nowrap
                            "
                        >
                            Tata Usaha
                        </p>


                        <p
                            class="
                                text-gray-700
                                font-semibold
                                text-[18px]
                                mt-1
                                leading-tight
                                whitespace-nowrap
                            "
                        >
                            SMK Kristen Immanuel
                        </p>

                    </div>

                </div>

            </div>



            {{-- =================================================
                STATISTIK PEMBAYARAN
            ================================================== --}}
            <div
                class="
                    bg-white
                    rounded-[10px]
                    shadow-sm
                    h-[110px]
                    overflow-hidden
                "
            >

                <div class="h-full px-5 py-4">

                    {{-- =========================================
                        JUDUL + BULAN
                    ========================================== --}}
                    <div class="flex items-center gap-5">

                        <h2
                            class="
                                text-[#45C0F4]
                                font-bold
                                text-[18px]
                                whitespace-nowrap
                            "
                        >
                            STATISTIK PEMBAYARAN
                        </h2>


                        <select
                            class="
                                border
                                border-gray-300
                                rounded-[6px]
                                px-3
                                py-1
                                text-[18px]
                                text-[#FFC857]
                                bg-white
                                focus:outline-none
                            "
                        >

                            <option>Agustus</option>
                            <option>September</option>
                            <option>Oktober</option>
                            <option>November</option>
                            <option>Desember</option>

                        </select>

                    </div>


                    {{-- =========================================
                        DATA STATISTIK
                    ========================================== --}}
                    <div class="flex items-center gap-8 mt-4">


                        {{-- TOTAL SISWA --}}
                        <div
                            class="
                                flex
                                items-center
                                gap-2
                                whitespace-nowrap
                            "
                        >

                            <span
                                class="
                                    text-[#45C0F4]
                                    font-semibold
                                    text-[18px]
                                "
                            >
                                Total Siswa
                            </span>

                            <span
                                class="
                                    text-[#45C0F4]
                                    font-bold
                                    text-[20px]
                                "
                            >
                                573
                            </span>

                        </div>


                        {{-- LUNAS --}}
                        <div
                            class="
                                flex
                                items-center
                                gap-2
                                whitespace-nowrap
                            "
                        >

                            <span
                                class="
                                    text-green-500
                                    font-semibold
                                    text-[18px]
                                "
                            >
                                Lunas
                            </span>

                            <span
                                class="
                                    text-green-500
                                    font-bold
                                    text-[20px]
                                "
                            >
                                359
                            </span>

                        </div>


                        {{-- BELUM LUNAS --}}
                        <div
                            class="
                                flex
                                items-center
                                gap-2
                                whitespace-nowrap
                            "
                        >

                            <span
                                class="
                                    text-red-400
                                    font-semibold
                                    text-[18px]
                                "
                            >
                                Belum Lunas
                            </span>

                            <span
                                class="
                                    text-red-400
                                    font-bold
                                    text-[20px]
                                "
                            >
                                214
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- =====================================================
            SEARCH + FILTER + KELAS
        ====================================================== --}}
        <div class="flex items-center gap-3 mb-5">


            {{-- =================================================
                SEARCH
            ================================================== --}}
            <div
                class="
                    w-[330px]
                    h-[45px]
                    bg-white
                    rounded-full
                    shadow-sm
                    flex
                    items-center
                    px-4
                "
            >

                <img
                    src="{{ asset('images/icons/icon_cari.png') }}"
                    alt="Cari"
                    class="
                        w-[20px]
                        h-[20px]
                        object-contain
                        mr-3
                    "
                >

                <input
                    type="text"
                    placeholder="Search"
                    class="
                        w-full
                        bg-transparent
                        text-[18px]
                        text-gray-600
                        focus:outline-none
                    "
                >

            </div>



            {{-- =================================================
                FILTER
            ================================================== --}}
            <button
                class="
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
                "
            >

                <img
                    src="{{ asset('images/icons/filter.png') }}"
                    alt="Filter"
                    class="
                        w-[20px]
                        h-[20px]
                        object-contain
                    "
                >

                <span>
                    Filter
                </span>

            </button>



            {{-- =================================================
                KELAS 10
            ================================================== --}}
            <button
                class="
                    w-[130px]
                    h-[45px]
                    bg-white
                    rounded-full
                    shadow-sm
                    text-gray-600
                    font-semibold
                    text-[18px]
                "
            >
                Kelas 10
            </button>



            {{-- =================================================
                KELAS 11
            ================================================== --}}
            <button
                class="
                    w-[130px]
                    h-[45px]
                    bg-white
                    rounded-full
                    shadow-sm
                    text-gray-600
                    font-semibold
                    text-[18px]
                "
            >
                Kelas 11
            </button>



            {{-- =================================================
                KELAS 12
            ================================================== --}}
            <button
                class="
                    w-[130px]
                    h-[45px]
                    bg-white
                    rounded-full
                    shadow-sm
                    text-gray-600
                    font-semibold
                    text-[18px]
                "
            >
                Kelas 12
            </button>

        </div>



        {{-- =====================================================
            TABLE SISWA
        ====================================================== --}}
        <div
            class="
                bg-white
                rounded-[9px]
                shadow-sm
                overflow-hidden
            "
        >

            <div class="overflow-x-auto">

                <table class="w-full">


                    {{-- =================================================
                        HEADER TABLE
                    ================================================== --}}
                    <thead>

                        <tr class="border-b border-gray-200">


                            {{-- NO --}}
                            <th
                                class="
                                    w-[55px]
                                    px-3
                                    py-3
                                    text-center
                                    text-gray-700
                                    font-bold
                                    text-[18px]
                                "
                            >
                                No.
                            </th>



                            {{-- NAMA --}}
                            <th
                                class="
                                    w-[270px]
                                    px-3
                                    py-3
                                    text-left
                                    text-gray-700
                                    font-bold
                                    text-[18px]
                                "
                            >
                                Nama
                            </th>



                            {{-- KELAS --}}
                            <th
                                class="
                                    w-[140px]
                                    px-3
                                    py-3
                                    text-left
                                    text-gray-700
                                    font-bold
                                    text-[18px]
                                "
                            >
                                Kelas
                            </th>



                            {{-- TAGIHAN --}}
                            <th
                                class="
                                    w-[220px]
                                    px-3
                                    py-3
                                    text-left
                                    text-gray-700
                                    font-bold
                                    text-[18px]
                                "
                            >
                                Tagihan
                            </th>



                            {{-- STATUS --}}
                            <th
                                class="
                                    w-[180px]
                                    px-3
                                    py-3
                                    text-left
                                    text-gray-700
                                    font-bold
                                    text-[18px]
                                "
                            >
                                Status
                            </th>



                            {{-- AKSI --}}
                            <th
                                class="
                                    w-[100px]
                                    px-3
                                    py-3
                                    text-left
                                    text-gray-700
                                    font-bold
                                    text-[18px]
                                "
                            >
                                Aksi
                            </th>

                        </tr>

                    </thead>



                    {{-- =================================================
                        BODY TABLE
                    ================================================== --}}
                    <tbody>

                        @foreach ($students as $student)

                            <tr
                                class="
                                    border-b
                                    border-gray-200
                                    hover:bg-gray-50
                                    transition
                                "
                            >


                                {{-- NO --}}
                                <td
                                    class="
                                        px-3
                                        py-2.5
                                        text-center
                                        text-gray-700
                                        font-semibold
                                        text-[18px]
                                    "
                                >
                                    {{ $student['id'] }}
                                </td>



                                {{-- NAMA --}}
                                <td
                                    class="
                                        px-3
                                        py-2.5
                                        text-left
                                        text-gray-700
                                        font-semibold
                                        text-[18px]
                                        whitespace-nowrap
                                    "
                                >
                                    {{ $student['name'] }}
                                </td>



                                {{-- KELAS --}}
                                <td
                                    class="
                                        px-3
                                        py-2.5
                                        text-left
                                        text-gray-700
                                        font-semibold
                                        text-[18px]
                                        whitespace-nowrap
                                    "
                                >
                                    12 TKJ 1
                                </td>



                                {{-- TAGIHAN --}}
                                <td
                                    class="
                                        px-3
                                        py-2.5
                                        text-left
                                        text-gray-700
                                        font-semibold
                                        text-[18px]
                                        whitespace-nowrap
                                    "
                                >
                                    {{ $student['tuition'] }}
                                </td>



                                {{-- STATUS --}}
                                <td
                                    class="
                                        px-3
                                        py-2.5
                                        text-left
                                        font-semibold
                                        text-[18px]
                                        whitespace-nowrap
                                    "
                                >

                                    @if ($student['status'] === 'Lunas')

                                        <span class="text-green-500">
                                            Lunas
                                        </span>

                                    @else

                                        <span class="text-red-400">
                                            Belum Lunas
                                        </span>

                                    @endif

                                </td>



                                {{-- AKSI --}}
                                <td
                                    class="
                                        px-3
                                        py-2.5
                                        text-left
                                        font-semibold
                                        text-[18px]
                                        whitespace-nowrap
                                    "
                                >

                                    <a
                                        href="/students/{{ $student['id'] }}"
                                        class="
                                            text-[#FFC857]
                                            hover:underline
                                        "
                                    >
                                        Detail
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection