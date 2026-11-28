@extends('layouts.app')

@section('title', $title)

@section('content')

    <main class="min-h-screen bg-[#f4f5ff] px-6 py-8 lg:ml-[88px]">
        <div class="mx-auto max-w-[1080px]">

            {{-- Filter --}}
            <x-admin.report.filter :available-classes="$availableClasses" />

            {{-- Title --}}
            <h1 class="mb-6 text-[21px] font-bold text-[#38b8ed]">
                LAPORAN KEUANGAN
            </h1>

            {{-- File Grid --}}
            <div id="reportGrid" class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

                {{-- Create New --}}
                <x-admin.report.create-file />

                {{-- Daftar File Laporan --}}
                @forelse ($reports as $report)
                    <x-admin.report.file-card
                        :name="$report['name']"
                        :modified="$report['modified']"
                        :class-name="$report['class_name'] ?? ''"
                        :month="$report['month'] ?? null"
                        :year="$report['year'] ?? null"
                    />
                @empty
                    <div id="emptyReportState"
                        class="col-span-full rounded-lg border border-dashed border-gray-300 bg-white/70 p-8 text-center text-gray-400">
                        Tidak ada file laporan untuk filter ini.
                    </div>
                @endforelse

            </div>

        </div>
    </main>

    {{-- Form Modal Kecil untuk Create New Card --}}
    <div id="createReportModal"
        onclick="if (event.target === this) closeCreateReportModal()"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4 backdrop-blur-[1px]">
        <div class="w-full max-w-sm rounded-2xl bg-white p-5 shadow-xl">
            <div class="mb-4 flex items-center justify-between border-b border-gray-100 pb-3">
                <h2 class="text-base font-bold text-[#38b8ed]">Buat Card Laporan Baru</h2>
                <button type="button" onclick="closeCreateReportModal()"
                    class="cursor-pointer text-xl font-bold leading-none text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <form onsubmit="handleCreateReport(event)" class="space-y-3.5">
                <div>
                    <label class="mb-1 block text-xs font-semibold text-gray-600">Kelas</label>
                    <select id="newReportClass"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 outline-none focus:border-[#38b8ed]">
                        <option value="SemuaKelas">Semua Kelas</option>
                        @foreach ($availableClasses as $cls)
                            <option value="{{ str_replace(' ', '', $cls) }}">{{ $cls }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-2.5">
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-600">Bulan</label>
                        <select id="newReportMonth"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 outline-none focus:border-[#38b8ed]">
                            @foreach (['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'] as $mAbbr)
                                <option value="{{ $mAbbr }}" @selected($mAbbr === 'Agu')>{{ $mAbbr }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-600">Tahun</label>
                        <select id="newReportYear"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 outline-none focus:border-[#38b8ed]">
                            <option value="2026" selected>2026</option>
                            <option value="2027">2027</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="mb-1 block text-xs font-semibold text-gray-600">Nama File (Opsional)</label>
                    <input type="text" id="newReportName" placeholder="Default: Kelas_Bulan_Tahun.xlsx"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-700 outline-none focus:border-[#38b8ed]">
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeCreateReportModal()"
                        class="cursor-pointer rounded-lg border border-gray-300 px-3.5 py-1.5 text-sm font-semibold text-gray-500 hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="cursor-pointer rounded-lg bg-[#38b8ed] px-4 py-1.5 text-sm font-semibold text-white hover:bg-sky-500">
                        Buat Card
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sesuaikan ke asset('assets/Laporan_SPP_2026-2027.xlsx') jika file dummy ada di public/assets/
        const dummyFileUrl = "{{ asset('Laporan_SPP_2026-2027.xlsx') }}";
        const excelIconUrl = "{{ asset('images/icons/excel.png') }}";

        function openCreateReportModal() {
            const modal = document.getElementById('createReportModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.getElementById('newReportName').focus();
        }

        function closeCreateReportModal() {
            const modal = document.getElementById('createReportModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function handleCreateReport(event) {
            event.preventDefault();

            const classVal = document.getElementById('newReportClass').value;
            const monthVal = document.getElementById('newReportMonth').value;
            const yearVal = document.getElementById('newReportYear').value;
            const customName = document.getElementById('newReportName').value.trim();

            let fileName = customName !== '' ? customName : `${classVal}_${monthVal}_${yearVal}.xlsx`;
            if (!fileName.toLowerCase().endsWith('.xlsx') && !fileName.toLowerCase().endsWith('.xls')) {
                fileName += '.xlsx';
            }

            const today = new Date();
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const modifiedStr = `${String(today.getDate()).padStart(2, '0')}/${months[today.getMonth()]}/${today.getFullYear()}`;

            const card = document.createElement('div');
            card.className = 'report-card-item relative flex h-[164px] flex-col items-center justify-center rounded-lg border border-gray-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md';
            card.innerHTML = `
                <div class="report-menu-wrapper absolute right-3 top-3">
                    <button type="button" onclick="this.nextElementSibling.classList.toggle('hidden')"
                        class="cursor-pointer rounded-full p-1 text-gray-500 transition hover:bg-gray-100 hover:text-gray-700">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <circle cx="12" cy="5" r="1.5" /><circle cx="12" cy="12" r="1.5" /><circle cx="12" cy="19" r="1.5" />
                        </svg>
                    </button>
                    <div class="report-menu-dropdown absolute right-0 z-20 mt-1 hidden w-36 overflow-hidden rounded-xl border border-gray-100 bg-white py-1 text-left text-sm shadow-lg">
                        <a href="${dummyFileUrl}" download="${fileName}" class="report-download-link block px-3.5 py-2 font-medium text-gray-700 hover:bg-sky-50 hover:text-[#38b8ed]">Download</a>
                        <button type="button" onclick="renameReportCard(this)" class="block w-full cursor-pointer px-3.5 py-2 text-left font-medium text-gray-700 hover:bg-sky-50 hover:text-[#38b8ed]">Ubah Nama</button>
                        <button type="button" onclick="this.closest('.report-card-item').remove()" class="block w-full cursor-pointer px-3.5 py-2 text-left font-medium text-red-500 hover:bg-red-50">Hapus</button>
                    </div>
                </div>
                <a href="${dummyFileUrl}" download="${fileName}" class="report-download-link flex flex-col items-center">
                    <img src="${excelIconUrl}" alt="Excel" class="mb-2 h-[84px] w-[70px] object-contain">
                    <p class="report-file-title max-w-[210px] truncate text-[16px] font-semibold text-gray-600 hover:text-[#38b8ed]"></p>
                    <p class="mt-1 text-[15px] text-gray-400">Modified ${modifiedStr}</p>
                </a>
            `;
            card.querySelector('.report-file-title').textContent = fileName;

            const emptyState = document.getElementById('emptyReportState');
            if (emptyState) emptyState.remove();

            const grid = document.getElementById('reportGrid');
            grid.insertBefore(card, grid.children[1] || null);

            document.getElementById('newReportName').value = '';
            closeCreateReportModal();
        }

        function renameReportCard(btn) {
            const card = btn.closest('.report-card-item');
            const titleEl = card.querySelector('.report-file-title');
            const currentName = titleEl.textContent.trim();
            const newName = prompt('Masukkan nama file baru:', currentName);

            if (newName && newName.trim() !== '') {
                let clean = newName.trim();
                if (!clean.toLowerCase().endsWith('.xlsx') && !clean.toLowerCase().endsWith('.xls')) {
                    clean += '.xlsx';
                }
                titleEl.textContent = clean;
                card.querySelectorAll('.report-download-link').forEach(link => {
                    link.setAttribute('download', clean);
                });
            }
            btn.closest('.report-menu-dropdown').classList.add('hidden');
        }

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.report-menu-wrapper')) {
                document.querySelectorAll('.report-menu-dropdown').forEach(el => el.classList.add('hidden'));
            }
            if (!e.target.closest('.report-filter-dropdown')) {
                document.querySelectorAll('.report-filter-dropdown').forEach(el => el.removeAttribute('open'));
            }
        });
    </script>

@endsection