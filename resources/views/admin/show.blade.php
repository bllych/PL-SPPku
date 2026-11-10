
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="min-h-full bg-[#F3F5FF] px-5 py-5 md:px-10">

    {{-- PROFIL PRIBADI --}}
    <h2 class="mb-4 text-sm font-semibold text-[#45C0F4]">
        PROFIL PRIBADI
    </h2>

    <div class="mb-6 grid grid-cols-1 items-center gap-6 rounded-md bg-white px-6 py-4 shadow-md md:grid-cols-[30%_70%] md:gap-0">

        {{-- Foto --}}
        <div class="flex flex-col items-center justify-center">
            <div class="relative">
                <img
                    src="{{ asset('images/profile student.png') }}"
                    alt="Foto Profil Siswa"
                    class="h-24 w-24 rounded-full object-cover"
                >

                <a href="#" title="Edit profil"
                   class="absolute -right-4 bottom-0">
                    <img
                        src="{{ asset('images/icons/edit profile student.png') }}"
                        alt="Edit profil"
                        class="h-5 w-5 object-contain"
                    >
                </a>
            </div>

            <p class="mt-3 text-sm font-semibold text-[#4E4E4E]">
                SMK Kristen Immanuel
            </p>
        </div>

        {{-- Data pribadi --}}
        <div class="min-w-0">
            @php
                $profileFields = [
                    'Nama' => $student['profile']['name'],
                    'NISN/Nomor Induk' => $student['profile']['nisn'].'/'.$student['profile']['nis'],
                    'Kelas' => $student['profile']['class'],
                    'Jurusan' => $student['profile']['major'],
                    'Tahun Ajaran' => $student['profile']['school_year'],
                ];
            @endphp

            @foreach ($profileFields as $label => $value)
                <div class="flex min-h-[36px] items-center justify-between gap-3 border-b border-[#E5E5E5] py-2 last:border-b-0">
                    <span class="text-sm text-[#4E4E4E]">
                        {{ $label }}
                    </span>

                    <span class="text-right text-sm text-[#999999]">
                        {{ $value }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- KEAMANAN DAN INFORMASI AKUN --}}
    <h2 class="mb-4 text-sm font-semibold text-[#45C0F4]">
        KEAMANAN DAN INFORMASI AKUN
    </h2>

    <div class="grid grid-cols-1 gap-6 rounded-md bg-white px-6 py-4 shadow-md md:grid-cols-2 md:gap-8">

        {{-- Kolom kiri --}}
        <div class="min-w-0">
            @php
                $accountFields = [
                    'Password' => $student['account']['password'],
                    'Email' => $student['account']['email'],
                    'No. Telepon' => $student['account']['phone'],
                    'Terakhir Login' => $student['account']['last_login'],
                    'Status Akun' => $student['account']['account_status'],
                ];
            @endphp

            @foreach ($accountFields as $label => $value)
                <div class="flex min-h-[36px] items-center justify-between gap-3 border-b border-[#E5E5E5] py-2 last:border-b-0">
                    <span class="text-sm text-[#4E4E4E]">
                        {{ $label }}
                    </span>

                    <span class="break-all text-right text-sm {{ $label === 'Status Akun' ? 'text-green-500' : 'text-[#999999]' }}">
                        {{ $value }}
                    </span>
                </div>
            @endforeach
        </div>

        {{-- Kolom kanan --}}
        <div class="min-w-0">
            @php
                $attendanceFields = [
                    'Pelanggaran' => $student['attendance']['warning'],
                    'Sakit' => $student['attendance']['sick'],
                    'Izin' => $student['attendance']['permission'],
                    'Terlambat' => $student['attendance']['late'],
                ];
            @endphp

            @foreach ($attendanceFields as $label => $value)
                <div class="flex min-h-[36px] items-center justify-between gap-3 border-b border-[#E5E5E5] py-2 last:border-b-0">
                    <span class="text-sm text-[#4E4E4E]">
                        {{ $label }}
                    </span>

                    <span class="text-sm text-[#999999]">
                        {{ $value }}
                    </span>
                </div>
            @endforeach

            <div class="flex justify-end pt-4">
                <a href="{{ url('/login') }}"
                   class="rounded-md bg-[#45C0F4] px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sky-500">
                    Keluar Akun
                </a>
            </div>
        </div>

    </div>

</div>
    
</body>
</html>

@endsection
