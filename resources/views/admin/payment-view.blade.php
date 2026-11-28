@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="flex flex-col gap-4">

        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <p class="font-bold text-[#45C0F4] text-lg">CEK PEMBAYARAN</p>
                <p class="font-medium text-[#999999] text-sm">Verifikasi pembayaran SPP siswa</p>
            </div>
            <div class="flex flex-wrap items-center gap-3 sm:gap-4">

                <x-admin.month-dropdown />

                <div>
                    <a href="{{ route('admin.payments.export', request()->query()) }}"
                        class="bg-white py-2 px-4 rounded-lg border-2 border-[#000000]/15 text-[#45C0F4] text-md font-semibold flex flex-row gap-2 items-center transition hover:border-[#45C0F4] hover:bg-sky-50">

                        <img src="{{ asset('images/icons/download.png') }}" alt="icon-list" class="w-auto h-6">

                        Ekspor
                    </a>
                </div>

            </div>
        </div>

        @if (session('success'))
            <div id="alertSuccess"
                class="flex items-center justify-between rounded-xl border border-green-400 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700 shadow-sm">
                <span>{{ session('success') }}</span>
                <button type="button" onclick="document.getElementById('alertSuccess').remove()"
                    class="text-green-700 hover:text-green-900 font-bold">
                    &times;
                </button>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-5 items-start">

            <div class="lg:col-span-4 flex flex-col gap-4">
                <x-admin.payment.statistics :stats="$stats" />

                <x-admin.payment.search-filter />

                <x-admin.payment.payment-table :payments="$payments" />

                <x-admin.pagination :paginator="$payments" />
            </div>

            {{-- PART 3: Detail Pembayaran --}}
            <x-admin.payment.payment-detail :payment="$selectedPayment" />
        </div>
    </div>
@endsection