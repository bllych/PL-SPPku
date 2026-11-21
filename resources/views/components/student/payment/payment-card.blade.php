@props(['payment'])

<div class="flex min-h-[102px] items-center rounded-xl border border-gray-200 bg-white px-7 py-3 shadow-sm">
    <div class="flex h-[58px] w-[58px] shrink-0 items-center justify-center rounded-full bg-[#d9f4ff]">
        <svg class="h-8 w-8 text-[#38b8ed]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
            <rect x="3" y="5" width="18" height="16" rx="2" />
            <path d="M16 3v4M8 3v4M3 10h18" />
            <path d="M8 14h2M14 14h2M8 18h2M14 18h2" />
        </svg>
    </div>

    <div class="ml-6 w-[270px]">
        <h3 class="text-[20px] font-semibold text-[#505050]">SPP {{ $payment['month'] }}</h3>
        <p class="mt-0.5 text-[14px] text-gray-400">Bulan pembayaran</p>
        <p class="mt-0.5 text-[15px] font-medium text-[#38b8ed]">{{ $payment['amount'] }}</p>
    </div>

    <div class="h-[72px] w-px bg-gray-200"></div>

    <div class="ml-4 flex-1">
        <div class="flex items-center gap-2">
            <svg class="h-[18px] w-[18px] text-black" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                <rect x="3" y="4" width="18" height="17" rx="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />
            </svg>
            <span class="text-[14px] text-gray-400">{{ $payment['due_date'] }}</span>
        </div>

        <div class="mt-3">
            <p class="text-[14px] text-gray-400">Metode pembayaran</p>
            <p class="mt-0.5 text-[14px] font-semibold text-gray-700">{{ $payment['payment_method'] }}</p>
            <p class="mt-0.5 text-[13px] text-gray-500">Status transaksi: {{ $payment['transaction_status'] }}</p>
        </div>
    </div>

    <div class="flex w-[140px] flex-col items-center gap-2">
        <x-status-badge :status="$payment['bill_status']" />

        @if ($payment['proof_image'])
            <a
                href="{{ asset($payment['proof_image']) }}"
                target="_blank"
                rel="noopener noreferrer"
                class="flex h-[34px] w-[140px] items-center justify-center rounded-lg border-2 border-[#38b8ed] text-[15px] font-semibold text-[#38b8ed] transition hover:bg-[#38b8ed] hover:text-white"
            >
                Lihat bukti
            </a>
        @else
            <span class="flex h-[34px] w-[140px] items-center justify-center rounded-lg border border-gray-200 text-center text-xs text-gray-400">
                Belum ada bukti
            </span>
        @endif
    </div>
</div>
