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

        $studentIdentifiers = [
            ['nisn' => '0055134119', 'nis' => '229290'],
            ['nisn' => '0053830997', 'nis' => '235931'],
            ['nisn' => '0056511871', 'nis' => '253667'],
            ['nisn' => '0054872844', 'nis' => '239582'],
            ['nisn' => '0052014965', 'nis' => '225673'],
            ['nisn' => '0051509799', 'nis' => '211734'],
            ['nisn' => '0051805118', 'nis' => '264169'],
            ['nisn' => '0053579348', 'nis' => '278611'],
            ['nisn' => '0054655382', 'nis' => '224483'],
            ['nisn' => '0050414409', 'nis' => '272524'],
            ['nisn' => '0050433666', 'nis' => '218144'],
            ['nisn' => '0052433293', 'nis' => '210438'],
            ['nisn' => '0055681961', 'nis' => '285049'],
            ['nisn' => '0055903504', 'nis' => '235143'],
            ['nisn' => '0055572509', 'nis' => '244650'],
            ['nisn' => '0055410605', 'nis' => '208084'],
            ['nisn' => '0058022195', 'nis' => '277692'],
            ['nisn' => '0051063423', 'nis' => '267906'],
            ['nisn' => '0058246370', 'nis' => '215086'],
            ['nisn' => '0059966823', 'nis' => '293797'],
            ['nisn' => '0054533390', 'nis' => '235480'],
            ['nisn' => '0053993320', 'nis' => '237667'],
            ['nisn' => '0058521108', 'nis' => '298071'],
            ['nisn' => '0058384757', 'nis' => '214245'],
            ['nisn' => '0055756563', 'nis' => '262244'],
            ['nisn' => '0058215325', 'nis' => '263144'],
            ['nisn' => '0054820128', 'nis' => '270583'],
            ['nisn' => '0052247145', 'nis' => '221962'],
            ['nisn' => '0055795357', 'nis' => '296827'],
            ['nisn' => '0056209696', 'nis' => '274484'],
            ['nisn' => '0051365786', 'nis' => '285334'],
            ['nisn' => '0050034306', 'nis' => '263040'],
            ['nisn' => '0056319941', 'nis' => '233599'],
            ['nisn' => '0056074979', 'nis' => '279088'],
            ['nisn' => '0053745793', 'nis' => '294412'],
        ];

        $unpaidStudentIndexesByMonth = [
            7 => [4, 17, 21, 26, 27],
            8 => [0, 12, 14, 19, 21, 30],
            9 => [5, 6, 7, 16, 20, 22, 28],
            10 => [2, 4, 10, 12, 27, 29],
            11 => [2, 4, 5, 6, 7, 9, 11, 12, 14, 15, 16, 21, 23, 24, 25, 27, 30, 34],
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
            $studentIdentifier = $studentIdentifiers[$index];
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
                    'nisn' => $studentIdentifier['nisn'],
                    'nis' => $studentIdentifier['nis'],
                    'class' => $class,
                    'major' => $major,
                    'school_year' => '2026/2027',
                ]
            );

            $bills = $this->createAcademicYearBills($student, $index, $unpaidStudentIndexesByMonth);
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
     * @param  array<int, array<int, int>>  $unpaidStudentIndexesByMonth
     * @return array<int, Bill>
     */
    private function createAcademicYearBills(Student $student, int $studentIndex, array $unpaidStudentIndexesByMonth): array
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

        $allStudentIndexes = range(0, 34);
        $bills = [];

        foreach ($billingPeriods as $period) {
            $unpaidStudentIndexes = $unpaidStudentIndexesByMonth[$period['month']] ?? $allStudentIndexes;
            $status = in_array($studentIndex, $unpaidStudentIndexes, true) ? 'unpaid' : 'paid';

            if ($period['month'] === 12 || $period['month'] <= 6) {
                $status = 'unpaid';
            }

            $bills[$period['month']] = Bill::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'month' => $period['month'],
                    'school_year' => $schoolYear,
                ],
                [
                    'amount' => 840000,
                    'due_date' => sprintf('%04d-%02d-15', $period['calendar_year'], $period['month']),
                    'status' => $status,
                ]
            );
        }

        return $bills;
    }
}
