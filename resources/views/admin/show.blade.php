
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

    $notes = [
        [
            'date' => '21/Agu/2026',
            'items' => [
                'Perbaiki excel siswa 12 tkj 1',
                'kumpulkan laporan ke kepala sekolah',
                'ketemu dengan kantor administrasi',
            ],
        ],
        [
            'date' => '1/Sep/2026',
            'items' => [
                'pengumpulan laporan akhir spp agu',
                'hitung pembayaran spp',
                'cek ulang dan ingatin pembayaran spp',
            ],
        ],
    ];
@endphp

<div class="min-h-full bg-[#F3F5FF] px-5 py-5 md:px-1">

    <div class="grid grid-cols-1 gap-9 lg:grid-cols-[1.35fr_0.9fr]">

        {{-- KOLOM KIRI --}}
        <div class="flex flex-col gap-5">

            {{-- Welcome Profile --}}
            <div class="flex items-center gap-4 rounded-l-[90px] bg-white px-5 py-4 shadow-md">

                <div class="shrink-0">
                    <img
                        src="{{ asset('images/profile admin.png') }}"
                        alt="Foto Profil Admin"
                        class="h-30 w-30 rounded-full object-cover"
                    >
                </div>

                <div class="min-w-0 flex-1">
                    <h2 class="text-lg font-bold text-[#45C0F4] md:text-lg">
                        Welcome Back, {{ $admin['name'] }}!
                    </h2>

                    <div class="flex flex-wrap items-center gap-2">
                        <p class="text-base font-semibold text-[#4E4E4E]">
                            Do your best! Tuhan menyertai
                        </p>

                        <a href="#" title="Edit profil">
                            <img
                                src="{{ asset('images/icons/edit profile student.png') }}"
                                alt="Edit profil"
                                class="h-4 w-4 object-contain"
                            >
                        </a>
                    </div>
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
                <a
                    href="{{ url('/login') }}"
                    class="inline-flex items-center justify-center rounded-md bg-[#45C0F4] px-6 py-3 text-base font-bold text-white shadow-sm transition hover:bg-sky-500"
                >
                    Keluar Akun
                </a>
            </div>

        </div>


        {{-- KOLOM KANAN --}}
        <div>

            {{-- Catatan Pribadi --}}
            <h2 class="mb-3 text-lg font-bold text-[#45C0F4]">
                CATATAN PRIBADI
            </h2>

            <div class="rounded-md bg-white px-5 py-3 shadow-md">

                @foreach ($notes as $note)
                    <div class="mb-4 last:mb-0">

                        {{-- Tanggal --}}
                        <p class="mb-3 text-base font-medium text-[#4E4E4E]">
                            {{ $note['date'] }}
                        </p>

                        {{-- Isi Catatan --}}
                        <div class="flex flex-col gap-3">
                            @foreach ($note['items'] as $item)
                                <p class="text-base font-medium leading-relaxed text-[#999999]">
                                    {{ $item }}
                                </p>
                            @endforeach
                        </div>

                    </div>
                @endforeach

            </div>

            {{-- Tambahkan Catatan --}}
            <div class="mt-3">
                <button
                    type="button"
                    class="w-full rounded-md border-3 border-[#45C0F4] bg-white px-5 py-3 text-base font-bold text-[#45C0F4] transition hover:bg-[#EAF8FF]"
                >
                    Tambahkan Catatan
                </button>
            </div>

        </div>

    </div>

</div>

@endsection
