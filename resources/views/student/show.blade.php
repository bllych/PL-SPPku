@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="mx-auto max-w-4xl space-y-6">
    <div>
        <h1 class="text-2xl font-semibold text-slate-800">Profil Siswa</h1>
        <p class="mt-1 text-sm text-slate-500">Informasi akun dan data sekolah siswa.</p>
    </div>

    <section class="rounded-2xl bg-white p-6 shadow-sm">
        <h2 class="mb-5 text-lg font-semibold text-slate-800">Informasi Akun</h2>
        <dl class="grid gap-5 sm:grid-cols-2">
            <div>
                <dt class="text-sm text-slate-500">Nama</dt>
                <dd class="mt-1 font-medium text-slate-800">{{ $student->user->name }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Email</dt>
                <dd class="mt-1 font-medium text-slate-800">{{ $student->user->email }}</dd>
            </div>
        </dl>
    </section>

    <section class="rounded-2xl bg-white p-6 shadow-sm">
        <h2 class="mb-5 text-lg font-semibold text-slate-800">Data Sekolah</h2>
        <dl class="grid gap-5 sm:grid-cols-2">
            <div>
                <dt class="text-sm text-slate-500">NISN</dt>
                <dd class="mt-1 font-medium text-slate-800">{{ $student->nisn }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">NIS</dt>
                <dd class="mt-1 font-medium text-slate-800">{{ $student->nis }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Kelas</dt>
                <dd class="mt-1 font-medium text-slate-800">{{ $student->class }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Jurusan</dt>
                <dd class="mt-1 font-medium text-slate-800">{{ $student->major }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Tahun Ajaran</dt>
                <dd class="mt-1 font-medium text-slate-800">{{ $student->school_year }}</dd>
            </div>
        </dl>
    </section>
</div>

@endsection
