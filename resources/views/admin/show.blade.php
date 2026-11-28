@extends('layouts.app')

@section('title', $title)

@section('content')

    @php
        $profileFields = [
            'Nama' => $admin['name'],
            'Username' => $admin['username'],
            'No. Hp' => $admin['phone'],
            'E-Mail' => $admin['email'],
            'Status Akun' => $admin['account_status'],
            'ID Admin' => $admin['admin_id'],
            'Jabatan' => $admin['position'],
            'Instansi' => $admin['institution'],
        ];

        $defaultNotes = [
            '1/Sep/2026' => [
                'pengumpulan laporan akhir spp agu',
                'hitung pembayaran spp',
                'cek ulang dan ingatin pembayaran spp',
            ],
            '21/Agu/2026' => [
                'Perbaiki excel siswa 12 tkj 1',
                'kumpulkan laporan ke kepala sekolah',
                'ketemu dengan kantor administrasi',
            ],
        ];
    @endphp

    <div class="min-h-full bg-[#F3F5FF] px-5 py-5 md:px-1">

        @if (session('success'))
            <div id="alertSuccess"
                class="mb-4 flex items-center justify-between rounded-xl border border-green-400 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700 shadow-sm">
                <span>{{ session('success') }}</span>
                <button type="button" onclick="document.getElementById('alertSuccess').remove()"
                    class="cursor-pointer font-bold text-green-700 hover:text-green-900">&times;</button>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-9 lg:grid-cols-[1.35fr_0.9fr]">

            {{-- KOLOM KIRI --}}
            <div class="flex flex-col gap-5">

                {{-- Welcome Profile --}}
                <div class="flex items-center gap-4 rounded-l-[90px] bg-white px-5 py-4 shadow-md">

                    <div class="shrink-0">
                        <img src="{{ asset('images/profile admin.png') }}" alt="Foto Profil Admin"
                            class="h-30 w-30 rounded-full object-cover">
                    </div>

                    <div class="min-w-0 flex-1">
                        <h2 class="text-lg font-bold text-[#45C0F4] md:text-lg">
                            Welcome Back, {{ $admin['name'] }}!
                        </h2>

                        {{-- Mode Tampil Bio / Motto --}}
                        <div id="bioViewBox" class="{{ $errors->has('bio') ? 'hidden' : 'flex' }} flex-wrap items-center gap-2">
                            <p class="text-base font-semibold text-[#4E4E4E]">
                                {{ $admin['bio'] }}
                            </p>

                            <button type="button" id="editBioBtn" title="Edit bio"
                                class="cursor-pointer rounded p-1 transition hover:bg-sky-50">
                                <img src="{{ asset('images/icons/edit profile student.png') }}" alt="Edit bio"
                                    class="h-4 w-4 object-contain">
                            </button>
                        </div>

                        {{-- Mode Edit Bio / Motto --}}
                        <form id="bioEditForm" action="{{ route('admin.profile.bio') }}" method="POST"
                            class="{{ $errors->has('bio') ? 'flex' : 'hidden' }} mt-1.5 flex-wrap items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <input type="text" id="bioInput" name="bio" maxlength="150" required
                                value="{{ old('bio', $admin['bio']) }}"
                                class="w-full max-w-[320px] rounded-md border border-[#45C0F4] bg-[#F3F5FF]/50 px-2.5 py-1 text-sm font-semibold text-[#4E4E4E] outline-none">

                            <div class="flex items-center gap-1.5">
                                <button type="submit"
                                    class="cursor-pointer rounded-md bg-[#45C0F4] px-3 py-1 text-xs font-bold text-white hover:bg-sky-500">
                                    Simpan
                                </button>
                                <button type="button" id="cancelBioBtn"
                                    class="cursor-pointer rounded-md border border-gray-300 bg-white px-2.5 py-1 text-xs font-semibold text-[#999999] hover:bg-gray-50">
                                    Batal
                                </button>
                            </div>

                            @error('bio')
                                <p class="w-full text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </form>
                    </div>

                </div>

                {{-- Informasi Akun --}}
                <div>
                    <h2 class="mb-3 text-lg font-bold text-[#45C0F4]">
                        INFORMASI AKUN
                    </h2>

                    <div class="rounded-md bg-white px-6 py-4 shadow-md">

                        @foreach ($profileFields as $label => $value)
                            <div class="flex min-h-[31px] items-center justify-between gap-3 py-1.5">

                                <span class="text-base font-medium text-[#4E4E4E]">
                                    {{ $label }}
                                </span>

                                <span class="text-right text-base font-medium text-[#999999]">
                                    {{ $value }}
                                </span>

                            </div>
                        @endforeach

                    </div>
                </div>

                {{-- Keluar Akun --}}
                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="inline-flex cursor-pointer items-center justify-center rounded-md bg-[#45C0F4] px-6 py-3 text-base font-bold text-white shadow-sm transition hover:bg-sky-500">
                            Keluar Akun
                        </button>
                    </form>
                </div>

            </div>


            {{-- KOLOM KANAN --}}
            <div>

                {{-- Catatan Pribadi --}}
                <h2 class="mb-3 text-lg font-bold text-[#45C0F4]">
                    CATATAN PRIBADI
                </h2>

                {{-- Form Tambah Catatan --}}
                <form id="noteForm" action="{{ route('admin.notes.store') }}" method="POST"
                    class="{{ $errors->has('content') ? '' : 'hidden' }} mb-3 rounded-md bg-white p-4 shadow-md">
                    @csrf
                    <label for="noteContent" class="mb-2 block text-sm font-semibold text-[#4E4E4E]">
                        Catatan Baru ({{ now()->translatedFormat('j/M/Y') }})
                    </label>
                    <textarea id="noteContent" name="content" rows="3" required
                        placeholder="Tulis catatan baru di sini..."
                        class="w-full rounded-lg border border-gray-300 p-2.5 text-sm text-[#4E4E4E] outline-none focus:border-[#45C0F4]">{{ old('content') }}</textarea>

                    @error('content')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror

                    <div class="mt-2.5 flex justify-end gap-2">
                        <button type="button" id="cancelNoteBtn"
                            class="cursor-pointer rounded-md border border-gray-300 px-4 py-1.5 text-sm font-semibold text-[#999999] hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit"
                            class="cursor-pointer rounded-md bg-[#45C0F4] px-4 py-1.5 text-sm font-semibold text-white hover:bg-sky-500">
                            Simpan Catatan
                        </button>
                    </div>
                </form>

                {{-- Daftar Catatan --}}
                <div class="rounded-md bg-white px-5 py-3 shadow-md">

                    {{-- 1. Catatan dari Database --}}
                    @foreach ($groupedNotes as $date => $items)
                        <div class="mb-4 last:mb-0">
                            <p class="mb-3 text-base font-medium text-[#4E4E4E]">
                                {{ $date }}
                            </p>

                            <div class="flex flex-col gap-3">
                                @foreach ($items as $note)
                                    <div class="flex items-start justify-between gap-2">
                                        <p class="text-base font-medium leading-relaxed text-[#999999]">
                                            {{ $note->content }}
                                        </p>

                                        <form action="{{ route('admin.notes.destroy', $note->id) }}" method="POST"
                                            class="shrink-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus catatan"
                                                class="cursor-pointer rounded px-1.5 py-0.5 text-sm font-bold text-gray-300 transition hover:bg-red-50 hover:text-red-500">
                                                &times;
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    {{-- 2. Riwayat Catatan Bawaan --}}
                    @foreach ($defaultNotes as $date => $items)
                        <div class="default-note-group mb-4 last:mb-0">
                            <p class="mb-3 text-base font-medium text-[#4E4E4E]">
                                {{ $date }}
                            </p>

                            <div class="flex flex-col gap-3">
                                @foreach ($items as $item)
                                    <div class="default-note-item flex items-start justify-between gap-2">
                                        <p class="text-base font-medium leading-relaxed text-[#999999]">
                                            {{ $item }}
                                        </p>

                                        <button type="button" title="Hapus catatan"
                                            onclick="removeDefaultNote(this)"
                                            class="shrink-0 cursor-pointer rounded px-1.5 py-0.5 text-sm font-bold text-gray-300 transition hover:bg-red-50 hover:text-red-500">
                                            &times;
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>

                {{-- Tombol Tambahkan Catatan --}}
                <div class="mt-3">
                    <button type="button" id="openNoteBtn"
                        class="w-full cursor-pointer rounded-md border-3 border-[#45C0F4] bg-white px-5 py-3 text-base font-bold text-[#45C0F4] transition hover:bg-[#EAF8FF]">
                        Tambahkan Catatan
                    </button>
                </div>

            </div>

        </div>

    </div>

    <script>
        function removeDefaultNote(btn) {
            const item = btn.closest('.default-note-item');
            const group = btn.closest('.default-note-group');
            item.remove();
            if (group && group.querySelectorAll('.default-note-item').length === 0) {
                group.remove();
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Toggle Edit Bio / Motto
            const editBioBtn = document.getElementById('editBioBtn');
            const cancelBioBtn = document.getElementById('cancelBioBtn');
            const bioViewBox = document.getElementById('bioViewBox');
            const bioEditForm = document.getElementById('bioEditForm');
            const bioInput = document.getElementById('bioInput');

            if (editBioBtn && bioEditForm) {
                editBioBtn.addEventListener('click', function () {
                    bioViewBox.classList.add('hidden');
                    bioViewBox.classList.remove('flex');
                    bioEditForm.classList.remove('hidden');
                    bioEditForm.classList.add('flex');
                    bioInput.focus();
                    bioInput.select();
                });

                cancelBioBtn.addEventListener('click', function () {
                    bioEditForm.classList.add('hidden');
                    bioEditForm.classList.remove('flex');
                    bioViewBox.classList.remove('hidden');
                    bioViewBox.classList.add('flex');
                });
            }

            // Toggle Form Tambah Catatan Pribadi
            const openBtn = document.getElementById('openNoteBtn');
            const cancelBtn = document.getElementById('cancelNoteBtn');
            const noteForm = document.getElementById('noteForm');
            const noteInput = document.getElementById('noteContent');

            openBtn.addEventListener('click', function () {
                noteForm.classList.remove('hidden');
                noteInput.focus();
            });

            cancelBtn.addEventListener('click', function () {
                noteForm.classList.add('hidden');
                noteInput.value = '';
            });
        });
    </script>

@endsection