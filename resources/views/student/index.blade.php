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
        <x-student.profile-payment-status />


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
                        <span class="text-[#999999] font-medium">
                            Maxendra Alexius Kaendra
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">NISN/Nomor Induk</span>
                        <span class="text-[#999999] font-medium">
                            0094512345/9696
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Tahun Ajaran</span>
                        <span class="text-[#999999] font-medium">
                            2026/2027
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Semester</span>
                        <span class="text-[#999999] font-medium">
                            Ganjil
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Total Bulan</span>
                        <span class="text-[#999999] font-medium">
                            6 Bulan
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Sudah Dibayar</span>
                        <span class="text-[#999999] font-medium">
                            2 Bulan
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Sisa Pembayaran</span>
                        <span class="text-[#999999] font-medium">
                            4 Bulan
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">
                            Butuh Bantuan?
                        </span>

                        <a href="#" class="text-[#FFB83E] underline font-medium">
                            Hubungi Tata Usaha →
                        </a>
                    </div>

                </div>

            </div>


            {{-- PEMBAYARAN SELANJUTNYA --}}
            <x-student.next-payment />

        </div>

    </div>

@endsection