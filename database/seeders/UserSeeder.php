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
        if (!User::where('email', 'admin.admin@pustipd.radenfatah.ac.id')->exists()) {
            User::create([
                'name' => 'admin',
                'email' => 'admin.admin@pustipd.radenfatah.ac.id',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);
        }
    }
}
