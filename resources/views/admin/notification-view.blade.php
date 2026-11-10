@extends('layouts.app')

@section ('title', $title)

@section ('content')

    <main class="min-h-screen bg-[#f4f5ff] px-6 py-8 lg:ml-[88px]">
        <div class="mx-auto max-w-[1080px]">

            {{-- Title --}}
            <div class="flex space-between">
                <h1 class="mb-6 text-[21px] font-bold text-[#38b8ed]">
                    NOTIFIKASI PEMBAYARAN SISWA
                </h1>
                <button type="button" class="flex h-[44px] w-[200px] items-center justify-between
                               rounded-full border border-gray-200 bg-white px-5
                               text-[17px] text-gray-400 shadow-md
                               hover:border-[#38b8ed]">
                    <span>Filter</span>

                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M4 6h16M7 12h10M10 18h4"></path>
                    </svg>
                </button>
            </div>

            {{-- File Grid --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">


                {{-- Create New --}}
                <x-admin.report.create-file />

                {{-- File --}}
                <x-admin.report.file-card name="12TKJ1_Agu_2026.xlsx" modified="20/Aug/2026" />

                <x-admin.report.file-card name="12TKJ1_Agu_2026.xlsx" modified="20/Aug/2026" />

                <x-admin.report.file-card name="12TKJ1_Agu_2026.xlsx" modified="20/Aug/2026" />

                <x-admin.report.file-card name="12TKJ1_Agu_2026.xlsx" modified="20/Aug/2026" />

                <x-admin.report.file-card name="12TKJ1_Agu_2026.xlsx" modified="20/Aug/2026" />

                <x-admin.report.file-card name="12TKJ1_Agu_2026.xlsx" modified="20/Aug/2026" />

                <x-admin.report.file-card name="12TKJ1_Agu_2026.xlsx" modified="20/Aug/2026" />

                <x-admin.report.file-card name="12TKJ1_Agu_2026.xlsx" modified="20/Aug/2026" />

                <x-admin.report.file-card name="12TKJ1_Agu_2026.xlsx" modified="20/Aug/2026" />

                <x-admin.report.file-card name="12TKJ1_Agu_2026.xlsx" modified="20/Aug/2026" />

                <x-admin.report.file-card name="12TKJ1_Agu_2026.xlsx" modified="20/Aug/2026" />


            </div>
    </main>

@endsection