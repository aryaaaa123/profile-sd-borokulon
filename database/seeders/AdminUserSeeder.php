<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sdn-borokulon.sch.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'), // ganti setelah login!
                'is_admin' => true,
            ]
        );
    }
}
