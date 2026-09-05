<style>
    * {
        /* border: 0.5px solid red; */
    }
</style>

@extends('layouts.app')

@section ('title', $title)

@section ('content')
    <div class="flex flex-col gap-4">

        <div class="flex flex-row justify-between">
            <div>
                <p class="font-semibold text-[#45C0F4] text-xl">CEK PEMBAYARAN</p>
                <p class="font-medium text-[#999999] text-sm">Verifikasi pembayaran SPP siswa</p>
            </div>
            <div class="flex items-center gap-4">
                <details class="relative group">
                    <!-- Tombol Dropdown -->
                    <summary
                        class="flex items-center justify-between bg-white border-2 border-[#000000]/15 text-[#999999] font-medium pl-4 pr-3 py-2 rounded-lg text-md cursor-pointer list-none select-none">

                        <!-- Atur mr-8 untuk memberi jarak kanan khusus pada TEKS (sebelum panah) -->
                        <span class="whitespace-nowrap mr-8">September 2026</span>

                        <!-- Icon Panah (Jarak dari border kanan diatur dari pr-3 di atas) -->
                        <svg class="w-6 h-6 text-[#999999] group-open:rotate-180 transition-transform shrink-0" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </summary>

                    <!-- Pop-up Menu dengan Batas Maksimal & Scroll (max-h-40) -->
                    <div
                        class="absolute left-0 mt-1 w-full max-h-40 overflow-y-auto bg-white border-2 border-[#000000]/15 rounded-lg shadow-md py-1 z-50 text-md">
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
                <div class="">
                    <a href="#"
                        class="bg-white py-2 px-4 rounded-lg border-2 border-[#000000]/15 text-[#45C0F4] text-md font-semibold flex flex-row gap-2 items-center">
                        <img src="{{ asset('images/icons/download.png') }}" alt="icon-list" class="w-auto h-6">
                        Ekspor
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-5 items-start">

            <div class="lg:col-span-4 flex flex-col gap-4">
                @php
                    $stats = [
                        ['title' => 'Menunggu Verifikasi', 'count' => 8, 'icon' => 'pending.png'],
                        ['title' => 'Terverifikasi', 'count' => 24, 'icon' => 'verified.png'],
                        ['title' => 'Ditolak', 'count' => 1, 'icon' => 'rejected.png'],
                        ['title' => 'Total Bulan Ini', 'count' => 32, 'icon' => 'total.png'],
                    ];
                @endphp

                <div class="flex flex-row justify-between">
                    @foreach ($stats as $stat)
                        <div class="flex flex-row items-center gap-3 bg-white px-9 py-3 rounded-lg border-2 border-black/15">
                            <img src="{{ asset('images/icons/' . $stat['icon']) }}" alt="{{ $stat['title'] }}"
                                class="h-12 w-auto shrink-0">
                            <div class="flex flex-col">
                                <p class="text-sm font-medium text-[#999999]">{{ $stat['title'] }}</p>
                                <p class="text-4xl font-bold text-[#4E4E4E]">{{ $stat['count'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>


                <form action="#" method="GET"
                    class="flex flex-col md:flex-row items-center justify-between gap-3 bg-white rounded-lg border-2 border-[#000000]/15 p-3">

                    <!-- 1. Searchbar (Mengambil sisa ruang paling luas) -->
                    <div class="relative w-full md:w-auto md:flex-1">
                        <input type="text" name="search" placeholder="Cari nama atau NISN..."
                            class="w-full bg-white border border-[#000000]/15 text-[#4E4E4E] font-medium pl-9 pr-4 py-2 rounded-lg text-sm outline-none focus:border-[#45C0F4]">
                        <!-- Icon Search -->
                        <svg class="w-4 h-4 text-[#999999] absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                <svg class="w-4 h-4 text-[#999999] group-open:rotate-180 transition-transform shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </summary>

                            <!-- Pop-up Menu -->
                            <div
                                class="absolute left-0 mt-1 w-full max-h-40 overflow-y-auto bg-white border border-[#000000]/15 rounded-lg shadow-md py-1 z-50 text-sm">
                                <a href="#"
                                    class="block px-3 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">Semua
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
                                <svg class="w-4 h-4 text-[#999999] group-open:rotate-180 transition-transform shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </summary>

                            <!-- Pop-up Menu -->
                            <div
                                class="absolute left-0 mt-1 w-full bg-white border border-[#000000]/15 rounded-lg shadow-md py-1 z-50 text-sm">
                                <a href="#"
                                    class="block px-3 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">Semua
                                    Status</a>
                                <a href="#"
                                    class="block px-3 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">Terverifikasi</a>
                                <a href="#"
                                    class="block px-3 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">Menunggu</a>
                                <a href="#"
                                    class="block px-3 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">Ditolak</a>
                            </div>
                        </details>

                        <!-- 4. Dropdown 3 (misal: Tahun Ajar / Bulan) -->
                        <details class="relative group">
                            <!-- Tombol Summary -->
                            <summary
                                class="flex items-center justify-between gap-3 bg-white border border-[#000000]/15 text-[#999999] font-medium pl-3 pr-2.5 py-2 rounded-lg text-sm cursor-pointer list-none select-none">
                                <span class="whitespace-nowrap">Semua Bulan</span>
                                <svg class="w-4 h-4 text-[#999999] group-open:rotate-180 transition-transform shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
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

                <div class="bg-white rounded-lg border-2 border-black/15 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-200 text-[#555555] text-sm font-bold">
                                    <th class="py-3 px-4 w-12 text-center">No.</th>
                                    <th class="py-3 px-4">Siswa</th>
                                    <th class="py-3 px-4">Kelas</th>
                                    <th class="py-3 px-4">Nominal</th>
                                    <th class="py-3 px-4">Metode</th>
                                    <th class="py-3 px-4">Tanggal</th>
                                    <th class="py-3 px-4 text-center">Status</th>
                                    <th class="py-3 px-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-xs">
                                @php
                                    $payments = [
                                        ['no' => 1, 'nama' => 'Alfredy Rudy', 'nisn' => '00987654321', 'kelas' => 'XII TKJ 1', 'nominal' => 'Rp840.000,00', 'metode' => 'Transfer Bank BCA', 'tanggal' => '01 Sep 2026', 'jam' => '10:15', 'status' => 'Menunggu'],
                                        ['no' => 2, 'nama' => 'Britania Fisichella', 'nisn' => '00987654330', 'kelas' => 'XII TKJ 1', 'nominal' => 'Rp840.000,00', 'metode' => 'E-Wallet OVO', 'tanggal' => '01 Sep 2026', 'jam' => '10:15', 'status' => 'Terverifikasi'],
                                        ['no' => 3, 'nama' => 'Aricks Wijaya', 'nisn' => '00987654325', 'kelas' => 'XII TKJ 1', 'nominal' => 'Rp840.000,00', 'metode' => 'Tunai', 'tanggal' => '01 Sep 2026', 'jam' => '10:15', 'status' => 'Terverifikasi'],
                                        ['no' => 4, 'nama' => 'Arthur Sebastian Felix', 'nisn' => '00987654326', 'kelas' => 'XII TKJ 1', 'nominal' => 'Rp840.000,00', 'metode' => 'Transfer Bank BRI', 'tanggal' => '01 Sep 2026', 'jam' => '10:15', 'status' => 'Menunggu'],
                                        ['no' => 5, 'nama' => 'Charles', 'nisn' => '00987654331', 'kelas' => 'XII TKJ 1', 'nominal' => 'Rp840.000,00', 'metode' => 'E-Wallet DANA', 'tanggal' => '01 Sep 2026', 'jam' => '10:15', 'status' => 'Terverifikasi']
                                    ];
                                @endphp

                                @foreach ($payments as $item)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="py-2.5 px-4 text-center font-medium text-[#4E4E4E]">{{ $item['no'] }}</td>
                                        <td class="py-2 px-4">
                                            <div class="font-semibold text-sm leading-tight text-[#4E4E4E]">{{ $item['nama'] }}
                                            </div>
                                            <div class="text-[10px] text-gray-400 font-medium tracking-wide">{{ $item['nisn'] }}
                                            </div>
                                        </td>
                                        <td class="py-2.5 px-4 font-medium text-[#4E4E4E] whitespace-nowrap">
                                            {{ $item['kelas'] }}
                                        </td>
                                        <td class="py-2.5 px-4 font-medium text-sm text-[#4E4E4E] whitespace-nowrap">
                                            {{ $item['nominal'] }}
                                        </td>
                                        <td class="py-2.5 px-4 font-medium text-[#4E4E4E] whitespace-nowrap">
                                            {{ $item['metode'] }}
                                        </td>
                                        <td class="py-2.5 px-4 whitespace-nowrap">
                                            <div class="font-medium text-[#4E4E4E]">{{ $item['tanggal'] }}</div>
                                            <div class="text-[10px] text-gray-400 font-medium">{{ $item['jam'] }}</div>
                                        </td>
                                        <td class="py-2.5 px-2 text-center whitespace-nowrap">
                                            @if ($item['status'] === 'Terverifikasi')
                                                <span
                                                    class="inline-block py-2 text-xs font-semibold text-[#3CB131] bg-[#E8FFDC] border border-[#3CB131] rounded-lg w-22">
                                                    Terverifikasi
                                                </span>
                                            @elseif ($item['status'] === 'Menunggu')
                                                <span
                                                    class="inline-block py-2 text-xs font-semibold text-[#D4B237] bg-[#FFF7DC] border border-[#D4B237] rounded-lg w-22">
                                                    Menunggu
                                                </span>
                                            @else
                                                <span
                                                    class="inline-block py-2 text-xs font-semibold text-[#D43737] bg-[#FDBDBD] border border-[#D43737] rounded-lg w-22">
                                                    Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-2.5 px-4 text-center whitespace-nowrap">
                                            @if ($item['status'] === 'Menunggu' || $item['status'] === 'Ditolak')
                                                <a href="#"
                                                    class="inline-block py-2 text-xs font-medium text-white bg-[#45C0F4] hover:bg-sky-500 rounded-lg shadow-sm transition-colors w-19">
                                                    Verifikasi
                                                </a>
                                            @else
                                                <a href="#"
                                                    class="inline-block py-2 text-xs font-medium text-[#45C0F4] bg-white border border-[#45C0F4] hover:bg-sky-50 rounded-lg transition-colors w-19">
                                                    Detail
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex items-center justify-end">
                    <div class="flex items-center gap-1.5 text-xs font-semibold">
                        <!-- Prev Button -->
                        <a href="#"
                            class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-400 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>

                        <!-- Page 1 (Active) -->
                        <a href="#"
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#45C0F4] text-white shadow-sm">
                            1
                        </a>

                        <!-- Page 2 -->
                        <a href="#"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-[#45C0F4] hover:bg-sky-50 transition-colors">
                            2
                        </a>

                        <!-- Page 3 -->
                        <a href="#"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-[#45C0F4] hover:bg-sky-50 transition-colors">
                            3
                        </a>

                        <!-- Page 4 -->
                        <a href="#"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-[#45C0F4] hover:bg-sky-50 transition-colors">
                            4
                        </a>

                        <!-- Page 5 -->
                        <a href="#"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-[#45C0F4] hover:bg-sky-50 transition-colors">
                            5
                        </a>

                        <!-- Page 6 -->
                        <a href="#"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-[#45C0F4] hover:bg-sky-50 transition-colors">
                            6
                        </a>

                        <!-- Page 7 -->
                        <a href="#"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-[#45C0F4] hover:bg-sky-50 transition-colors">
                            7
                        </a>

                        <!-- Next Button -->
                        <a href="#"
                            class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-400 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- PART 3: Detail Pembayaran --}}
            <div
                class="lg:col-span-1 bg-white p-3 rounded-lg border-2 border-[#000000]/15 flex flex-col gap-2.5 text-[10px]">

                <!-- Title & Badge Status -->
                <div class="flex flex-col gap-1">
                    <h3 class="text-sm font-bold text-[#45C0F4] pt-1">Detail Pembayaran</h3>
                    <div>
                        <span
                            class="inline-block px-2 py-0.5 text-[10px] font-medium text-[#D4B237] bg-[#FFF7DC] border border-[#D4B237] rounded-md">
                            Menunggu Verifikasi
                        </span>
                    </div>
                </div>

                <!-- Informasi Transaksi -->
                <div class="flex flex-col gap-1 py-0.5 text-[#4E4E4E]">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 font-medium">Nama Siswa</span>
                        <span class="font-semibold text-right">Alfredy Rudy</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 font-medium">NISN</span>
                        <span class="font-semibold text-right">00987654321</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 font-medium">Kelas</span>
                        <span class="font-semibold text-right">XII TKJ 1</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 font-medium">Bulan</span>
                        <span class="font-semibold text-right">September 2026</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 font-medium">Nominal</span>
                        <span class="font-semibold text-right">Rp840.000,00</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 font-medium">Tanggal Bayar</span>
                        <span class="font-semibold text-right">01 September 2026, 10:15</span>
                    </div>
                </div>

                <!-- Bukti Pembayaran -->
                <div class="flex flex-col gap-1">
                    <span class="font-semibold text-[#45C0F4] text-[10px]">Bukti Pembayaran</span>
                    <div class="relative group rounded-md overflow-hidden border border-gray-200">
                        <img src="{{ asset('images/receipt.png') }}" alt="Bukti Pembayaran"
                            class="w-full h-24 object-cover">
                    </div>
                </div>

                <!-- Form / Input Catatan -->
                <form action="#" method="POST" class="flex flex-col gap-2">
                    @csrf

                    <div class="flex flex-col gap-0.5">
                        <label class="text-gray-400 font-medium">Catatan <span
                                class="text-gray-300">(opsional)</span></label>
                        <textarea rows="2" placeholder="Tulis catatan atau keterangan..."
                            class="w-full p-1.5 bg-white border border-gray-300 rounded-md outline-none focus:border-[#45C0F4] text-[10px] resize-none placeholder:text-gray-300"></textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="grid grid-cols-2 gap-1.5 pt-0.5">
                        <a href="#"
                            class="w-full py-1.5 px-1 bg-[#61BD53] hover:bg-green-600 text-white font-medium rounded-md text-[10px] transition-colors text-center inline-block">
                            Terima Pembayaran
                        </a>
                        <a href="#"
                            class="w-full py-1.5 px-1 bg-[#D9534F] hover:bg-red-600 text-white font-medium rounded-md text-[10px] transition-colors text-center inline-block">
                            Tolak Pembayaran
                        </a>
                    </div>

                    <div class="flex flex-col gap-0.5 pt-0.5">
                        <label class="text-gray-500 font-semibold">Alasan penolakan <label
                                class="text-[#FF0707]">*</label></label>
                        <textarea rows="2" placeholder="Tulis keterangan..."
                            class="w-full p-1.5 bg-white border border-gray-300 rounded-md outline-none focus:border-[#45C0F4] text-[10px] resize-none placeholder:text-gray-300"></textarea>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection