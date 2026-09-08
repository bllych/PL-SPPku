@extends('layouts.app')

@section ('title', $title)

@section ('content')

<main class="min-h-screen bg-[#f4f5ff] px-6 py-8 lg:ml-[88px]">
    <div class="mx-auto max-w-[1080px]">

        {{-- Filter --}}
        <div class="mb-8 flex flex-wrap items-center gap-3">

            {{-- Search --}}
            <div class="relative w-full md:w-[370px]">
                <input
                    type="text"
                    placeholder="Search"
                    class="h-[44px] w-full rounded-full border border-gray-200 bg-white
                           px-4 pr-11 text-[17px] text-gray-600 shadow-md
                           outline-none placeholder:text-gray-400
                           focus:border-[#38b8ed]"
                >

                <svg
                    class="absolute right-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="m20 20-4-4"></path>
                </svg>
            </div>


            {{-- Filter --}}
            <button
                type="button"
                class="flex h-[44px] w-[150px] items-center justify-between
                       rounded-full border border-gray-200 bg-white px-5
                       text-[17px] text-gray-400 shadow-md
                       hover:border-[#38b8ed]"
            >
                <span>Filter</span>

                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path d="M4 6h16M7 12h10M10 18h4"></path>
                </svg>
            </button>


            {{-- Bulan --}}
            <button
                type="button"
                class="flex h-[44px] w-[140px] items-center gap-3
                       rounded-full border border-gray-200 bg-white px-4
                       text-[17px] text-gray-400 shadow-md
                       hover:border-[#38b8ed]"
            >
                <svg
                    class="h-5 w-5 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="m20 20-4-4"></path>
                </svg>

                Januari
            </button>


            {{-- Tahun --}}
            <button
                type="button"
                class="flex h-[44px] w-[140px] items-center gap-3
                       rounded-full border border-gray-200 bg-white px-4
                       text-[17px] text-gray-400 shadow-md
                       hover:border-[#38b8ed]"
            >
                <svg
                    class="h-5 w-5 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="m20 20-4-4"></path>
                </svg>

                2026
            </button>


            {{-- Kelas --}}
            <button
                type="button"
                class="flex h-[44px] w-[140px] items-center gap-3
                       rounded-full border border-gray-200 bg-white px-4
                       text-[17px] text-gray-400 shadow-md
                       hover:border-[#38b8ed]"
            >
                <svg
                    class="h-5 w-5 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="m20 20-4-4"></path>
                </svg>

                Kelas 12
            </button>

        </div>


        {{-- Title --}}
        <h1 class="mb-6 text-[21px] font-bold text-[#38b8ed]">
            LAPORAN KEUANGAN
        </h1>


        {{-- File Grid --}}
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">


            {{-- Create New --}}
            <button
                type="button"
                class="flex h-[164px] flex-col items-center justify-center
                       rounded-lg border border-gray-200 bg-white
                       shadow-sm transition hover:-translate-y-1 hover:shadow-md"
            >
                <div class="relative mb-3">

                    {{-- Folder --}}
                    <svg
                        class="h-[76px] w-[76px] text-[#38b8ed]"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path d="M3 6.5A2.5 2.5 0 0 1 5.5 4h4l2 2H18.5A2.5 2.5 0 0 1 21 8.5v8A2.5 2.5 0 0 1 18.5 19h-13A2.5 2.5 0 0 1 3 16.5v-10Z"/>
                    </svg>

                    {{-- Plus --}}
                    <span
                        class="absolute -bottom-1 -right-2 flex h-9 w-9
                               items-center justify-center text-[38px]
                               font-light leading-none text-[#38b8ed]"
                    >
                        +
                    </span>
                </div>

                <span class="text-[17px] font-semibold text-gray-600">
                    Create New
                </span>
            </button>


                            {{-- File --}}
        <div
                class="relative flex h-[164px] flex-col items-center justify-center
                rounded-lg border border-gray-200 bg-white
                shadow-sm transition hover:-translate-y-1 hover:shadow-md">

            <!-- More button -->
            <button
                type="button"
                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <circle cx="12" cy="5" r="1.5"/>
                    <circle cx="12" cy="12" r="1.5"/>
                    <circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>

            <!-- File Icon  -->
            <img
                src="{{ asset('images/icons/excel.png') }}"
                alt="Excel"
                class="mb-2 h-[84px] w-[70px] object-contain"
            >

            <!-- File Name -->
            <p class="max-w-[230px] truncate text-[16px] font-semibold text-gray-600">
                12TKJ1_Agu_2026.xlsx
            </p>

            <!-- Modified Date -->
            <p class="mt-1 text-[15px] text-gray-400">
                Modified 20/Aug/2026
            </p>

        </div>

                            {{-- File --}}
        <div
                class="relative flex h-[164px] flex-col items-center justify-center
                rounded-lg border border-gray-200 bg-white
                shadow-sm transition hover:-translate-y-1 hover:shadow-md">

            <!-- More button -->
            <button
                type="button"
                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <circle cx="12" cy="5" r="1.5"/>
                    <circle cx="12" cy="12" r="1.5"/>
                    <circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>

            <!-- File Icon  -->
            <img
                src="{{ asset('images/icons/excel.png') }}"
                alt="Excel"
                class="mb-2 h-[84px] w-[70px] object-contain"
            >

            <!-- File Name -->
            <p class="max-w-[230px] truncate text-[16px] font-semibold text-gray-600">
                12TKJ1_Agu_2026.xlsx
            </p>

            <!-- Modified Date -->
            <p class="mt-1 text-[15px] text-gray-400">
                Modified 20/Aug/2026
            </p>

        </div>

                            {{-- File --}}
        <div
                class="relative flex h-[164px] flex-col items-center justify-center
                rounded-lg border border-gray-200 bg-white
                shadow-sm transition hover:-translate-y-1 hover:shadow-md">

            <!-- More button -->
            <button
                type="button"
                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <circle cx="12" cy="5" r="1.5"/>
                    <circle cx="12" cy="12" r="1.5"/>
                    <circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>

            <!-- File Icon  -->
            <img
                src="{{ asset('images/icons/excel.png') }}"
                alt="Excel"
                class="mb-2 h-[84px] w-[70px] object-contain"
            >

            <!-- File Name -->
            <p class="max-w-[230px] truncate text-[16px] font-semibold text-gray-600">
                12TKJ1_Agu_2026.xlsx
            </p>

            <!-- Modified Date -->
            <p class="mt-1 text-[15px] text-gray-400">
                Modified 20/Aug/2026
            </p>

        </div>

                    {{-- File --}}
        <div
                class="relative flex h-[164px] flex-col items-center justify-center
                rounded-lg border border-gray-200 bg-white
                shadow-sm transition hover:-translate-y-1 hover:shadow-md">

            <!-- More button -->
            <button
                type="button"
                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <circle cx="12" cy="5" r="1.5"/>
                    <circle cx="12" cy="12" r="1.5"/>
                    <circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>

            <!-- File Icon  -->
            <img
                src="{{ asset('images/icons/excel.png') }}"
                alt="Excel"
                class="mb-2 h-[84px] w-[70px] object-contain"
            >

            <!-- File Name -->
            <p class="max-w-[230px] truncate text-[16px] font-semibold text-gray-600">
                12TKJ1_Agu_2026.xlsx
            </p>

            <!-- Modified Date -->
            <p class="mt-1 text-[15px] text-gray-400">
                Modified 20/Aug/2026
            </p>

        </div>

                            {{-- File --}}
        <div
                class="relative flex h-[164px] flex-col items-center justify-center
                rounded-lg border border-gray-200 bg-white
                shadow-sm transition hover:-translate-y-1 hover:shadow-md">

            <!-- More button -->
            <button
                type="button"
                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <circle cx="12" cy="5" r="1.5"/>
                    <circle cx="12" cy="12" r="1.5"/>
                    <circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>

            <!-- File Icon  -->
            <img
                src="{{ asset('images/icons/excel.png') }}"
                alt="Excel"
                class="mb-2 h-[84px] w-[70px] object-contain"
            >

            <!-- File Name -->
            <p class="max-w-[230px] truncate text-[16px] font-semibold text-gray-600">
                12TKJ1_Agu_2026.xlsx
            </p>

            <!-- Modified Date -->
            <p class="mt-1 text-[15px] text-gray-400">
                Modified 20/Aug/2026
            </p>

        </div>

                            {{-- File --}}
        <div
                class="relative flex h-[164px] flex-col items-center justify-center
                rounded-lg border border-gray-200 bg-white
                shadow-sm transition hover:-translate-y-1 hover:shadow-md">

            <!-- More button -->
            <button
                type="button"
                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <circle cx="12" cy="5" r="1.5"/>
                    <circle cx="12" cy="12" r="1.5"/>
                    <circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>

            <!-- File Icon  -->
            <img
                src="{{ asset('images/icons/excel.png') }}"
                alt="Excel"
                class="mb-2 h-[84px] w-[70px] object-contain"
            >

            <!-- File Name -->
            <p class="max-w-[230px] truncate text-[16px] font-semibold text-gray-600">
                12TKJ1_Agu_2026.xlsx
            </p>

            <!-- Modified Date -->
            <p class="mt-1 text-[15px] text-gray-400">
                Modified 20/Aug/2026
            </p>

        </div>


                            {{-- File --}}
        <div
                class="relative flex h-[164px] flex-col items-center justify-center
                rounded-lg border border-gray-200 bg-white
                shadow-sm transition hover:-translate-y-1 hover:shadow-md">

            <!-- More button -->
            <button
                type="button"
                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <circle cx="12" cy="5" r="1.5"/>
                    <circle cx="12" cy="12" r="1.5"/>
                    <circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>

            <!-- File Icon  -->
            <img
                src="{{ asset('images/icons/excel.png') }}"
                alt="Excel"
                class="mb-2 h-[84px] w-[70px] object-contain"
            >

            <!-- File Name -->
            <p class="max-w-[230px] truncate text-[16px] font-semibold text-gray-600">
                12TKJ1_Agu_2026.xlsx
            </p>

            <!-- Modified Date -->
            <p class="mt-1 text-[15px] text-gray-400">
                Modified 20/Aug/2026
            </p>

        </div>

                            {{-- File --}}
        <div
                class="relative flex h-[164px] flex-col items-center justify-center
                rounded-lg border border-gray-200 bg-white
                shadow-sm transition hover:-translate-y-1 hover:shadow-md">

            <!-- More button -->
            <button
                type="button"
                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <circle cx="12" cy="5" r="1.5"/>
                    <circle cx="12" cy="12" r="1.5"/>
                    <circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>

            <!-- File Icon  -->
            <img
                src="{{ asset('images/icons/excel.png') }}"
                alt="Excel"
                class="mb-2 h-[84px] w-[70px] object-contain"
            >

            <!-- File Name -->
            <p class="max-w-[230px] truncate text-[16px] font-semibold text-gray-600">
                12TKJ1_Agu_2026.xlsx
            </p>

            <!-- Modified Date -->
            <p class="mt-1 text-[15px] text-gray-400">
                Modified 20/Aug/2026
            </p>

        </div>


                            {{-- File --}}
        <div
                class="relative flex h-[164px] flex-col items-center justify-center
                rounded-lg border border-gray-200 bg-white
                shadow-sm transition hover:-translate-y-1 hover:shadow-md">

            <!-- More button -->
            <button
                type="button"
                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <circle cx="12" cy="5" r="1.5"/>
                    <circle cx="12" cy="12" r="1.5"/>
                    <circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>

            <!-- File Icon  -->
            <img
                src="{{ asset('images/icons/excel.png') }}"
                alt="Excel"
                class="mb-2 h-[84px] w-[70px] object-contain"
            >

            <!-- File Name -->
            <p class="max-w-[230px] truncate text-[16px] font-semibold text-gray-600">
                12TKJ1_Agu_2026.xlsx
            </p>

            <!-- Modified Date -->
            <p class="mt-1 text-[15px] text-gray-400">
                Modified 20/Aug/2026
            </p>

        </div>


                            {{-- File --}}
        <div
                class="relative flex h-[164px] flex-col items-center justify-center
                rounded-lg border border-gray-200 bg-white
                shadow-sm transition hover:-translate-y-1 hover:shadow-md">

            <!-- More button -->
            <button
                type="button"
                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <circle cx="12" cy="5" r="1.5"/>
                    <circle cx="12" cy="12" r="1.5"/>
                    <circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>

            <!-- File Icon  -->
            <img
                src="{{ asset('images/icons/excel.png') }}"
                alt="Excel"
                class="mb-2 h-[84px] w-[70px] object-contain"
            >

            <!-- File Name -->
            <p class="max-w-[230px] truncate text-[16px] font-semibold text-gray-600">
                12TKJ1_Agu_2026.xlsx
            </p>

            <!-- Modified Date -->
            <p class="mt-1 text-[15px] text-gray-400">
                Modified 20/Aug/2026
            </p>

        </div>


                            {{-- File --}}
        <div
                class="relative flex h-[164px] flex-col items-center justify-center
                rounded-lg border border-gray-200 bg-white
                shadow-sm transition hover:-translate-y-1 hover:shadow-md">

            <!-- More button -->
            <button
                type="button"
                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <circle cx="12" cy="5" r="1.5"/>
                    <circle cx="12" cy="12" r="1.5"/>
                    <circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>

            <!-- File Icon  -->
            <img
                src="{{ asset('images/icons/excel.png') }}"
                alt="Excel"
                class="mb-2 h-[84px] w-[70px] object-contain"
            >

            <!-- File Name -->
            <p class="max-w-[230px] truncate text-[16px] font-semibold text-gray-600">
                12TKJ1_Agu_2026.xlsx
            </p>

            <!-- Modified Date -->
            <p class="mt-1 text-[15px] text-gray-400">
                Modified 20/Aug/2026
            </p>

        </div>


                            {{-- File --}}
        <div
                class="relative flex h-[164px] flex-col items-center justify-center
                rounded-lg border border-gray-200 bg-white
                shadow-sm transition hover:-translate-y-1 hover:shadow-md">

            <!-- More button -->
            <button
                type="button"
                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <circle cx="12" cy="5" r="1.5"/>
                    <circle cx="12" cy="12" r="1.5"/>
                    <circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>

            <!-- File Icon  -->
            <img
                src="{{ asset('images/icons/excel.png') }}"
                alt="Excel"
                class="mb-2 h-[84px] w-[70px] object-contain"
            >

            <!-- File Name -->
            <p class="max-w-[230px] truncate text-[16px] font-semibold text-gray-600">
                12TKJ1_Agu_2026.xlsx
            </p>

            <!-- Modified Date -->
            <p class="mt-1 text-[15px] text-gray-400">
                Modified 20/Aug/2026
            </p>

        </div>


                            {{-- File --}}
        <div
                class="relative flex h-[164px] flex-col items-center justify-center
                rounded-lg border border-gray-200 bg-white
                shadow-sm transition hover:-translate-y-1 hover:shadow-md">

            <!-- More button -->
            <button
                type="button"
                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <circle cx="12" cy="5" r="1.5"/>
                    <circle cx="12" cy="12" r="1.5"/>
                    <circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>

            <!-- File Icon  -->
            <img
                src="{{ asset('images/icons/excel.png') }}"
                alt="Excel"
                class="mb-2 h-[84px] w-[70px] object-contain"
            >

            <!-- File Name -->
            <p class="max-w-[230px] truncate text-[16px] font-semibold text-gray-600">
                12TKJ1_Agu_2026.xlsx
            </p>

            <!-- Modified Date -->
            <p class="mt-1 text-[15px] text-gray-400">
                Modified 20/Aug/2026
            </p>

        </div>







                    {{-- File --}}
            <div
                class="relative flex h-[164px] flex-col items-center justify-center
                rounded-lg border border-gray-200 bg-white
                shadow-sm transition hover:-translate-y-1 hover:shadow-md">

            <!-- More button -->
            <button
                type="button"
                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <circle cx="12" cy="5" r="1.5"/>
                    <circle cx="12" cy="12" r="1.5"/>
                    <circle cx="12" cy="19" r="1.5"/>
                </svg>
            </button>

            <!-- File Icon  -->
            <img
                src="{{ asset('images/icons/excel.png') }}"
                alt="Excel"
                class="mb-2 h-[84px] w-[70px] object-contain"
            >

            <!-- File Name -->
            <p class="max-w-[230px] truncate text-[16px] font-semibold text-gray-600">
                12TKJ1_Agu_2026.xlsx
            </p>

            <!-- Modified Date -->
            <p class="mt-1 text-[15px] text-gray-400">
                Modified 20/Aug/2026
            </p>

        </div>


    </div>
</main>

@endsection