<form action="#" method="GET"
    class="flex flex-col md:flex-row items-center justify-between gap-3 bg-white rounded-lg border-2 border-[#000000]/15 p-3">

    <!-- 1. Searchbar (Mengambil sisa ruang paling luas) -->
    <div class="relative w-full md:w-auto md:flex-1">
        <input type="text" name="search" placeholder="Cari nama atau NISN..."
            class="w-full bg-white border border-[#000000]/15 text-[#4E4E4E] font-medium pl-9 pr-4 py-2 rounded-lg text-sm outline-none focus:border-[#45C0F4]">
        <!-- Icon Search -->
        <svg class="w-4 h-4 text-[#999999] absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>

    <!-- Group Dropdown & Button (Tersusun rapi di sebelah kanan) -->
    <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">

        <!-- 2. Dropdown 1 (misal: Kelas) -->
        <details class="relative w-36 group">
            <!-- Tombol Pilihan -->
            <summary
                class="flex items-center justify-between bg-white border border-[#000000]/15 text-[#999999] font-medium pl-3 pr-2.5 py-2 rounded-lg text-sm cursor-pointer list-none select-none">
                <span class="truncate">Semua Kelas</span>
                <svg class="w-4 h-4 text-[#999999] group-open:rotate-180 transition-transform shrink-0" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </summary>

            <!-- Pop-up Menu -->
            <div
                class="absolute left-0 mt-1 w-full max-h-40 overflow-y-auto bg-white border border-[#000000]/15 rounded-lg shadow-md py-1 z-50 text-sm">
                <a href="#" class="block px-3 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">Semua
                    Kelas</a>
                @foreach([
                        '10 TKJ 1' => 'X TKJ 1',
                        '10 TKJ 2' => 'X TKJ 2',
                        '10 AKL' => 'X AKL',
                        '10 BiD 1' => 'X BiD 1',
                        '10 BiD 2' => 'X BiD 2',
                        '11 TKJ 1' => 'XI TKJ 1',
                        '11 TKJ 2' => 'XI TKJ 2',
                        '11 TKJ 3' => 'XI TKJ 3',
                        '11 AKL' => 'XI AKL',
                        '11 BiD 1' => 'XI BiD 1',
                        '11 BiD 2' => 'XI BiD 2',
                        '12 TKJ 2' => 'XII TKJ 2',
                        '12 TKJ 3' => 'XII TKJ 3',
                        '12 AKL' => 'XII AKL',
                        '12 BiD' => 'XII BiD'
                    ] as $val => $label)
                    <a href="#"
                        class="block px-3 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">{{ $label }}</a>
                @endforeach
            </div>
        </details>

        <!-- 3. Dropdown 2 (misal: Status Pembayaran) -->
        <details class="relative group">
            <!-- Tombol Summary -->
            <summary
                class="flex items-center justify-between gap-3 bg-white border border-[#000000]/15 text-[#999999] font-medium pl-3 pr-2.5 py-2 rounded-lg text-sm cursor-pointer list-none select-none">
                <span class="whitespace-nowrap">Semua Status</span>
                <svg class="w-4 h-4 text-[#999999] group-open:rotate-180 transition-transform shrink-0" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </summary>

            <!-- Pop-up Menu -->
            <div
                class="absolute left-0 mt-1 w-full bg-white border border-[#000000]/15 rounded-lg shadow-md py-1 z-50 text-sm">
                <a href="#" class="block px-3 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">Semua
                    Status</a>
                <a href="#"
                    class="block px-3 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">Terverifikasi</a>
                <a href="#" class="block px-3 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">Menunggu</a>
                <a href="#" class="block px-3 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">Ditolak</a>
            </div>
        </details>

        <!-- 4. Dropdown 3 (misal: Tahun Ajar / Bulan) -->
        <details class="relative group">
            <!-- Tombol Summary -->
            <summary
                class="flex items-center justify-between gap-3 bg-white border border-[#000000]/15 text-[#999999] font-medium pl-3 pr-2.5 py-2 rounded-lg text-sm cursor-pointer list-none select-none">
                <span class="whitespace-nowrap">Semua Bulan</span>
                <svg class="w-4 h-4 text-[#999999] group-open:rotate-180 transition-transform shrink-0" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </summary>

            <!-- Pop-up Menu -->
            <div
                class="absolute left-0 mt-1 w-full max-h-40 overflow-y-auto bg-white border-2 border-[#000000]/15 rounded-lg shadow-md py-1 z-50 text-sm">
                @foreach([
                        'sep-2026' => 'September 2026',
                        'aug-2026' => 'Agustus 2026',
                        'jul-2026' => 'Juli 2026',
                        'jun-2026' => 'Juni 2026',
                        'may-2026' => 'Mei 2026',
                        'apr-2026' => 'April 2026',
                        'mar-2026' => 'Maret 2026',
                        'feb-2026' => 'Februari 2026',
                        'jan-2026' => 'Januari 2026'
                    ] as $val => $label)
                    <a href="#"
                        class="block px-4 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">{{ $label }}</a>
                @endforeach
            </div>
        </details>

        <!-- 5. Submit Button -->
        <a href="#"
            class="bg-[#45C0F4] hover:bg-[#3ab0e0] text-white font-medium px-4 py-2 rounded-lg text-sm transition-colors inline-block text-center">
            Cari
        </a>
    </div>
</form>