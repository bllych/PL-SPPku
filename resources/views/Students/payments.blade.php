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
        
    </div>
</main>

@endsection