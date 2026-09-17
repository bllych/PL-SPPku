<div class="lg:col-span-1 bg-white p-3 rounded-lg border-2 border-[#000000]/15 flex flex-col gap-2.5 text-[10px]">

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
            <img src="{{ asset('images/receipt.png') }}" alt="Bukti Pembayaran" class="w-full h-24 object-cover">
        </div>
    </div>

    <!-- Form / Input Catatan -->
    <form action="#" method="POST" class="flex flex-col gap-2">
        @csrf

        <div class="flex flex-col gap-0.5">
            <label class="text-gray-400 font-medium">Catatan <span class="text-gray-300">(opsional)</span></label>
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
            <label class="text-gray-500 font-semibold">Alasan penolakan <label class="text-[#FF0707]">*</label></label>
            <textarea rows="2" placeholder="Tulis keterangan..."
                class="w-full p-1.5 bg-white border border-gray-300 rounded-md outline-none focus:border-[#45C0F4] text-[10px] resize-none placeholder:text-gray-300"></textarea>
        </div>
    </form>

</div>