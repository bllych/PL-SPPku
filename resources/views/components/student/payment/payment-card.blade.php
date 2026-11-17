@props([
    'month',
    'amount',
    'date',
    'method',
    'status'
])

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
            SPP {{ $month }}
        </h3>

        <p class="mt-0.5 text-[14px] text-gray-400">
            Bulan pembayaran
        </p>

        <p class="mt-0.5 text-[15px] font-medium text-[#38b8ed]">
            {{ $amount }}
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
                {{ $date }}
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
                {{ $method }}
            </p>
        </div>

    </div>

    <!-- STATUS + BUTTON -->
    <div class="flex w-[140px] flex-col items-center gap-2">

        <x-status-badge :status="$status" />

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