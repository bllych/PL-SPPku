<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan import model User

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name'=>'Billy', 'email'=>'billy@admin.example', 'password'=>bcrypt('87654321'), 'role'=>'admin'],
            ['name'=>'Britan', 'email'=>'britania@student.example', 'password'=>bcrypt('12345678'), 'role'=>'student'],
        ];
    }
}
