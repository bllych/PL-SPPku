@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="flex flex-col gap-5">

        {{-- PROFILE + STATUS PEMBAYARAN --}}
        <x-student.profile-payment-status
            :student="$student"
            :semester-payment-statuses="$semesterPaymentStatuses"
            :active-semester="$activeSemester"
        />

        {{-- BAGIAN BAWAH --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 items-stretch">

            {{-- DETAIL INFORMASI --}}
            <div class="w-full">

                <h2 class="text-[#45C0F4] text-lg font-bold mb-3">
                    DETAIL INFORMASI
                </h2>

                <div class="bg-white rounded-xl shadow-md p-6 sm:p-7 min-h-[400px] flex flex-col justify-between gap-4">

                    <div class="flex justify-between gap-4">
                        <span class="text-[#4E4E4E] font-semibold">Nama</span>
                        <span class="text-[#999999] font-medium text-right">
                            {{ $student->user->name }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-[#4E4E4E] font-semibold">NISN/Nomor Induk</span>
                        <span class="text-[#999999] font-medium text-right">
                            {{ $student->nisn }}/{{ $student->nis }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-[#4E4E4E] font-semibold">Tahun Ajaran</span>
                        <span class="text-[#999999] font-medium text-right">
                            {{ $student->school_year }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-[#4E4E4E] font-semibold">Kelas</span>
                        <span class="text-[#999999] font-medium text-right">
                            {{ $student->class }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-[#4E4E4E] font-semibold">Jurusan</span>
                        <span class="text-[#999999] font-medium text-right">
                            {{ $student->major }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-[#4E4E4E] font-semibold">Sudah Dibayar ({{ ucfirst($activeSemester) }})</span>
                        <span class="text-[#999999] font-medium text-right">
                            {{ $semesterPaidCount }} Bulan
                        </span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-[#4E4E4E] font-semibold">Sisa Pembayaran ({{ ucfirst($activeSemester) }})</span>
                        <span class="text-[#999999] font-medium text-right">
                            {{ $semesterOutstandingCount }} Bulan
                        </span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-[#4E4E4E] font-semibold">
                            Butuh Bantuan?
                        </span>

                        <button
                            type="button"
                            data-whatsapp-open
                            class="cursor-pointer text-[#FFB83E] underline font-medium text-right"
                        >
                            Hubungi Tata Usaha →
                        </button>
                    </div>

                </div>

            </div>

            {{-- PEMBAYARAN SELANJUTNYA --}}
            <x-student.next-payment
                :student-id="$student->id"
                :bill-id="$activeBill?->id"
                :period="$currentPeriod"
                :amount="$currentBillAmount"
                :due-date="$currentBillDueDate"
                :status="$currentBillStatus"
                :date="$currentDateLabel"
                :student-name="$student->user->name"
            />

        </div>

        <dialog
            data-whatsapp-confirmation
            aria-labelledby="whatsapp-confirmation-title"
            class="m-auto w-[calc(100%-2rem)] max-w-md rounded-2xl bg-transparent p-0 text-slate-700 shadow-2xl [&::backdrop]:bg-slate-900/50"
        >
            <div class="overflow-hidden rounded-2xl bg-white">
                <div class="bg-[#45C0F4] px-6 py-5 text-white">
                    <h3 id="whatsapp-confirmation-title" class="text-xl font-bold">Hubungi Tata Usaha</h3>
                    <p class="mt-1 text-sm text-white/90">Kamu akan diarahkan ke WhatsApp.</p>
                </div>

                <div class="space-y-3 px-6 py-5">
                    <p class="text-sm leading-6 text-gray-600">
                        Lanjutkan untuk menghubungi Tata Usaha melalui WhatsApp di nomor
                        <strong class="text-gray-800">+62 858-1956-1605</strong>?
                    </p>
                </div>

                <div class="flex justify-end gap-3 border-t border-gray-100 px-6 py-4">
                    <button
                        type="button"
                        data-whatsapp-cancel
                        class="cursor-pointer rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-600 transition hover:bg-gray-50"
                    >
                        Batal
                    </button>
                    <a
                        href="https://wa.me/6285819561605"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="rounded-lg bg-[#45C0F4] px-5 py-2 text-sm font-semibold text-white transition hover:bg-sky-500"
                    >
                        Lanjut ke WhatsApp
                    </a>
                </div>
            </div>
        </dialog>

    </div>

@endsection