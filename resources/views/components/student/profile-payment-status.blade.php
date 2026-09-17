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
                MAXENDRA ALEXIUS KAENDRA
            </p>

            <p class="text-[#4E4E4E] font-semibold">
                XII TKJ 1
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

        <div class="flex gap-5">

            <div class="w-11 h-11 rounded-full bg-[#45C0F4] text-white text-sm flex items-center justify-center">
                Jul
            </div>

            <div class="w-11 h-11 rounded-full bg-[#45C0F4] text-white text-sm flex items-center justify-center">
                Agu
            </div>

            <div class="w-11 h-11 rounded-full bg-[#999999] text-white text-sm flex items-center justify-center">
                Sep
            </div>

            <div class="w-11 h-11 rounded-full bg-[#999999] text-white text-sm flex items-center justify-center">
                Okt
            </div>

            <div class="w-11 h-11 rounded-full bg-[#999999] text-white text-sm flex items-center justify-center">
                Nov
            </div>

            <div class="w-11 h-11 rounded-full bg-[#999999] text-white text-sm flex items-center justify-center">
                Des
            </div>

        </div>

    </div>

</div>