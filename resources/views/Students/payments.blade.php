@extends('layouts.app')

@section ('title', $title)

@section ('content')

<!-- MAIN CONTENT -->
<main class="min-h-screen bg-[#f4f5ff] px-6 py-8 lg:ml-[88px]">
    <div class="mx-auto max-w-[1100px]">
        <!-- HEADER CONTENT -->
        <div class="mb-5">
            <h1 class="text-[20px] font-bold text-[#45c0F4]">RIWAYAT & BUKTI PEMBAYARAN</h1>
            <p class="mt-1 text-[16px] text-gray-400">Informasi tentang riwayat & bukti pembayaran SPP anda</p>
        </div>  

        <!-- FILTER -->
        <div class="mb-5 flex flex-col gap-3 md:flex-row">
            
            <!-- SEARCH -->
            <div class="mb-5 flex flex-col gap-3 md:flex-row">
                <input 
                    type="text" placeholder="Cari pembayaran..." 
                    class="h-[42px] w-full rounded-full border
                     border-gray-200 bg-white px-4 pr-11 text-sm
                     text-gray-600 outline-none transition">

                <!-- Search Icon -->
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

            <!-- STATUS -->
            <div class="relative w-full md:w-[160px] h-[42px]">
                <select
                    class="h-full w-full appearance-none rounded-lg border border-gray-200
                    bg-white pl-4 pr-10 py-0 text-sm text-gray-500
                    outline-none
                    focus:border-[#38b8ed]
                    focus:ring-2 focus:ring-[#38b8ed]/20"
                >
                    <option value="">Semua Status</option>
                    <option value="">Lunas</option>
                    <option value="">Belum Lunas</option>
                </select>

                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg
                        class="h-4 w-4 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M6 9l6 6 6-6"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </div>
            </div>
        


            <!-- YEAR -->
            <div class="relative w-full md:w-[112px] h-[42px]">
                <select
                    class="h-full w-full appearance-none rounded-lg border border-gray-200
                        bg-white pl-4 pr-10 py-0 text-sm text-gray-500
                        outline-none
                        focus:border-[#38b8ed]
                        focus:ring-2 focus:ring-[#38b8ed]/20"
                >
                    <option>2026</option>
                    <option>2025</option>
                    <option>2024</option>
                </select>

                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg
                        class="h-4 w-4 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M6 9l6 6 6-6"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </div>
            </div>

            
        </div>

        <!-- PAYMENT LIST -->
        <div class="space-y-5">

            <!-- PAYMENT CARD 1 -->
            <div class="flex min-h-[102px] items-center rounded-xl border border-gray-200 bg-white px-7 py-3 shadow-sm">

                <!-- ICON -->
                <div class="flex h-[58px] w-[58px] shrink-0 items-center justify-center rounded-full bg-[#d9f4ff]">
                    <svg
                        class="h-8 w-8 text-[#38b8ed]"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 24 24"
                    >
                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                        <path d="M16 3v4M8 3v4M3 10h18"/>
                        <path d="M8 14h2M14 14h2M8 18h2M14 18h2"/>
                    </svg>
                </div>


                <!-- PAYMENT INFORMATION -->
                <div class="ml-6 w-[270px]">
                    <h3 class="text-[20px] font-semibold text-[#505050]">
                        SPP April 2026
                    </h3>

                    <p class="mt-0.5 text-[14px] text-gray-400">
                        Bulan pembayaran
                    </p>

                    <p class="mt-0.5 text-[15px] font-medium text-[#38b8ed]">
                        Rp 850.000
                    </p>
                </div>


                <!-- DIVIDER -->
                <div class="h-[72px] w-px bg-gray-200"></div>


                <!-- PAYMENT DETAIL -->
                <div class="ml-4 flex-1">

                    <!-- DATE -->
                    <div class="flex items-center gap-2">
                        <svg
                            class="h-[18px] w-[18px] text-black"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <rect x="3" y="4" width="18" height="17" rx="2"/>
                            <path d="M16 2v4M8 2v4M3 10h18"/>
                        </svg>

                        <span class="text-[14px] text-gray-400">
                            10 April 2026
                        </span>
                    </div>


                    <!-- PAYMENT METHOD -->
                    <div class="mt-3">

                        <div class="flex items-center gap-2">
                            <svg
                                class="h-[18px] w-[18px] text-black"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <rect x="3" y="4" width="18" height="17" rx="2"/>
                                <path d="M16 2v4M8 2v4M3 10h18"/>
                            </svg>

                            <span class="text-[14px] text-gray-400">
                                Metode pembayaran
                            </span>
                        </div>

                        <p class="ml-[26px] mt-0.5 text-[14px] font-semibold text-gray-700">
                            QRIS
                        </p>

                    </div>

                </div>


                <!-- STATUS + BUTTON -->
                <div class="flex w-[140px] flex-col items-center gap-2">

                    <!-- STATUS -->
                    <span class="flex h-[32px] w-[140px] items-center justify-center rounded-lg bg-[#bdfcae] text-[16px] font-semibold text-[#3a9b2c]">
                        Lunas
                    </span>

                    <!-- BUTTON -->
                    <button
                        type="button"
                        class="h-[34px] w-[140px] rounded-lg border-2 border-[#38b8ed]
                            text-[15px] font-semibold text-[#38b8ed]
                            transition hover:bg-[#38b8ed] hover:text-white"
                    >
                        Lihat bukti
                    </button>

                </div>

            </div>


            <!-- PAYMENT CARD 2 -->
            <div class="flex min-h-[102px] items-center rounded-xl border border-gray-200 bg-white px-7 py-3 shadow-sm">

                <!-- ICON -->
                <div class="flex h-[58px] w-[58px] shrink-0 items-center justify-center rounded-full bg-[#d9f4ff]">
                    <svg
                        class="h-8 w-8 text-[#38b8ed]"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 24 24"
                    >
                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                        <path d="M16 3v4M8 3v4M3 10h18"/>
                        <path d="M8 14h2M14 14h2M8 18h2M14 18h2"/>
                    </svg>
                </div>


                <!-- PAYMENT INFORMATION -->
                <div class="ml-6 w-[270px]">
                    <h3 class="text-[20px] font-semibold text-[#505050]">
                        SPP Maret 2026
                    </h3>

                    <p class="mt-0.5 text-[14px] text-gray-400">
                        Bulan pembayaran
                    </p>

                    <p class="mt-0.5 text-[15px] font-medium text-[#38b8ed]">
                        Rp 850.000
                    </p>
                </div>


                <!-- DIVIDER -->
                <div class="h-[72px] w-px bg-gray-200"></div>


                <!-- PAYMENT DETAIL -->
                <div class="ml-4 flex-1">

                    <div class="flex items-center gap-2">
                        <svg class="h-[18px] w-[18px] text-black"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="17" rx="2"/>
                            <path d="M16 2v4M8 2v4M3 10h18"/>
                        </svg>

                        <span class="text-[14px] text-gray-400">
                            10 Maret 2026
                        </span>
                    </div>

                    <div class="mt-3">
                        <div class="flex items-center gap-2">
                            <svg class="h-[18px] w-[18px] text-black"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="17" rx="2"/>
                                <path d="M16 2v4M8 2v4M3 10h18"/>
                            </svg>

                            <span class="text-[14px] text-gray-400">
                                Metode pembayaran
                            </span>
                        </div>

                        <p class="ml-[26px] mt-0.5 text-[14px] font-semibold text-gray-700">
                            Transfer Bank
                        </p>
                    </div>

                </div>


                <!-- STATUS + BUTTON -->
                <div class="flex w-[140px] flex-col items-center gap-2">

                    <span class="flex h-[32px] w-[140px] items-center justify-center rounded-lg bg-[#bdfcae] text-[16px] font-semibold text-[#3a9b2c]">
                        Lunas
                    </span>

                    <button
                        type="button"
                        class="h-[34px] w-[140px] rounded-lg border-2 border-[#38b8ed]
                            text-[15px] font-semibold text-[#38b8ed]
                            transition hover:bg-[#38b8ed] hover:text-white"
                    >
                        Lihat bukti
                    </button>

                </div>

            </div>


            <!-- PAYMENT CARD 3 -->
            <div class="flex min-h-[102px] items-center rounded-xl border border-gray-200 bg-white px-7 py-3 shadow-sm">

                <div class="flex h-[58px] w-[58px] shrink-0 items-center justify-center rounded-full bg-[#d9f4ff]">
                    <svg class="h-8 w-8 text-[#38b8ed]"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                        <path d="M16 3v4M8 3v4M3 10h18"/>
                        <path d="M8 14h2M14 14h2M8 18h2M14 18h2"/>
                    </svg>
                </div>

                <div class="ml-6 w-[270px]">
                    <h3 class="text-[20px] font-semibold text-[#505050]">
                        SPP Febuari 2026
                    </h3>

                    <p class="mt-0.5 text-[14px] text-gray-400">
                        Bulan pembayaran
                    </p>

                    <p class="mt-0.5 text-[15px] font-medium text-[#38b8ed]">
                        Rp 850.000
                    </p>
                </div>

                <div class="h-[72px] w-px bg-gray-200"></div>

                <div class="ml-4 flex-1">

                    <div class="flex items-center gap-2">
                        <svg class="h-[18px] w-[18px] text-black"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="17" rx="2"/>
                            <path d="M16 2v4M8 2v4M3 10h18"/>
                        </svg>

                        <span class="text-[14px] text-gray-400">
                            10 Februari 2026
                        </span>
                    </div>

                    <div class="mt-3">
                        <div class="flex items-center gap-2">
                            <svg class="h-[18px] w-[18px] text-black"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="17" rx="2"/>
                                <path d="M16 2v4M8 2v4M3 10h18"/>
                            </svg>

                            <span class="text-[14px] text-gray-400">
                                Metode pembayaran
                            </span>
                        </div>

                        <p class="ml-[26px] mt-0.5 text-[14px] font-semibold text-gray-700">
                            E-Wallet (OVO)
                        </p>
                    </div>

                </div>

                <div class="flex w-[140px] flex-col items-center gap-2">

                    <span class="flex h-[32px] w-[140px] items-center justify-center rounded-lg bg-[#bdfcae] text-[16px] font-semibold text-[#3a9b2c]">
                        Lunas
                    </span>

                    <button
                        type="button"
                        class="h-[34px] w-[140px] rounded-lg border-2 border-[#38b8ed]
                            text-[15px] font-semibold text-[#38b8ed]
                            transition hover:bg-[#38b8ed] hover:text-white"
                    >
                        Lihat bukti
                    </button>

                </div>

            </div>


            <!-- PAYMENT CARD 4 - MENUNGGU -->
            <div class="flex min-h-[102px] items-center rounded-xl border border-gray-200 bg-white px-7 py-3 shadow-sm">

                <div class="flex h-[58px] w-[58px] shrink-0 items-center justify-center rounded-full bg-[#d9f4ff]">
                    <svg class="h-8 w-8 text-[#38b8ed]"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="16" rx="2"/>
                        <path d="M16 3v4M8 3v4M3 10h18"/>
                        <path d="M8 14h2M14 14h2M8 18h2M14 18h2"/>
                    </svg>
                </div>

                <div class="ml-6 w-[270px]">
                    <h3 class="text-[20px] font-semibold text-[#505050]">
                        SPP Januari 2026
                    </h3>

                    <p class="mt-0.5 text-[14px] text-gray-400">
                        Bulan pembayaran
                    </p>

                    <p class="mt-0.5 text-[15px] font-medium text-[#38b8ed]">
                        Rp 850.000
                    </p>
                </div>

                <div class="h-[72px] w-px bg-gray-200"></div>

                <div class="ml-4 flex-1">

                    <div class="flex items-center gap-2">
                        <svg class="h-[18px] w-[18px] text-black"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="17" rx="2"/>
                            <path d="M16 2v4M8 2v4M3 10h18"/>
                        </svg>

                        <span class="text-[14px] text-gray-400">
                            08 Januari 2025
                        </span>
                    </div>

                    <div class="mt-3">
                        <div class="flex items-center gap-2">
                            <svg class="h-[18px] w-[18px] text-black"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="17" rx="2"/>
                                <path d="M16 2v4M8 2v4M3 10h18"/>
                            </svg>

                            <span class="text-[14px] text-gray-400">
                                Metode pembayaran
                            </span>
                        </div>

                        <p class="ml-[26px] mt-0.5 text-[14px] font-semibold text-gray-700">
                            Tunai (Kas Sekolah)
                        </p>
                    </div>

                </div>

                <div class="flex w-[140px] flex-col items-center gap-2">

                    <span class="flex h-[32px] w-[140px] items-center justify-center rounded-lg bg-[#ffe8a8] text-[16px] font-semibold text-[#e89b00]">
                        Menunggu
                    </span>

                    <button
                        type="button"
                        class="h-[34px] w-[140px] rounded-lg border-2 border-[#38b8ed]
                            text-[15px] font-semibold text-[#38b8ed]
                            transition hover:bg-[#38b8ed] hover:text-white"
                    >
                        Lihat bukti
                    </button>

                </div>

            </div>

        </div>
        
    </div>
</main>

@endsection