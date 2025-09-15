<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admins
        $admins = [
            [
                'name' => 'Admin User',
                'email' => 'admin@library.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'student_id' => 'ADMIN001',
                'phone' => '1234567890',
                'address' => 'Library Admin Office',
            ],
            [
                'name' => 'Second Admin',
                'email' => 'admin2@library.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'student_id' => 'ADMIN002',
                'phone' => '1234567891',
                'address' => 'Library Admin Office 2',
            ],
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }

        // Students
        $students = [
            [
                'name' => 'Mohamed Ali',
                'email' => 'mohamed@student.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'student_id' => 'STU2024001',
                'phone' => '01011111111',
                'address' => 'Cairo, Egypt',
            ],
            [
                'name' => 'Ahmed Hassan',
                'email' => 'ahmed@student.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'student_id' => 'STU2024002',
                'phone' => '01022222222',
                'address' => 'Alexandria, Egypt',
            ],
            [
                'name' => 'Youssef Sami',
                'email' => 'youssef@student.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'student_id' => 'STU2024003',
                'phone' => '01033333333',
                'address' => 'Giza, Egypt',
            ],
            [
                'name' => 'Omar Mostafa',
                'email' => 'omar@student.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'student_id' => 'STU2024004',
                'phone' => '01044444444',
                'address' => 'Mansoura, Egypt',
            ],
            [
                'name' => 'Karim Mahmoud',
                'email' => 'karim@student.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'student_id' => 'STU2024005',
                'phone' => '01055555555',
                'address' => 'Aswan, Egypt',
            ],
        ];

        foreach ($students as $student) {
            User::create($student);
        }

        
    }
}
