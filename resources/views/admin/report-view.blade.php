@extends('layouts.app')

@section ('title', $title)

@section ('content')

    <main class="min-h-screen bg-[#f4f5ff] px-6 py-8 lg:ml-[88px]">
        <div class="mx-auto max-w-[1080px]">

            {{-- Filter --}}
            <x-admin.report.filter />

            {{-- Title --}}
            <h1 class="mb-6 text-[21px] font-bold text-[#38b8ed]">
                LAPORAN KEUANGAN
            </h1>


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