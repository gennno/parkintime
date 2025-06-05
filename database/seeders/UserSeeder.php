<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Insert 1 Admin
        DB::table('user')->insert([
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Ubah jika perlu
            'no_hp' => '081234567890',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert 10 Users
        for ($i = 1; $i <= 10; $i++) {
            DB::table('user')->insert([
                'email' => "user{$i}@example.com",
                'password' => Hash::make('password'), // Default password
                'no_hp' => '0812345678' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
