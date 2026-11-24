@props(['period', 'amount', 'dueDate', 'date', 'studentName'])

<div class="w-full" data-payment-flow>

    <h2 class="text-[#45C0F4] text-lg font-bold mb-4 py-1">
        PEMBAYARAN SELANJUTNYA
    </h2>

    <div class="bg-white rounded-xl shadow-md px-10 py-8 h-[400px] flex flex-col">

        {{-- BANK --}}
        <div class="flex items-center gap-4 border-b pb-4">
            <img
                src="{{ asset('images/logo/BCA.png') }}"
                class="w-32"
                alt="BCA"
            >

            <div>
                <p class="text-base font-semibold text-[#4E4E4E]">BCA Virtual Account</p>
                <p class="text-base text-[#4E4E4E]">No. 123456789098765</p>
            </div>
        </div>

        {{-- DETAIL TAGIHAN --}}
        <div class="flex flex-col gap-6 mt-5">
            <div class="flex justify-between">
                <span class="text-[#4E4E4E] text-base font-semibold">Periode</span>
                <span class="text-[#999999] text-base font-medium">{{ $period }}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-[#4E4E4E] text-base font-semibold">Total Tagihan</span>
                <span class="text-[#999999] text-base font-medium">{{ $amount }}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-[#4E4E4E] text-base font-semibold">Jatuh Tempo</span>
                <span class="text-[#999999] text-base font-medium">{{ $dueDate }}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-[#4E4E4E] text-base font-semibold">Status Pembayaran</span>
                <span class="text-[#F43F5E] text-base font-medium">Belum Dibayar</span>
            </div>
        </div>

        <div class="flex justify-end mt-auto">
            <button
                type="button"
                data-payment-open
                class="bg-[#45C0F4] text-white text-base font-semibold px-5 py-2.5 rounded-lg shadow-md transition hover:bg-sky-500 focus:outline-none focus:ring-2 focus:ring-[#45C0F4] focus:ring-offset-2"
            >
                Lakukan Pembayaran
            </button>
        </div>
    </div>

    <dialog
        data-payment-summary
        aria-labelledby="payment-summary-title"
        class="m-auto w-[calc(100%-2rem)] max-w-lg rounded-2xl bg-transparent p-0 text-slate-700 shadow-2xl [&::backdrop]:bg-slate-900/50"
    >
        <div class="overflow-hidden rounded-2xl bg-white">
            <div class="flex items-start justify-between bg-[#45C0F4] px-6 py-5 text-white">
                <div>
                    <h3 id="payment-summary-title" class="text-xl font-bold">Ringkasan Pembayaran</h3>
                    <p class="mt-1 text-sm text-white/90">Periksa kembali informasi pembayaran SPP.</p>
                </div>
                <button type="button" data-summary-close aria-label="Tutup ringkasan" class="text-2xl leading-none text-white/90 transition hover:text-white">&times;</button>
            </div>

            <div class="space-y-4 px-6 py-5">
                <div class="flex justify-between gap-4 border-b border-gray-100 pb-3">
                    <span class="text-sm text-gray-500">Tanggal hari ini</span>
                    <span class="text-right text-sm font-semibold text-gray-700">{{ $date }}</span>
                </div>
                <div class="flex justify-between gap-4 border-b border-gray-100 pb-3">
                    <span class="text-sm text-gray-500">Nama siswa</span>
                    <span class="text-right text-sm font-semibold text-gray-700">{{ $studentName }}</span>
                </div>
                <div class="flex justify-between gap-4 border-b border-gray-100 pb-3">
                    <span class="text-sm text-gray-500">Bulan pembayaran</span>
                    <span class="text-right text-sm font-semibold text-gray-700">{{ $period }}</span>
                </div>
                <div class="flex justify-between gap-4 border-b border-gray-100 pb-3">
                    <span class="text-sm text-gray-500">Nominal SPP</span>
                    <span class="text-right text-sm font-semibold text-gray-700">{{ $amount }}</span>
                </div>
                <div class="flex justify-between gap-4 border-b border-gray-100 pb-3">
                    <span class="text-sm text-gray-500">Metode pembayaran</span>
                    <span class="text-right text-sm font-semibold text-gray-700">BCA Virtual Account</span>
                </div>
                <div class="flex justify-between gap-4 rounded-lg bg-[#F3F5FF] px-4 py-3">
                    <span class="text-sm font-bold text-[#4E4E4E]">Total pembayaran</span>
                    <span class="text-right text-base font-bold text-[#45C0F4]">{{ $amount }}</span>
                </div>
            </div>

            <div class="flex justify-end gap-3 border-t border-gray-100 px-6 py-4">
                <button type="button" data-summary-close class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                    Batal
                </button>
                <button type="button" data-payment-continue class="rounded-lg bg-[#45C0F4] px-5 py-2 text-sm font-semibold text-white transition hover:bg-sky-500">
                    Lanjutkan
                </button>
            </div>
        </div>
    </dialog>

    <dialog
        data-payment-confirmation
        aria-labelledby="payment-confirmation-title"
        class="m-auto w-[calc(100%-2rem)] max-w-md rounded-2xl bg-transparent p-0 text-slate-700 shadow-2xl [&::backdrop]:bg-slate-900/50"
    >
        <div class="overflow-hidden rounded-2xl bg-white">
            <div class="bg-[#45C0F4] px-6 py-5 text-white">
                <h3 id="payment-confirmation-title" class="text-xl font-bold">Konfirmasi Pembayaran</h3>
                <p class="mt-1 text-sm text-white/90">Ini adalah pemeriksaan terakhir sebelum melanjutkan.</p>
            </div>

            <div class="space-y-3 px-6 py-5">
                <p class="text-sm leading-6 text-gray-600">
                    Konfirmasi pembayaran SPP {{ $period }} atas nama <strong class="text-gray-800">{{ $studentName }}</strong>
                    dengan metode <strong class="text-gray-800">BCA Virtual Account</strong> sebesar
                    <strong class="text-[#45C0F4]">{{ $amount }}</strong>?
                </p>
                <p class="rounded-lg bg-amber-50 px-4 py-3 text-sm leading-5 text-amber-800">
                    Pembayaran belum diproses otomatis oleh aplikasi. Konfirmasi ini belum mengubah status tagihan.
                </p>
            </div>

            <div class="flex justify-end gap-3 border-t border-gray-100 px-6 py-4">
                <button type="button" data-confirm-back class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                    Kembali
                </button>
                <button type="button" data-payment-confirm class="rounded-lg bg-[#45C0F4] px-5 py-2 text-sm font-semibold text-white transition hover:bg-sky-500">
                    Konfirmasi
                </button>
            </div>
        </div>
    </dialog>

    <p data-payment-feedback role="status" aria-live="polite" hidden class="mt-3 rounded-lg border border-[#45C0F4]/30 bg-white px-4 py-3 text-sm text-gray-600 shadow-sm"></p>
</div>
