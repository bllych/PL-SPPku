
<div class="w-full">

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
                <p class="text-base font-semibold text-[#4E4E4E]">
                    BCA Virtual Account
                </p>

                <p class="text-base text-[#4E4E4E]">
                    No. 123456789098765
                </p>
            </div>

        </div>

        {{-- DETAIL TAGIHAN --}}
        <div class="flex flex-col gap-6 mt-5">

            <div class="flex justify-between">
                <span class="text-[#4E4E4E] text-base font-semibold">
                    Periode
                </span>

                <span class="text-[#999999] text-base font-medium">
                    September 2026
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-[#4E4E4E] text-base font-semibold">
                    Total Tagihan
                </span>

                <span class="text-[#999999] text-base font-medium">
                    Rp840.000,00
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-[#4E4E4E] text-base font-semibold">
                    Jatuh Tempo
                </span>

                <span class="text-[#999999] text-base font-medium">
                    14 September 2026
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-[#4E4E4E] text-base font-semibold">
                    Status Pembayaran
                </span>

                <span class="text-[#F43F5E] text-base font-medium">
                    Belum Dibayar
                </span>
            </div>

        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end mt-auto">

            <a
                href="#"
                class="bg-[#45C0F4] text-white text-base font-semibold px-5 py-2.5 rounded-lg shadow-md hover:bg-sky-500"
            >
                Lakukan Pembayaran
            </a>

        </div>

    </div>

</div>
