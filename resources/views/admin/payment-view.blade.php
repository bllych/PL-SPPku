<style>
    * {
        /* border: 0.5px solid red; */
    }
</style>

@extends('layouts.app')

@section ('title', $title)

@section ('content')
    <div class="flex flex-col gap-4">

        <div class="flex flex-row justify-between">
            <div>
                <p class="font-semibold text-[#45C0F4] text-xl">CEK PEMBAYARAN</p>
                <p class="font-medium text-[#999999] text-sm">Verifikasi pembayaran SPP siswa</p>
            </div>
            <div class="flex items-center gap-4">

                <x-admin.month-dropdown />

                <div>
                    <a href="#"
                        class="bg-white py-2 px-4 rounded-lg border-2 border-[#000000]/15 text-[#45C0F4] text-md font-semibold flex flex-row gap-2 items-center">

                        <img src="{{ asset('images/icons/download.png') }}" alt="icon-list" class="w-auto h-6">

                        Ekspor
                    </a>
                </div>

            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-5 items-start">

            <div class="lg:col-span-4 flex flex-col gap-4">
                @php
                    $stats = [
                        ['title' => 'Menunggu Verifikasi', 'count' => 8, 'icon' => 'pending.png'],
                        ['title' => 'Terverifikasi', 'count' => 24, 'icon' => 'verified.png'],
                        ['title' => 'Ditolak', 'count' => 1, 'icon' => 'rejected.png'],
                        ['title' => 'Total Bulan Ini', 'count' => 32, 'icon' => 'total.png'],
                    ];
                @endphp

                <x-admin.payment.statistics :stats="$stats" />

                <x-admin.payment.search-filter />

                @php
                    $payments = [
                        ['no' => 1, 'nama' => 'Alfredy Rudy', 'nisn' => '00987654321', 'kelas' => 'XII TKJ 1', 'nominal' => 'Rp840.000,00', 'metode' => 'Transfer Bank BCA', 'tanggal' => '01 Sep 2026', 'jam' => '10:15', 'status' => 'Menunggu'],
                        ['no' => 2, 'nama' => 'Britania Fisichella', 'nisn' => '00987654330', 'kelas' => 'XII TKJ 1', 'nominal' => 'Rp840.000,00', 'metode' => 'E-Wallet OVO', 'tanggal' => '01 Sep 2026', 'jam' => '10:15', 'status' => 'Terverifikasi'],
                        ['no' => 3, 'nama' => 'Aricks Wijaya', 'nisn' => '00987654325', 'kelas' => 'XII TKJ 1', 'nominal' => 'Rp840.000,00', 'metode' => 'Tunai', 'tanggal' => '01 Sep 2026', 'jam' => '10:15', 'status' => 'Terverifikasi'],
                        ['no' => 4, 'nama' => 'Arthur Sebastian Felix', 'nisn' => '00987654326', 'kelas' => 'XII TKJ 1', 'nominal' => 'Rp840.000,00', 'metode' => 'Transfer Bank BRI', 'tanggal' => '01 Sep 2026', 'jam' => '10:15', 'status' => 'Menunggu'],
                        ['no' => 5, 'nama' => 'Charles', 'nisn' => '00987654331', 'kelas' => 'XII TKJ 1', 'nominal' => 'Rp840.000,00', 'metode' => 'E-Wallet DANA', 'tanggal' => '01 Sep 2026', 'jam' => '10:15', 'status' => 'Terverifikasi']
                    ];
                @endphp

                <x-admin.payment.payment-table :payments="$payments" />

                <x-admin.pagination :currentPage="1" :totalPages="5" />
            </div>

            {{-- PART 3: Detail Pembayaran --}}
            <x-admin.payment.payment-detail />
        </div>
    </div>
@endsection