<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@ski.sch.id'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Akun Siswa untuk Login
        $studentUser = User::updateOrCreate(
            ['email' => 'student@ski.sch.id'],
            [
                'name' => 'Student',
                'password' => Hash::make('password'),
                'role' => 'student',
            ]
        );

        Student::updateOrCreate(
            ['user_id' => $studentUser->id],
            [
                'nisn' => '0012345678',
                'nis' => '123456',
                'class' => '10 RPL 1',
                'major' => 'Rekayasa Perangkat Lunak',
                'school_year' => '2026/2027',
            ]
        );

        // Daftar 35 Siswa
        $studentsData = [
            ['name' => 'Alfredy Rudi', 'class' => '12 TKJ 1', 'status' => 'Belum Lunas'],
            ['name' => 'Alice Holly Kristy', 'class' => '12 AKL', 'status' => 'Lunas'],
            ['name' => 'Amos Mikhael', 'class' => '12 TKJ 2', 'status' => 'Belum Lunas'],
            ['name' => 'Arianto Widodo Putro', 'class' => '12 BiD', 'status' => 'Lunas'],
            ['name' => 'Aricks Wijaya', 'class' => '12 TKJ 1', 'status' => 'Belum Lunas'],
            ['name' => 'Arthur Sebastian Felix', 'class' => '12 TKJ 2', 'status' => 'Lunas'],
            ['name' => 'Audrey Evelyn', 'class' => '12 TKJ 1', 'status' => 'Belum Lunas'],
            ['name' => 'Axelle Questine F. T.', 'class' => '12 TKJ 2', 'status' => 'Lunas'],
            ['name' => 'Billy', 'class' => '12 TKJ 1', 'status' => 'Belum Lunas'],
            ['name' => 'Britania Fisichella', 'class' => '12 TKJ 2', 'status' => 'Lunas'],
            ['name' => 'Charles', 'class' => '12 TKJ 1', 'status' => 'Belum Lunas'],
            ['name' => 'Daniel Riady', 'class' => '12 TKJ 3', 'status' => 'Lunas'],
            ['name' => 'David Aditya Wijaya', 'class' => '12 TKJ 1', 'status' => 'Belum Lunas'],
            ['name' => 'Davin Aurelio Yu', 'class' => '12 AKL', 'status' => 'Lunas'],
            ['name' => 'Eduardo Gunawan', 'class' => '12 TKJ 1', 'status' => 'Belum Lunas'],
            ['name' => 'Edward Cornelius', 'class' => '12 TKJ 2', 'status' => 'Lunas'],
            ['name' => 'Elvan Emmanuel Firdellia', 'class' => '12 TKJ 1', 'status' => 'Belum Lunas'],
            ['name' => 'Enrico Samura', 'class' => '12 BiD', 'status' => 'Lunas'],
            ['name' => 'Ericxander', 'class' => '12 TKJ 1', 'status' => 'Belum Lunas'],
            ['name' => 'Ethan Francis', 'class' => '12 TKJ 2', 'status' => 'Lunas'],
            ['name' => 'Gevin Lionel', 'class' => '12 TKJ 3', 'status' => 'Belum Lunas'],
            ['name' => 'Gracia Queen Anastacia', 'class' => '12 AKL', 'status' => 'Lunas'],
            ['name' => 'Juan Felix Kantoro', 'class' => '12 TKJ 1', 'status' => 'Belum Lunas'],
            ['name' => 'Justin Geraldo', 'class' => '12 TKJ 3', 'status' => 'Lunas'],
            ['name' => 'Louis Chai', 'class' => '12 TKJ 1', 'status' => 'Belum Lunas'],
            ['name' => 'Michael Robert Yandi', 'class' => '12 BiD', 'status' => 'Lunas'],
            ['name' => 'Nicholas Richie Rainhart', 'class' => '12 TKJ 1', 'status' => 'Belum Lunas'],
            ['name' => 'Nichole Angelly', 'class' => '12 TKJ 2', 'status' => 'Lunas'],
            ['name' => 'Ryo Marvel', 'class' => '12 AKL', 'status' => 'Belum Lunas'],
            ['name' => 'Silvio Christian Lim', 'class' => '12 BiD', 'status' => 'Lunas'],
            ['name' => 'Vido Faresky', 'class' => '12 TKJ 1', 'status' => 'Belum Lunas'],
            ['name' => 'Vinno Alvian Chow', 'class' => '12 TKJ 2', 'status' => 'Lunas'],
            ['name' => 'Vincent William', 'class' => '12 TKJ 1', 'status' => 'Belum Lunas'],
            ['name' => 'Virgilio Lawrence', 'class' => '12 TKJ 2', 'status' => 'Lunas'],
            ['name' => 'Yansen', 'class' => '12 TKJ 3', 'status' => 'Belum Lunas'],
        ];

        $methods = ['BCA Virtual Account', 'Transfer Bank', 'Tunai Tata Usaha'];

        foreach ($studentsData as $index => $item) {
            $num = $index + 1;
            $slug = Str::slug($item['name'], '.');

            // Tentukan jurusan otomatis dari nama kelas
            $major = match (true) {
                str_contains($item['class'], 'TKJ') => 'Teknik Komputer dan Jaringan',
                str_contains($item['class'], 'AKL') => 'Akuntansi dan Keuangan Lembaga',
                str_contains($item['class'], 'BiD') => 'Bisnis Digital',
                default => 'Umum',
            };

            // Buat User Siswa
            $user = User::create([
                'name' => $item['name'],
                'email' => $slug . '@ski.sch.id',
                'password' => Hash::make('password'),
                'role' => 'student',
            ]);

            // Buat Profil Student
            $student = Student::create([
                'user_id' => $user->id,
                'nisn' => '0081234' . str_pad((string) $num, 3, '0', STR_PAD_LEFT),
                'nis' => '24' . str_pad((string) $num, 3, '0', STR_PAD_LEFT),
                'class' => $item['class'],
                'major' => $major,
                'school_year' => '2026/2027',
            ]);

            $isLunas = $item['status'] === 'Lunas';

            // Buat Tagihan (Bill) bulan November 2026 sebesar Rp 840.000
            $bill = Bill::create([
                'student_id' => $student->id,
                'month' => 11,
                'school_year' => '2026/2027',
                'amount' => 840000,
                'due_date' => '2026-11-10',
                'status' => $isLunas ? 'paid' : 'unpaid',
            ]);

            // Buat Riwayat Transaksi (Lunas -> verified, sebagian Belum Lunas -> pending)
            if ($isLunas || $num % 3 === 0) {
                $txDate = now()->subDays($num % 15 + 1);

                Transaction::create([
                    'bill_id' => $bill->id,
                    'user_id' => $user->id,
                    'amount' => 840000,
                    'payment_method' => $methods[$index % count($methods)],
                    'transaction_date' => $txDate,
                    'proof_image' => 'images/receipt.png',
                    'status' => $isLunas ? 'verified' : 'pending',
                    'verified_at' => $isLunas ? $txDate->copy()->addHours(2) : null,
                    'note' => $isLunas ? 'Pembayaran terverifikasi' : 'Menunggu verifikasi admin',
                ]);
            }
        }
    }
}