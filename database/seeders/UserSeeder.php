<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'name' => 'admin',
            'email' => 'admin.admin@pustipd.radenfatah.ac.id',
            'password' => Hash::make('pustipd12345'), // Ganti dengan password yang diinginkan
            'role' => 'admin', // Ganti dengan role yang diinginkan
            ]
        );
    }
}
