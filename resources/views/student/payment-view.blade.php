@extends('layouts.app')

@section('title', $title)

@section('content')

<main class="min-h-screen bg-[#f4f5ff] px-6 py-8 lg:ml-[88px]">
    <div class="mx-auto max-w-[1100px]">

        <!-- HEADER CONTENT -->
        <div class="mb-5">
            <h1 class="text-[20px] font-bold text-[#45c0F4]">
                RIWAYAT & BUKTI PEMBAYARAN
            </h1>

            <p class="mt-1 text-[16px] text-gray-400">
                Informasi tentang riwayat & bukti pembayaran SPP anda
            </p>
        </div>

        <!-- FILTER -->
        <x-student.payment.filter />

        <!-- PAYMENT LIST -->
        <div class="space-y-5">

            <x-student.payment.payment-card
                month="April 2026"
                amount="Rp 850.000"
                date="s/d 15 April 2026"
                method="QRIS"
                status="Belum Lunas"
            />

            <x-student.payment.payment-card
                month="Maret 2026"
                amount="Rp 850.000"
                date="s/d 15 Maret 2026"
                method="Transfer Bank"
                status="Terlambat"
            />

            <x-student.payment.payment-card
                month="Febuari 2026"
                amount="Rp 850.000"
                date="10 Februari 2026"
                method="E-Wallet (OVO)"
                status="Lunas"
            />

            <x-student.payment.payment-card
                month="Januari 2026"
                amount="Rp 850.000"
                date="08 Januari 2025"
                method="Tunai (Kas Sekolah)"
                status="Lunas"
            />

        </div>

    </div>
</main>

@endsection