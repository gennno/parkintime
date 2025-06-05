<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Profil;
use App\Models\Kendaraan;
use App\Models\LahanParkir;
use App\Models\SlotParkir;
use App\Models\Tiket;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Superadmin
        $superadmin = User::create([
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'no_hp' => '0811111111',
            'role' => 'superadmin',
            'datetime' => now()
        ]);

        // Admin
        $admin = User::create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'no_hp' => '0822222222',
            'role' => 'admin',
            'datetime' => now()
        ]);

        // 10 User dengan profil dan kendaraan
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'email' => "user{$i}@example.com",
                'password' => Hash::make('password'),
                'no_hp' => '08' . rand(1000000000, 9999999999),
                'role' => 'user',
                'datetime' => now()
            ]);

            Profil::create([
                'id_user' => $user->id,
                'email' => $user->email,
                'nama_lengkap' => fake()->name(),
                'foto' => null,
                'alamat' => fake()->address(),
            ]);

            $kendaraanCount = rand(1, 2);
            for ($j = 0; $j < $kendaraanCount; $j++) {
                Kendaraan::create([
                    'id_user' => $user->id,
                    'no_kendaraan' => strtoupper(fake()->bothify('B #### ??')),
                    'brand' => fake()->company(),
                    'year' => fake()->year(),
                    'model' => fake()->word(),
                    'colour' => fake()->safeColorName(),
                    'status' => 'aktif',
                ]);
            }
        }

        // 5 Lahan Parkir dan masing-masing 10 slot
        for ($i = 1; $i <= 5; $i++) {
            $lahan = LahanParkir::create([
                'nama_lokasi' => 'Parkiran ' . $i,
                'alamat' => fake()->address(),
                'foto' => null,
                'tarif_per_jam' => fake()->randomFloat(2, 3000, 10000),
                'status' => 'aktif',
            ]);

            for ($j = 1; $j <= 10; $j++) {
                SlotParkir::create([
                    'id_lahan' => $lahan->id,
                    'kode_slot' => 'S' . str_pad($j, 2, '0', STR_PAD_LEFT),
                    'jenis' => fake()->randomElement(['paid', 'free']),
                    'status' => 'kosong',
                ]);
            }
        }

        // Tiket parkir acak
        $users = User::where('role', 'user')->get();
        $slots = SlotParkir::with('lahan')->get(); // penting: with('lahan') untuk akses tarif

        foreach ($users as $user) {
            $repeat = rand(3, 6);
            for ($i = 0; $i < $repeat; $i++) {
                $slot = $slots->random();
                $waktuMasuk = fake()->dateTimeBetween('-30 days', '-1 days');
                $durasi = rand(1, 5);
                $waktuKeluar = (clone $waktuMasuk)->modify("+{$durasi} hours");

                Tiket::create([
                    'id_user' => $user->id,
                    'id_slot' => $slot->id,
                    'status' => 'selesai',
                    'waktu_masuk' => $waktuMasuk,
                    'waktu_keluar' => $waktuKeluar,
                    'biaya_total' => $durasi * $slot->lahan->tarif_per_jam,
                ]);
            }
        }
    }
}
