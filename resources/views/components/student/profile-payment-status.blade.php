@props(['student', 'semesterPaymentStatuses', 'activeSemester' => 'ganjil'])

@php
    $nextSemester = $activeSemester === 'genap' ? 'ganjil' : 'genap';
    $semesterTitle = $activeSemester === 'genap'
        ? 'STATUS PEMBAYARAN SEMESTER GENAP'
        : 'STATUS PEMBAYARAN SEMESTER GANJIL';
@endphp

<div class="bg-white rounded-xl shadow-md p-3 flex flex-col gap-4 md:flex-row md:items-center">

    {{-- Profile --}}
    <div class="flex items-center w-full md:w-1/2 gap-4 py-2 md:border-r md:border-gray-300">

        <img
            src="{{ asset('images/icons/profile.png') }}"
            class="w-20 h-20 md:w-24 md:h-24 rounded-full shrink-0"
            alt="Profile"
        >

        <div class="min-w-0">
            <p class="text-[#45C0F4] font-bold text-lg truncate">
                {{ $student->user->name }}
            </p>

            <p class="text-[#4E4E4E] font-semibold">
                {{ $student->class }}
            </p>

            <p class="text-[#4E4E4E] font-semibold">
                SMK Kristen Immanuel
            </p>
        </div>

    </div>

    {{-- Status Pembayaran --}}
    <div class="w-full md:w-1/2 md:pl-8">

        <div class="mb-3 flex items-center justify-between gap-2">
            <h2 class="text-[#45C0F4] text-base md:text-lg font-bold flex items-center gap-2">
                <span>{{ $semesterTitle }}</span>

                <a
                    href="{{ route('students.index', ['id' => $student->id, 'semester' => $nextSemester]) }}"
                    title="Ganti ke Semester {{ ucfirst($nextSemester) }}"
                    aria-label="Ganti ke Semester {{ ucfirst($nextSemester) }}"
                    class="inline-flex items-center justify-center rounded-full p-1 transition hover:bg-amber-50 hover:scale-110"
                >
                    <img
                        src="{{ asset('images/icons/switch.png') }}"
                        alt="Ganti Semester"
                        class="w-5 h-5 transition-transform duration-200 {{ $activeSemester === 'genap' ? 'rotate-180' : '' }}"
                    >
                </a>
            </h2>
        </div>

        <div class="flex flex-wrap gap-3">
            @foreach ($semesterPaymentStatuses as $semesterPaymentStatus)
                <div
                    title="{{ $semesterPaymentStatus['period'] }}: {{ $semesterPaymentStatus['status'] }}"
                    aria-label="{{ $semesterPaymentStatus['period'] }}: {{ $semesterPaymentStatus['status'] }}"
                    class="flex h-11 w-11 items-center justify-center rounded-full text-sm transition {{ $semesterPaymentStatus['class'] }}"
                >
                    {{ $semesterPaymentStatus['month'] }}
                </div>
            @endforeach
        </div>

        <div class="mt-3 flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-500" aria-label="Keterangan status tagihan">
            <span class="flex items-center gap-1"><span class="h-2.5 w-2.5 rounded-full bg-[#45C0F4]"></span>Lunas</span>
            <span class="flex items-center gap-1"><span class="h-2.5 w-2.5 rounded-full bg-[#FFB83E]"></span>Bulan berjalan</span>
            <span class="flex items-center gap-1"><span class="h-2.5 w-2.5 rounded-full bg-[#999999]"></span>Belum lunas</span>
            <span class="flex items-center gap-1"><span class="h-2.5 w-2.5 rounded-full bg-[#F43F5E]"></span>Terlambat</span>
            <span class="flex items-center gap-1"><span class="h-2.5 w-2.5 rounded-full border border-dashed border-gray-400 bg-white"></span>Belum ada tagihan</span>
        </div>

    </div>

</div>