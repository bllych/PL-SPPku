<div class="
                    bg-white
                    rounded-[10px]
                    shadow-sm
                    h-[110px]
                    overflow-hidden
                ">

    <div class="h-full px-5 py-4">

        {{-- =========================================
        JUDUL + BULAN
        ========================================== --}}
        <div class="flex items-center gap-5">

            <h2 class="
                                text-[#45C0F4]
                                font-bold
                                text-[18px]
                                whitespace-nowrap
                            ">
                STATISTIK PEMBAYARAN
            </h2>


            <select class="
                                border
                                border-gray-300
                                rounded-[6px]
                                px-3
                                py-1
                                text-[18px]
                                text-[#FFC857]
                                bg-white
                                focus:outline-none
                            ">

                <option>Agustus</option>
                <option>September</option>
                <option>Oktober</option>
                <option>November</option>
                <option>Desember</option>

            </select>

        </div>


        {{-- =========================================
        DATA STATISTIK
        ========================================== --}}
        <div class="flex items-center gap-8 mt-4">


            {{-- TOTAL SISWA --}}
            <div class="
                                flex
                                items-center
                                gap-2
                                whitespace-nowrap
                            ">

                <span class="
                                    text-[#45C0F4]
                                    font-semibold
                                    text-[18px]
                                ">
                    Total Siswa
                </span>

                <span class="
                                    text-[#45C0F4]
                                    font-bold
                                    text-[20px]
                                ">
                    573
                </span>

            </div>


            {{-- LUNAS --}}
            <div class="
                                flex
                                items-center
                                gap-2
                                whitespace-nowrap
                            ">

                <span class="
                                    text-green-500
                                    font-semibold
                                    text-[18px]
                                ">
                    Lunas
                </span>

                <span class="
                                    text-green-500
                                    font-bold
                                    text-[20px]
                                ">
                    359
                </span>

            </div>


            {{-- BELUM LUNAS --}}
            <div class="
                                flex
                                items-center
                                gap-2
                                whitespace-nowrap
                            ">

                <span class="
                                    text-red-400
                                    font-semibold
                                    text-[18px]
                                ">
                    Belum Lunas
                </span>

                <span class="
                                    text-red-400
                                    font-bold
                                    text-[20px]
                                ">
                    214
                </span>

            </div>

        </div>

    </div>

</div>