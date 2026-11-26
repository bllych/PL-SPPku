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
        User::updateOrCreate(
            ['email' => 'admin@ski.sch.id'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        $studentsData = [
            'Alfredy Rudi',
            'Alice Holly Kristy',
            'Amos Mikhael',
            'Arianto Widodo Putro',
            'Aricks Wijaya',
            'Arthur Sebastian Felix',
            'Audrey Evelyn',
            'Axelle Questine F. T.',
            'Billy',
            'Britania Fisichella',
            'Charles',
            'Daniel Riady',
            'David Aditya Wijaya',
            'Davin Aurelio Yu',
            'Eduardo Gunawan',
            'Edward Cornelius',
            'Elvan Emmanuel Firdellia',
            'Enrico Samura',
            'Ericxander',
            'Ethan Francis',
            'Gevin Lionel',
            'Gracia Queen Anastacia',
            'Juan Felix Kantoro',
            'Justin Geraldo',
            'Louis Chai',
            'Michael Robert Yandi',
            'Nicholas Richie Rainhart',
            'Nichole Angelly',
            'Ryo Marvel',
            'Silvio Christian Lim',
            'Vido Faresky',
            'Vinno Alvian Chow',
            'Vincent William',
            'Virgilio Lawrence',
            'Yansen',
        ];

        $classAssignments = [
            '12 TKJ 1', '12 TKJ 1', '12 TKJ 2', '12 TKJ 2', '12 TKJ 2',
            '12 BiD', '12 TKJ 3', '12 TKJ 2', '12 BiD', '12 TKJ 2',
            '12 AKL', '12 TKJ 3', '12 TKJ 3', '12 AKL', '12 TKJ 1',
            '12 TKJ 3', '12 TKJ 1', '12 TKJ 2', '12 BiD', '12 BiD',
            '12 TKJ 3', '12 AKL', '12 AKL', '12 TKJ 3', '12 BiD',
            '12 TKJ 3', '12 TKJ 1', '12 BiD', '12 TKJ 2', '12 BiD',
            '12 AKL', '12 AKL', '12 TKJ 1', '12 AKL', '12 TKJ 1',
        ];

        // Menentukan bulan mulai menunggak per siswa (7=Jul, 8=Agu, 9=Sep, 10=Okt, 11=Nov).
        // Semua bulan sebelum bulan tunggakan pertama otomatis berstatus paid (lunas kronologis).
        // Siswa yang tidak masuk daftar ini berarti lunas penuh dari Juli s/d November.
        $firstUnpaidMonthByStudent = [
            4 => 7, 17 => 7, 21 => 7, 26 => 7, 27 => 7,                         // Menunggak sejak Juli
            0 => 8, 12 => 8, 14 => 8, 19 => 8, 30 => 8,                         // Lunas Jul, menunggak sejak Agustus
            5 => 9, 6 => 9, 7 => 9, 16 => 9, 20 => 9, 22 => 9, 28 => 9,         // Lunas Jul-Agu, menunggak sejak September
            2 => 10, 10 => 10, 29 => 10,                                        // Lunas Jul-Sep, menunggak sejak Oktober
            9 => 11, 11 => 11, 15 => 11, 23 => 11, 24 => 11, 25 => 11, 34 => 11, // Lunas Jul-Okt, belum bayar November
        ];

        $pendingNovemberIndexes = [6, 9, 11, 15, 21, 25];
        $rejectedNovemberIndexes = [16, 24];
        $paymentMethods = ['BCA Virtual Account', 'Transfer Bank', 'Tunai Tata Usaha'];
        $seededTransactionNotes = [
            'Pembayaran terverifikasi',
            'Menunggu verifikasi admin',
            'Seeder demo: pembayaran terverifikasi',
            'Seeder demo: menunggu verifikasi',
            'Seeder demo: transaksi ditolak',
        ];

        foreach ($studentsData as $index => $studentName) {
            $class = $classAssignments[$index];
            $nisn = sprintf('005%07d', ($index + 1) * 197351 % 10000000);
            $nis  = sprintf('2%05d', ($index + 1) * 2791 % 100000);
            $slug = Str::slug($studentName, '.');
            $major = match (true) {
                str_contains($class, 'TKJ') => 'Teknik Komputer dan Jaringan',
                str_contains($class, 'AKL') => 'Akuntansi dan Keuangan Lembaga',
                str_contains($class, 'BiD') => 'Bisnis Digital',
                default => 'Umum',
            };

            $user = User::updateOrCreate(
                ['email' => $slug.'@ski.sch.id'],
                [
                    'name' => $studentName,
                    'password' => Hash::make('password'),
                    'role' => 'student',
                ]
            );

            $student = Student::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nisn'        => $nisn,
                    'nis'         => $nis,
                    'class'       => $class,
                    'major'       => $major,
                    'school_year' => '2026/2027',
                ]
            );

            $bills = $this->createAcademicYearBills($student, $index, $firstUnpaidMonthByStudent);
            $billIds = array_map(static fn (Bill $bill): int => $bill->id, $bills);

            Transaction::query()
                ->whereIn('bill_id', $billIds)
                ->whereIn('note', $seededTransactionNotes)
                ->delete();

            foreach ($bills as $month => $bill) {
                $transactionStatus = match (true) {
                    $bill->status === 'paid' => 'verified',
                    $month === 11 && in_array($index, $pendingNovemberIndexes, true) => 'pending',
                    $month === 11 && in_array($index, $rejectedNovemberIndexes, true) => 'rejected',
                    default => null,
                };

                if ($transactionStatus === null) {
                    continue;
                }

                $transactionDate = $bill->due_date->copy();

                if ($transactionStatus === 'verified') {
                    $transactionDate->subDays(($index + $month) % 10 + 1);
                } else {
                    $transactionDate->addDays(($index + $month) % 4 + 1);
                }

                $transactionDate->setTime(9 + ($index % 8), ($index * 11 + $month) % 60);
                $methodIndex = match ($transactionStatus) {
                    'pending' => array_search($index, $pendingNovemberIndexes, true) % count($paymentMethods),
                    'rejected' => $index % count($paymentMethods),
                    default => ($index + $month) % count($paymentMethods),
                };

                Transaction::updateOrCreate(
                    ['bill_id' => $bill->id],
                    [
                        'user_id' => $user->id,
                        'amount' => $bill->amount,
                        'payment_method' => $paymentMethods[$methodIndex],
                        'transaction_date' => $transactionDate,
                        'proof_image' => 'images/receipt.png',
                        'status' => $transactionStatus,
                        'verified_at' => $transactionStatus === 'verified'
                            ? $transactionDate->copy()->addHours(($index % 2) + 1)
                            : null,
                        'note' => match ($transactionStatus) {
                            'verified' => 'Seeder demo: pembayaran terverifikasi',
                            'pending' => 'Seeder demo: menunggu verifikasi',
                            'rejected' => 'Seeder demo: transaksi ditolak',
                        },
                    ]
                );
            }
        }
    }

    /**
     * @param  array<int, int>  $firstUnpaidMonthByStudent
     * @return array<int, Bill>
     */
    private function createAcademicYearBills(Student $student, int $studentIndex, array $firstUnpaidMonthByStudent): array
    {
        $schoolYear = '2026/2027';
        $billingPeriods = [];

        foreach (range(7, 12) as $month) {
            $billingPeriods[] = [
                'month' => $month,
                'calendar_year' => 2026,
            ];
        }

        foreach (range(1, 6) as $month) {
            $billingPeriods[] = [
                'month' => $month,
                'calendar_year' => 2027,
            ];
        }

        // Default: lunas sampai November (mulai unpaid di bulan 12 / Desember)
        $firstUnpaidMonth = $firstUnpaidMonthByStudent[$studentIndex] ?? 12;
        $bills = [];

        foreach ($billingPeriods as $period) {
            $month = $period['month'];

            // Bulan 7..11: lunas jika < $firstUnpaidMonth. Bulan 12 & 1..6 (Genap): selalu unpaid.
            if ($month >= 7 && $month <= 11) {
                $status = $month < $firstUnpaidMonth ? 'paid' : 'unpaid';
            } else {
                $status = 'unpaid';
            }

            $bills[$month] = Bill::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'month' => $month,
                    'school_year' => $schoolYear,
                ],
                [
                    'amount' => 840000,
                    'due_date' => sprintf('%04d-%02d-15', $period['calendar_year'], $month),
                    'status' => $status,
                ]
            );
        }

        return $bills;
    }
}