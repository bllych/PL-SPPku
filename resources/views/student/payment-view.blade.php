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
                Riwayat tagihan SPP milik {{ $student->user->name }}
            </p>
        </div>

        <x-student.payment.filter
            :school-years="$schoolYears"
            :selected-school-year="$selectedSchoolYear"
            :selected-status="$selectedStatus"
            :search="$search"
        />

        <div class="space-y-5">
            @forelse ($payments as $payment)
                <x-student.payment.payment-card :payment="$payment" />
            @empty
                <div class="rounded-xl border border-gray-200 bg-white px-6 py-10 text-center text-gray-500 shadow-sm">
                    Tidak ada tagihan yang cocok dengan filter ini.
                </div>
            @endforelse
        </div>

    </div>
</main>

@endsection
