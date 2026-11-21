@props(['student', 'semesterPaymentStatuses'])

<div class="bg-white rounded-xl shadow-md p-3 flex items-center">

    {{-- Profile --}}
    <div class="flex items-center w-1/2 gap-4 py-2 border-r border-gray-300">

        <img
            src="{{ asset('images/icons/profile.png') }}"
            class="w-24 h-24 rounded-full"
            alt="Profile"
        >

        <div>
            <p class="text-[#45C0F4] font-bold text-lg">
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
    <div class="w-1/2 pl-8">

        <h2 class="text-[#45C0F4] text-lg font-bold mb-3 flex items-center">
            STATUS PEMBAYARAN SEMESTER GANJIL

            <img
                src="{{ asset('images/icons/switch.png') }}"
                alt="switch"
                class="w-5 h-5 ml-2"
            >
        </h2>

        <div class="flex flex-wrap gap-3">
            @foreach ($semesterPaymentStatuses as $semesterPaymentStatus)
                <div
                    title="{{ $semesterPaymentStatus['period'] }}: {{ $semesterPaymentStatus['status'] }}"
                    aria-label="{{ $semesterPaymentStatus['period'] }}: {{ $semesterPaymentStatus['status'] }}"
                    class="flex h-11 w-11 items-center justify-center rounded-full text-sm {{ $semesterPaymentStatus['class'] }}"
                >
                    {{ $semesterPaymentStatus['month'] }}
                </div>
            @endforeach
        </div>

        <div class="mt-3 flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-500" aria-label="Keterangan status tagihan">
            <span class="flex items-center gap-1"><span class="h-2.5 w-2.5 rounded-full bg-[#45C0F4]"></span>Lunas</span>
            <span class="flex items-center gap-1"><span class="h-2.5 w-2.5 rounded-full bg-[#999999]"></span>Belum lunas</span>
            <span class="flex items-center gap-1"><span class="h-2.5 w-2.5 rounded-full bg-[#F43F5E]"></span>Terlambat</span>
            <span class="flex items-center gap-1"><span class="h-2.5 w-2.5 rounded-full border border-dashed border-gray-400 bg-white"></span>Belum ada tagihan</span>
        </div>

    </div>

</div>
