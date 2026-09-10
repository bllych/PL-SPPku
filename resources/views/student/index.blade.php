<style>
    /* * {
        border: 1px solid red;
    } */
</style>

@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="flex flex-col gap-5">

        {{-- PROFILE + STATUS PEMBAYARAN --}}
        <div class="bg-white rounded-xl shadow-md p-3 flex items-center">

            {{-- Profile --}}
            <div class="flex items-center w-1/2 gap-4 py-2 border-r border-gray-300">
                <img src="{{ asset('images/icons/profile.png') }}" class="w-24 h-24 rounded-full" alt="Profile">

                <div>
                    <p class="text-[#45C0F4] font-bold text-lg">
                        MAXENDRA ALEXIUS KAENDRA
                    </p>

                    <p class="text-[#4E4E4E] font-semibold">
                        XII TKJ 1
                    </p>

                    <p class="text-[#4E4E4E] font-semibold">
                        SMK Kristen Immanuel
                    </p>
                </div>
            </div>

            {{-- Status Pembayaran --}}
            <div class="w-1/2 pl-8">

                <h2 class="text-[#45C0F4] text-lg font-bold mb-3 flex items-center">
                    STATUS PEMBAYARAN SEMESTER GANJIL

                    <img src="{{ asset('images/icons/switch.png') }}"
                        alt="switch"
                        class="w-5 h-5 ml-2">
                </h2>

                <div class="flex gap-5">

                    <div class="w-11 h-11 rounded-full bg-[#45C0F4] text-white text-sm flex items-center justify-center">
                        Jul
                    </div>

                    <div class="w-11 h-11 rounded-full bg-[#45C0F4] text-white text-sm flex items-center justify-center">
                        Agu
                    </div>

                    <div class="w-11 h-11 rounded-full bg-[#999999] text-white text-sm flex items-center justify-center">
                        Sep
                    </div>

                    <div class="w-11 h-11 rounded-full bg-[#999999] text-white text-sm flex items-center justify-center">
                        Okt
                    </div>

                    <div class="w-11 h-11 rounded-full bg-[#999999] text-white text-sm flex items-center justify-center">
                        Nov
                    </div>

                    <div class="w-11 h-11 rounded-full bg-[#999999] text-white text-sm flex items-center justify-center">
                        Des
                    </div>

                </div>

            </div>

        </div>


        {{-- BAGIAN BAWAH --}}
        <div class="grid grid-cols-2 gap-5 items-stretch">

            {{-- DETAIL INFORMASI --}}
            <div class="w-full">

                <h2 class="text-[#45C0F4] text-xl font-semibold mb-3">
                    DETAIL INFORMASI
                </h2>

                <div class="bg-white rounded-xl shadow-md p-7 h-[400px] flex flex-col gap-5">

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Nama</span>
                        <span class="text-[#999999] font-medium">Maxendra Alexius Kaendra</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">NISN/Nomor Induk</span>
                        <span class="text-[#999999] font-medium">0094512345/9696</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Tahun Ajaran</span>
                        <span class="text-[#999999] font-medium">2026/2027</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Semester</span>
                        <span class="text-[#999999] font-medium">Ganjil</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Total Bulan</span>
                        <span class="text-[#999999] font-medium">6 Bulan</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Sudah Dibayar</span>
                        <span class="text-[#999999] font-medium">2 Bulan</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Sisa Pembayaran</span>
                        <span class="text-[#999999] font-medium">4 Bulan</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Butuh Bantuan?</span>

                        <a href="#" class="text-[#FFB83E] underline font-medium">
                            Hubungi Tata Usaha →
                        </a>
                    </div>

                </div>

            </div>


            {{-- PEMBAYARAN SELANJUTNYA --}}
            <div class="w-full">

                <h2 class="text-[#45C0F4] text-xl font-semibold mb-3">
                    PEMBAYARAN SELANJUTNYA
                </h2>

                <div class="bg-white rounded-xl shadow-md p-7 h-[400px] flex flex-col">

                    {{-- BANK --}}
                    <div class="flex items-center gap-4 border-b pb-4">

                        <img src="{{ asset('images/logo/BCA.png') }}"
                            class="w-32"
                            alt="BCA">

                        <div>
                            <p class="text-lg font-semibold text-[#4E4E4E]">
                                BCA Virtual Account
                            </p>

                            <p class="text-base text-[#4E4E4E]">
                                No. 123456789098765
                            </p>
                        </div>

                    </div>


                    {{-- DETAIL TAGIHAN --}}
                    <div class="flex flex-col gap-6 mt-5">

                        <div class="flex justify-between">
                            <span class="text-[#4E4E4E] font-semibold">Periode</span>
                            <span class="text-[#999999] font-medium">September 2026</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-[#4E4E4E] font-semibold">Total Tagihan</span>
                            <span class="text-[#999999] font-medium">Rp840.000,00</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-[#4E4E4E] font-semibold">Jatuh Tempo</span>
                            <span class="text-[#999999] font-medium">14 September 2026</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-[#4E4E4E] font-semibold">Status Pembayaran</span>
                            <span class="text-[#F43F5E] font-medium">Belum Dibayar</span>
                        </div>

                    </div>


                    {{-- BUTTON --}}
                    <div class="flex justify-end mt-auto">

                        <a href="#"
                            class="bg-[#45C0F4] text-white font-semibold px-4 py-2.5 rounded-lg shadow-md hover:bg-sky-500">
                            Lakukan Pembayaran
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection