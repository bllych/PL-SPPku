@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="flex flex-col gap-7">
        <section>
            <h1 class="mb-4 text-xl font-semibold text-[#45C0F4]">PROFIL PRIBADI</h1>

            <div class="grid gap-6 rounded-xl bg-white p-6 shadow-md lg:grid-cols-[320px_minmax(0,1fr)] lg:items-center">
                <div class="flex flex-col items-center gap-4 border-gray-200 text-center lg:border-r lg:py-4 lg:pr-6">
                    <img
                        src="{{ asset('images/icons/profile.png') }}"
                        alt="Foto profil {{ $student->user->name }}"
                        class="h-28 w-28 rounded-full object-cover"
                    >
                    <p class="font-semibold text-[#4E4E4E]">SMK Kristen Immanuel</p>
                </div>

                <dl class="divide-y divide-gray-200">
                    <div class="flex flex-col justify-between gap-1 py-3 sm:flex-row sm:gap-6">
                        <dt class="font-medium text-[#4E4E4E]">Nama</dt>
                        <dd class="text-[#999999] sm:text-right">{{ $student->user->name }}</dd>
                    </div>
                    <div class="flex flex-col justify-between gap-1 py-3 sm:flex-row sm:gap-6">
                        <dt class="font-medium text-[#4E4E4E]">NISN/Nomor Induk</dt>
                        <dd class="text-[#999999] sm:text-right">{{ $student->nisn }}/{{ $student->nis }}</dd>
                    </div>
                    <div class="flex flex-col justify-between gap-1 py-3 sm:flex-row sm:gap-6">
                        <dt class="font-medium text-[#4E4E4E]">Kelas</dt>
                        <dd class="text-[#999999] sm:text-right">{{ $student->class }}</dd>
                    </div>
                    <div class="flex flex-col justify-between gap-1 py-3 sm:flex-row sm:gap-6">
                        <dt class="font-medium text-[#4E4E4E]">Jurusan</dt>
                        <dd class="text-[#999999] sm:text-right">{{ $student->major }}</dd>
                    </div>
                    <div class="flex flex-col justify-between gap-1 py-3 sm:flex-row sm:gap-6">
                        <dt class="font-medium text-[#4E4E4E]">Tahun Ajaran</dt>
                        <dd class="text-[#999999] sm:text-right">{{ $student->school_year }}</dd>
                    </div>
                </dl>
            </div>
        </section>

        <section>
            <h2 class="mb-4 text-xl font-semibold text-[#45C0F4]">KEAMANAN DAN INFORMASI AKUN</h2>

            <div class="grid gap-8 rounded-xl bg-white p-6 shadow-md lg:grid-cols-2">
                <dl class="divide-y divide-gray-200">
                    <div class="flex justify-between gap-4 py-3">
                        <dt class="font-medium text-[#4E4E4E]">Password</dt>
                        <dd class="text-right text-[#999999]">••••••••</dd>
                    </div>
                    <div class="flex justify-between gap-4 py-3">
                        <dt class="font-medium text-[#4E4E4E]">Email</dt>
                        <dd class="text-right text-[#999999]">{{ $student->user->email }}</dd>
                    </div>
                    <div class="flex justify-between gap-4 py-3">
                        <dt class="font-medium text-[#4E4E4E]">No. Telepon</dt>
                        <dd class="text-right text-[#999999]">081234567890</dd>
                    </div>
                    <div class="flex justify-between gap-4 py-3">
                        <dt class="font-medium text-[#4E4E4E]">Terakhir Login</dt>
                        <dd class="text-right text-[#999999]">15 November 2026</dd>
                    </div>
                    <div class="flex justify-between gap-4 py-3">
                        <dt class="font-medium text-[#4E4E4E]">Status Akun</dt>
                        <dd class="text-right font-medium text-green-500">Aktif</dd>
                    </div>
                </dl>

                <div class="flex flex-col">
                    <dl class="divide-y divide-gray-200">
                        <div class="flex justify-between gap-4 py-3">
                            <dt class="font-medium text-[#4E4E4E]">Pelanggaran</dt>
                            <dd class="text-right text-[#999999]">0</dd>
                        </div>
                        <div class="flex justify-between gap-4 py-3">
                            <dt class="font-medium text-[#4E4E4E]">Sakit</dt>
                            <dd class="text-right text-[#999999]">2</dd>
                        </div>
                        <div class="flex justify-between gap-4 py-3">
                            <dt class="font-medium text-[#4E4E4E]">Izin</dt>
                            <dd class="text-right text-[#999999]">1</dd>
                        </div>
                        <div class="flex justify-between gap-4 py-3">
                            <dt class="font-medium text-[#4E4E4E]">Terlambat</dt>
                            <dd class="text-right text-[#999999]">0</dd>
                        </div>
                    </dl>

                    <form method="POST" action="{{ route('logout') }}" class="mt-auto flex justify-end pt-5" data-confirm-logout>
                        @csrf
                        <button type="submit" class="rounded-lg bg-[#45C0F4] px-5 py-2.5 font-semibold text-white shadow-md transition hover:bg-sky-500">
                            Keluar Akun
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
