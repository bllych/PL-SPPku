@props([
    'studentId',
    'billId' => null,
    'period',
    'amount',
    'dueDate',
    'status' => 'Belum Dibayar',
    'date',
    'studentName',
])

@php
    $statusColor = match ($status) {
        'Lunas' => 'text-green-500',
        'Menunggu Verifikasi Admin' => 'text-[#FFB83E]',
        'Tidak Ada Tagihan' => 'text-gray-400',
        default => 'text-[#F43F5E]',
    };
    $canPay = $billId !== null &&$status !== 'Lunas';
@endphp

<div class="w-full">

    <h2 class="text-[#45C0F4] text-lg font-bold mb-3">
        PEMBAYARAN SELANJUTNYA
    </h2>

    <div class="bg-white rounded-xl shadow-md px-6 sm:px-10 py-6 min-h-[400px] flex flex-col justify-between">

        <div>
            {{-- BANK --}}
            <div class="flex items-center gap-4 border-b pb-4">
                <img
                    src="{{ asset('images/logo/BCA.png') }}"
                    class="w-28 sm:w-32"
                    alt="BCA"
                >

                <div>
                    <p class="text-base font-semibold text-[#4E4E4E]">BCA Virtual Account</p>
                    <p class="text-base text-[#4E4E4E]">No. 123456789098765</p>
                </div>
            </div>

            {{-- DETAIL TAGIHAN --}}
            <div class="flex flex-col gap-4 mt-5">
                <div class="flex justify-between gap-4">
                    <span class="text-[#4E4E4E] text-base font-semibold">Periode</span>
                    <span class="text-[#999999] text-base font-medium text-right">{{ $period }}</span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-[#4E4E4E] text-base font-semibold">Total Tagihan</span>
                    <span class="text-[#999999] text-base font-medium text-right">{{ $amount }}</span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-[#4E4E4E] text-base font-semibold">Jatuh Tempo</span>
                    <span class="text-[#999999] text-base font-medium text-right">{{ $dueDate }}</span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-[#4E4E4E] text-base font-semibold">Status Pembayaran</span>
                    <span class="{{ $statusColor }} text-base font-semibold text-right">{{ $status }}</span>
                </div>
            </div>
        </div>

        {{-- AREA KONFIRMASI & TOMBOL AKSI (Rapi di dalam kartu) --}}
        <div class="mt-5 pt-3 border-t border-gray-100">
            @if (session('success'))
                <div role="status" class="mb-3 rounded-lg border border-green-300 bg-green-50 px-3.5 py-2.5 text-xs sm:text-sm font-medium text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-end">
                @if ($canPay)
                    <a
                        href="{{ route('students.payments.create', ['id' => $studentId, 'bill_id' =>$billId]) }}"
                        class="inline-flex items-center justify-center bg-[#45C0F4] text-white text-base font-semibold px-5 py-2.5 rounded-lg shadow-md transition hover:bg-sky-500 focus:outline-none focus:ring-2 focus:ring-[#45C0F4] focus:ring-offset-2"
                    >
                        {{ $status === 'Menunggu Verifikasi Admin' ? 'Kirim Ulang Bukti' : 'Lakukan Pembayaran' }}
                    </a>
                @else
                    <span class="inline-flex items-center rounded-lg bg-green-50 px-4 py-2 text-sm font-semibold text-green-600">
                        {{ $status === 'Lunas' ? 'Tagihan Lunas' : 'Belum Ada Tagihan Aktif' }}
                    </span>
                @endif
            </div>
        </div>
    </div>

</div>