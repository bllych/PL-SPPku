<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $title = "SPPku - Halaman Admin";
                $students = [
            [
                'id' => 1,
                'name' => 'Alfredy Rudi',
                'class' => '12 TKJ 1',
                'tagihan' => 'Rp. 840.000,00',
                'status' => 'Belum Lunas'

            ],
            [
                'id' => 2,
                'name' => 'Alice Holly Kristy',
                'class' => '12 AKL',
                'tuition' => 'Rp. 840.000,00',
                'status' => 'Lunas'            
            ],
            [
                'id' => 3,
                'name' => 'Amos Mikhael',
                'class' => '12 TKJ 2',
                'tuition' => 'Rp. 840.000,00',
                'status' => 'Belum Lunas'
            ],
            [
                'id' => 4,
                'name' => 'Arianto Widodo Putro',
                'class' => '12 BiD',
                'tuition' => 'Rp. 840.000,00',
                'status' => 'Lunas'
            ],
            [
                'id' => 5,
                'name' => 'Aricks Wijaya',
                'class' => '12 TKJ 1',
                'tuition' => 'Rp. 840.000,00',
                'status' => 'Belum Lunas'
            ],
            [
                'id' => 6,
                'name' => 'Arthur Sebastian Felix',
                'class' => '12 TKJ 2',
                'tuition' => 'Rp. 840.000,00',
                'status' => 'Lunas'
            ],
            [
                'id' => 7,
                'name' => 'Audrey Evelyn',
                'class' => '12 TKJ 1',
                'tuition' => 'Rp. 840.000,00',
                'status' => 'Belum Lunas'
            ],
            [
                'id' => 8,
                'name' => 'Axelle Questine F. T.',
                'class' => '12 TKJ 2',
                'tuition' => 'Rp. 840.000,00',
                'status' => 'Lunas'
            ],
            [
                'id' => 9,
                'name' => 'Billy',
                'class' => '12 TKJ 1',
                'tuition' => 'Rp. 840.000,00',
                'status' => 'Belum Lunas'
            ],
            [
                'id' => 10,
                'name' => 'Britania Fisichella',
                'class' => '12 TKJ 2',
                'tuition' => 'Rp. 840.000,00',
                'status' => 'Lunas'
            ],
            [
                'id' => 11,
                'name' => 'Charles',
                'class' => '12 TKJ 1',
                'tuition' => 'Rp. 840.000,00',
                'status' => 'Belum Lunas'
            ],
            [
                'id' => 12,
                'name' => 'Daniel Riady',
                'class' => '12 TKJ 3',
                'tuition' => 'Rp. 840.000,00',
                'status' => 'Lunas'
            ],
            [
                'id' => 13,
                'name' => 'David Aditya Wijaya',
                'class' => '12 TKJ 1',
                'tuition' => 'Rp. 840.000,00',
                'status' => 'Belum Lunas'
            ],
            [
                'id' => 14,
                'name' => 'Davin Aurelio Yu',
                'class' => '12 AKL',
                'tuition' => 'Rp. 840.000,00',
                'status' => 'Lunas'
            ],
            [
                'id' => 15,
                'name' => 'Eduardo Gunawan',
                'class' => '12 TKJ 1',
                'tuition' => 'Rp. 840.000,00',
                'status' => 'Belum Lunas'
            ],
            [
                'id' => 16,
                'name' => "Edward Cornelius",
                "class" => "12 TKJ 2",
                "tuition" => "Rp. 840.000,00",
                "status" => "Lunas"
            ],
            [
                'id' => 17,
                'name' => "Elvan Emmanuel Firdellia",
                "class" => "12 TKJ 1",
                "tuition" => "Rp. 840.000,00",
                "status" => "Belum Lunas"
            ],
            [
                'id' => 18,
                'name' => "Enrico Samura",
                "class" => "12 BiD",
                "tuition" => "Rp. 840.000,00",
                "status" => "Lunas"
            ],
            [
                'id' => 19,
                'name' => "Ericxander",
                "class" => "12 TKJ 1",
                "tuition" => "Rp. 840.000,00",
                "status" => "Belum Lunas"
            ],
            [
                'id' => 20,
                'name' => "Ethan Francis",
                "class" => "12 TKJ 2",
                "tuition" => "Rp. 840.000,00",
                "status" => "Lunas"
            ],
            [
                'id' => 21,
                'name' => "Gevin Lionel",
                "class" => "12 TKJ 3",
                "tuition" => "Rp. 840.000,00",
                "status" => "Belum Lunas"
            ],
            [
                'id' => 22,
                'name' => "Gracia Queen Anastacia",
                "class" => "12 AKL",
                "tuition" => "Rp. 840.000,00",
                "status" => "Lunas"
            ],
            [
                'id' => 23,
                'name' => "Juan Felix Kantoro",
                "class" => "12 TKJ 1",
                "tuition" => "Rp. 840.000,00",
                "status" => "Belum Lunas"
            ],
            [
                'id' => 24,
                'name' => "Justin Geraldo",
                "class" => "12 TKJ 3",
                "tuition" => "Rp. 840.000,00",
                "status" => "Lunas"
            ],
            [
                'id' => 25,
                'name' => "Louis Chai",
                "class" => "12 TKJ 1",
                "tuition" => "Rp. 840.000,00",
                "status" => "Belum Lunas"
            ],
            [
                'id' => 26,
                'name' => "Michael Robert Yandi",
                "class" => "12 BiD",
                "tuition" => "Rp. 840.000,00",
                "status" => "Lunas"
            ],
            [
                'id' => 27,
                'name' => "Nicholas Richie Rainhart",
                "class" => "12 TKJ 1",
                "tuition" => "Rp. 840.000,00",
                "status" => "Belum Lunas"
            ],
            [
                'id' => 28,
                'name' => "Nichole Angelly",
                "class" => "12 TKJ 2",
                "tuition" => "Rp. 840.000,00",
                "status" => "Lunas"
            ],
            [
                'id' => 29,
                'name' => "Ryo Marvel",
                "class" => "12 AKL",
                "tuition" => "Rp. 840.000,00",
                "status" => "Belum Lunas"
            ],
            [
                'id' => 30,
                'name' => "Silvio Christian Lim",
                "class" => "12 BiD",
                "tuition" => "Rp. 840.000,00",
                "status" => "Lunas"
            ],
            [
                'id' => 31,
                'name' => "Vido Faresky",
                "class" => "12 TKJ 1",
                "tuition" => "Rp. 840.000,00",
                "status" => "Belum Lunas"
            ],
            [
                'id' => 32,
                'name' => "Vinno Alvian Chow",
                "class" => "12 TKJ 2",
                "tuition" => "Rp. 840.000,00",
                "status" => "Lunas"
            ],
            [
                'id' => 33,
                'name' => "Vincent William",
                "class" => "12 TKJ 1",
                "tuition" => "Rp. 840.000,00",
                "status" => "Belum Lunas"
            ],
            [
                'id' => 34,
                'name' => "Virgilio Lawrence",
                "class" => "12 TKJ 2",
                "tuition" => "Rp. 840.000,00",
                "status" => "Lunas"
            ],
            [
                'id' => 35,
                'name' => "Yansen",
                "class" => "12 TKJ 3",
                "tuition" => "Rp. 840.000,00",
                "status" => "Belum Lunas"
            ]
        ];
        return view('Admin.index', compact('title', 'students'));
    }

    public function payments()
    {
        $title = "SPPku - Halaman Laporan Pembayaran Admin";
        return view('Admin.payments', compact('title'));
    }

    public function notification()
    {
        $title = "SPPku - Halaman Notifikasi Admin";
        return view('Admin.notification', compact('title'));
    }

    public function show()
    {
        $title = "SPPku - Halaman Profile Admin";
        return view('Admin.show', compact('title'));
    }

    public function dashboard()
    {
        $title = "SPPku - Halaman Dashboard Admin";
        return view('Admin.dashboard', compact('title'));
    }
}
