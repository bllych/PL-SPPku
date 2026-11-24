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
        <x-student.profile-payment-status
            :student="$student"
            :semester-payment-statuses="$semesterPaymentStatuses"
        />


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
                            {{ $student->user->name }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">NISN/Nomor Induk</span>
                        <span class="text-[#999999] font-medium">
                            {{ $student->nisn }}/{{ $student->nis }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Tahun Ajaran</span>
                        <span class="text-[#999999] font-medium">
                            {{ $student->school_year }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Kelas</span>
                        <span class="text-[#999999] font-medium">
                            {{ $student->class }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Jurusan</span>
                        <span class="text-[#999999] font-medium">
                            {{ $student->major }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Sudah Dibayar</span>
                        <span class="text-[#999999] font-medium">
                            {{ $semesterPaidCount }} Bulan
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-[#4E4E4E] font-semibold">Sisa Pembayaran</span>
                        <span class="text-[#999999] font-medium">
                            {{ $semesterOutstandingCount }} Bulan
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
            <x-student.next-payment
                :period="$currentPeriod"
                :amount="$currentBillAmount"
                :due-date="$currentBillDueDate"
                :date="$currentDateLabel"
                :student-name="$student->user->name"
            />

        </div>

    </div>

@endsection
