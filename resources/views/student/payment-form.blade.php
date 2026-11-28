@extends('layouts.app')

@section('title', $title)

@section('content')

    @php
        $initialSelectedIds = collect(old('bill_ids', $selectedBillId ? [(string) $selectedBillId] : []))
            ->map(fn($v) => (string) $v)
            ->all();
    @endphp

    <div class="mx-auto w-full max-w-[1040px] py-2">

        {{-- JUDUL HALAMAN --}}
        <div class="mb-4 flex flex-wrap items-baseline gap-2.5">
            <h1 class="text-lg sm:text-xl font-bold tracking-wide text-[#38B8ED]">
                FORM PEMBAYARAN SISWA
            </h1>
            <span class="text-base sm:text-lg font-bold text-[#4E4E4E]">
                {{ $student->user->name }}
            </span>
        </div>

        {{-- ALERT ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="mb-4 rounded-xl border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700 shadow-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- KARTU FORM UTAMA --}}
        <form
            id="studentPaymentForm"
            method="POST"
            action="{{ route('students.payments.store', ['id' => $student->id]) }}"
            enctype="multipart/form-data"
            novalidate
            class="rounded-xl bg-white p-6 sm:p-8 shadow-md"
        >
            @csrf

            {{-- PERIODE PEMBAYARAN (MULTI-SELECT DROPDOWN CHECKBOX) --}}
            <div class="mb-4">
                <div class="mb-2 flex items-center justify-between gap-2">
                    <label class="block text-sm sm:text-base font-bold text-[#4E4E4E]">
                        Periode Pembayaran
                    </label>
                    <span class="text-xs text-gray-400">Bisa pilih lebih dari 1 bulan</span>
                </div>

                <div id="periodDropdownWrapper" class="relative">
                    <button
                        type="button"
                        id="periodDropdownToggle"
                        aria-expanded="false"
                        class="flex min-h-[44px] w-full cursor-pointer items-center justify-between gap-3 rounded-md border border-gray-300 bg-white px-4 py-2 text-left text-sm text-[#4E4E4E] outline-none transition hover:border-[#38B8ED] focus:border-[#38B8ED]"
                    >
                        <span id="periodDropdownLabel" class="truncate text-gray-400">
                            pilih bulan pembayaran
                        </span>

                        <svg
                            id="periodDropdownArrow"
                            class="h-4 w-4 shrink-0 text-gray-400 transition-transform duration-200"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- MENU CHECKBOX BULAN --}}
                    <div
                        id="periodDropdownMenu"
                        class="absolute left-0 z-30 mt-1.5 hidden max-h-60 w-full overflow-y-auto rounded-lg border border-gray-200 bg-white py-1.5 shadow-lg"
                    >
                        @forelse ($unpaidBills as $billOption)
                            <label class="flex cursor-pointer items-center justify-between gap-3 px-4 py-2.5 text-sm text-[#4E4E4E] transition hover:bg-sky-50">
                                <span class="flex items-center gap-3">
                                    <input
                                        type="checkbox"
                                        name="bill_ids[]"
                                        value="{{ $billOption['id'] }}"
                                        data-label="{{ $billOption['short_label'] }}"
                                        data-amount="{{ $billOption['amount_raw'] }}"
                                        @checked(in_array((string) $billOption['id'], $initialSelectedIds, true))
                                        class="bill-checkbox h-4 w-4 rounded accent-[#38B8ED]"
                                    >
                                    <span class="font-medium">{{ $billOption['label'] }}</span>
                                </span>

                                <span class="text-xs font-semibold text-gray-500">
                                    {{ $billOption['amount_formatted'] }}
                                </span>
                            </label>
                        @empty
                            <p class="px-4 py-3 text-sm text-gray-400">
                                Tidak ada tagihan yang belum dibayar.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- BANNER KUNING TOTAL TAGIHAN --}}
            <div class="mb-5 rounded-md bg-[#FBBF3B] px-4 py-2.5 text-sm font-bold text-white shadow-xs">
                Total Tagihan: <span id="totalTagihanText">periode pembayaran belum dipilih</span>
            </div>

            {{-- PILIH METODE PEMBAYARAN --}}
            <div class="mb-5">
                <p class="mb-3 text-sm sm:text-base font-bold text-[#4E4E4E]">
                    Pilih Metode Pembayaran:
                </p>

                <div class="space-y-3 text-sm sm:text-base text-[#4E4E4E]">
                    <label class="flex cursor-pointer items-center gap-3">
                        <input
                            type="radio"
                            name="payment_method"
                            value="Tunai / Cash (Bayar langsung ke Tata Usaha)"
                            data-method-type="cash"
                            @checked(old('payment_method') === 'Tunai / Cash (Bayar langsung ke Tata Usaha)')
                            class="h-4 w-4 accent-[#38B8ED]"
                        >
                        <span>Tunai / Cash (Bayar langsung ke Tata Usaha)</span>
                    </label>

                    <label class="flex cursor-pointer items-center gap-3">
                        <input
                            type="radio"
                            name="payment_method"
                            value="Transfer Bank / Virtual Account (BCA, Mandiri, dll)"
                            data-method-type="transfer"
                            @checked(old('payment_method') === 'Transfer Bank / Virtual Account (BCA, Mandiri, dll)')
                            class="h-4 w-4 accent-[#38B8ED]"
                        >
                        <span>Transfer Bank / Virtual Account (BCA, Mandiri, dll)</span>
                    </label>

                    <label class="flex cursor-pointer items-center gap-3">
                        <input
                            type="radio"
                            name="payment_method"
                            value="QRIS (Scan QR pakai GoPay, OVO, M-Banking)"
                            data-method-type="qris"
                            @checked(old('payment_method') === 'QRIS (Scan QR pakai GoPay, OVO, M-Banking)')
                            class="h-4 w-4 accent-[#38B8ED]"
                        >
                        <span>QRIS (Scan QR pakai GoPay, OVO, M-Banking)</span>
                    </label>
                </div>

                {{-- INFO REKENING TUJUAN (MUNCUL SAAT PILIH TRANSFER BANK) --}}
                <div
                    id="transferAccountBox"
                    class="mt-4 hidden rounded-lg border border-[#38B8ED]/30 bg-[#F3F8FF] p-4"
                >
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div class="flex items-center gap-3.5">
                            <img
                                src="{{ asset('images/logo/BCA.png') }}"
                                alt="BCA"
                                class="h-8 w-auto object-contain"
                            >
                            <div>
                                <p class="text-xs font-semibold text-gray-500">
                                    Rekening Tujuan Transfer (BCA Virtual Account)
                                </p>
                                <p id="vaNumberText" class="text-base font-bold tracking-wide text-[#4E4E4E]">
                                    123456789098765
                                </p>
                                <p class="text-xs font-medium text-gray-500">
                                    a.n. SMK Kristen Immanuel
                                </p>
                            </div>
                        </div>

                        <button
                            type="button"
                            id="copyVaBtn"
                            class="cursor-pointer rounded-md border border-[#38B8ED] bg-white px-3.5 py-1.5 text-xs font-semibold text-[#38B8ED] transition hover:bg-[#38B8ED] hover:text-white"
                        >
                            Salin No. VA
                        </button>
                    </div>
                </div>

                {{-- TOMBOL TAMPILKAN QRIS (MUNCUL SAAT PILIH QRIS) --}}
                <div
                    id="qrisActionBox"
                    class="mt-4 hidden rounded-lg border border-[#38B8ED]/30 bg-[#F3F8FF] p-4"
                >
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <p class="text-sm font-bold text-[#4E4E4E]">
                                Pembayaran via QRIS SMK Kristen Immanuel
                            </p>
                            <p class="text-xs text-gray-500">
                                Klik tombol di samping untuk membuka kode QR dan lakukan scan pembayaran.
                            </p>
                        </div>

                        <button
                            type="button"
                            id="openQrModalBtn"
                            class="cursor-pointer rounded-md bg-[#38B8ED] px-4 py-2 text-xs sm:text-sm font-bold text-white shadow-xs transition hover:bg-sky-500"
                        >
                            Tampilkan Kode QRIS
                        </button>
                    </div>
                </div>
            </div>

            {{-- KOTAK CATATAN (MUNCUL SAAT KLIK KONFIRMASI TANPA BUKTI UNTUK TRANSFER/QRIS) --}}
            <div
                id="proofWarningNote"
                role="alert"
                class="{{ $errors->has('proof_image') ? '' : 'hidden' }} mb-6 rounded-lg border border-amber-300 bg-amber-50 px-5 py-3.5 text-center shadow-xs"
            >
                <p class="text-xs sm:text-sm font-bold leading-relaxed text-[#38B8ED]">
                    Catatan: Pengguna metode Transfer Bank / Virtual Account dan QRIS wajib mengunggah bukti
                    pembayaran. Pembayaran tunai tidak memerlukan unggahan bukti.
                </p>
            </div>

            {{-- PESAN VALIDASI RINGAN (JIKA BULAN ATAU METODE BELUM DIPILIH) --}}
            <div
                id="formClientAlert"
                role="alert"
                class="mb-4 hidden rounded-lg border border-red-200 bg-red-50 px-4 py-2.5 text-xs sm:text-sm font-semibold text-red-600"
            ></div>

            {{-- UNGGAH BUKTI & TOMBOL KONFIRMASI --}}
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-3">
                    <span class="text-sm sm:text-base font-bold text-[#4E4E4E]">
                        Silahkan Unggah Bukti Pembayaran:
                    </span>

                    <label
                        for="proofImageInput"
                        class="cursor-pointer rounded-md bg-[#EAEAEA] px-5 py-1.5 text-sm font-semibold text-[#555555] transition hover:bg-gray-300"
                    >
                        Unggah
                    </label>

                    <input
                        id="proofImageInput"
                        type="file"
                        name="proof_image"
                        accept="image/*"
                        class="hidden"
                    >

                    <span id="selectedFileName" class="text-xs text-gray-500">
                        Belum ada file dipilih
                    </span>
                </div>

                <button
                    type="submit"
                    class="cursor-pointer rounded-md bg-[#38B8ED] px-8 py-2.5 text-sm sm:text-base font-bold text-white shadow-md transition hover:bg-sky-500"
                >
                    Konfirmasi
                </button>
            </div>

        </form>

        {{-- TOMBOL KEMBALI --}}
        <div class="mt-6">
            <a
                href="{{ route('students.index', ['id' => $student->id]) }}"
                class="inline-flex items-center justify-center rounded-md bg-[#38B8ED] px-8 py-2.5 text-sm sm:text-base font-bold text-white shadow-md transition hover:bg-sky-500"
            >
                Kembali
            </a>
        </div>

    </div>

    {{-- MODAL POP-UP GAMBAR QRIS (qr.png) --}}
    <div
        id="qrisModal"
        onclick="if (event.target === this) closeQrisModal()"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4 backdrop-blur-[1px]"
    >
        <div class="w-full max-w-sm overflow-hidden rounded-2xl bg-white shadow-2xl">
            <div class="flex items-center justify-between bg-[#38B8ED] px-5 py-3.5 text-white">
                <h2 class="text-base font-bold">Scan QRIS Pembayaran SPP</h2>
                <button
                    type="button"
                    onclick="closeQrisModal()"
                    class="cursor-pointer text-2xl font-bold leading-none text-white/90 hover:text-white"
                >
                    &times;
                </button>
            </div>

            <div class="flex flex-col items-center p-5 text-center">
                <p class="mb-3 text-xs font-medium text-gray-500">
                    SMK Kristen Immanuel • Scan via GoPay, OVO, DANA, ShopeePay, atau M-Banking
                </p>

                <div class="rounded-xl border border-gray-200 bg-white p-3 shadow-xs">
                    <img
                        src="{{ asset('images/icons/qr.png') }}"
                        onerror="if (!this.dataset.triedFallback) { this.dataset.triedFallback = '1'; this.src = '{{ asset('qr.png') }}'; }"
                        alt="Kode QRIS Pembayaran"
                        class="mx-auto h-64 w-64 object-contain"
                    >
                </div>

                <p class="mt-3 text-xs text-gray-500">
                    Setelah membayar, simpan screenshot bukti transaksi lalu unggah di form.
                </p>

                <button
                    type="button"
                    onclick="closeQrisModal()"
                    class="mt-4 w-full cursor-pointer rounded-lg bg-[#38B8ED] py-2 text-sm font-bold text-white transition hover:bg-sky-500"
                >
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        function openQrisModal() {
            const modal = document.getElementById('qrisModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeQrisModal() {
            const modal = document.getElementById('qrisModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('studentPaymentForm');
            const dropdownWrapper = document.getElementById('periodDropdownWrapper');
            const dropdownToggle = document.getElementById('periodDropdownToggle');
            const dropdownMenu = document.getElementById('periodDropdownMenu');
            const dropdownArrow = document.getElementById('periodDropdownArrow');
            const dropdownLabel = document.getElementById('periodDropdownLabel');
            const checkboxes = document.querySelectorAll('.bill-checkbox');
            const totalTagihanText = document.getElementById('totalTagihanText');

            const methodRadios = document.querySelectorAll('input[name="payment_method"]');
            const transferAccountBox = document.getElementById('transferAccountBox');
            const qrisActionBox = document.getElementById('qrisActionBox');
            const copyVaBtn = document.getElementById('copyVaBtn');
            const openQrModalBtn = document.getElementById('openQrModalBtn');

            const proofInput = document.getElementById('proofImageInput');
            const selectedFileName = document.getElementById('selectedFileName');
            const proofWarningNote = document.getElementById('proofWarningNote');
            const formClientAlert = document.getElementById('formClientAlert');

            function formatRupiah(num) {
                return 'Rp ' + Math.round(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            function updateSelectedPeriods() {
                const checkedBoxes = Array.from(checkboxes).filter(cb => cb.checked);

                if (checkedBoxes.length === 0) {
                    dropdownLabel.textContent = 'pilih bulan pembayaran';
                    dropdownLabel.classList.add('text-gray-400');
                    dropdownLabel.classList.remove('text-[#4E4E4E]', 'font-semibold');
                    totalTagihanText.textContent = 'periode pembayaran belum dipilih';
                    return;
                }

                const labels = checkedBoxes.map(cb => cb.dataset.label);
                const totalAmount = checkedBoxes.reduce((sum, cb) => sum + parseFloat(cb.dataset.amount || '0'), 0);

                dropdownLabel.textContent = labels.join(', ');
                dropdownLabel.classList.remove('text-gray-400');
                dropdownLabel.classList.add('text-[#4E4E4E]', 'font-semibold');

                totalTagihanText.textContent = `${formatRupiah(totalAmount)} (${checkedBoxes.length} bulan terpilih)`;
            }

            dropdownToggle.addEventListener('click', function () {
                const isHidden = dropdownMenu.classList.toggle('hidden');
                dropdownToggle.setAttribute('aria-expanded', String(!isHidden));
                dropdownArrow.classList.toggle('rotate-180', !isHidden);
            });

            document.addEventListener('click', function (e) {
                if (!dropdownWrapper.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                    dropdownToggle.setAttribute('aria-expanded', 'false');
                    dropdownArrow.classList.remove('rotate-180');
                }
            });

            checkboxes.forEach(cb => cb.addEventListener('change', function () {
                updateSelectedPeriods();
                formClientAlert.classList.add('hidden');
            }));

            function syncMethodPanels() {
                const checked = document.querySelector('input[name="payment_method"]:checked');
                const type = checked ? checked.dataset.methodType : '';

                transferAccountBox.classList.toggle('hidden', type !== 'transfer');
                qrisActionBox.classList.toggle('hidden', type !== 'qris');

                if (type === 'cash') {
                    proofWarningNote.classList.add('hidden');
                }
                formClientAlert.classList.add('hidden');
            }

            methodRadios.forEach(r => r.addEventListener('change', syncMethodPanels));

            if (copyVaBtn) {
                copyVaBtn.addEventListener('click', function () {
                    const vaText = document.getElementById('vaNumberText').textContent.trim();
                    navigator.clipboard?.writeText(vaText);
                    copyVaBtn.textContent = 'Tersalin!';
                    setTimeout(() => {
                        copyVaBtn.textContent = 'Salin No. VA';
                    }, 1800);
                });
            }

            if (openQrModalBtn) {
                openQrModalBtn.addEventListener('click', openQrisModal);
            }

            proofInput.addEventListener('change', function () {
                const hasFile = this.files && this.files.length > 0;
                selectedFileName.textContent = hasFile ? this.files[0].name : 'Belum ada file dipilih';
                if (hasFile) {
                    proofWarningNote.classList.add('hidden');
                }
            });

            form.addEventListener('submit', function (e) {
                const checkedPeriods = Array.from(checkboxes).filter(cb => cb.checked);
                const checkedMethod = document.querySelector('input[name="payment_method"]:checked');

                if (checkedPeriods.length === 0) {
                    e.preventDefault();
                    formClientAlert.textContent = 'Silakan pilih minimal 1 bulan periode pembayaran.';
                    formClientAlert.classList.remove('hidden');
                    return;
                }

                if (!checkedMethod) {
                    e.preventDefault();
                    formClientAlert.textContent = 'Silakan pilih metode pembayaran terlebih dahulu.';
                    formClientAlert.classList.remove('hidden');
                    return;
                }

                const methodType = checkedMethod.dataset.methodType;
                const hasProof = proofInput.files && proofInput.files.length > 0;

                if ((methodType === 'transfer' || methodType === 'qris') && !hasProof) {
                    e.preventDefault();
                    proofWarningNote.classList.remove('hidden');
                    proofWarningNote.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });

            updateSelectedPeriods();
            syncMethodPanels();
        });
    </script>

@endsection