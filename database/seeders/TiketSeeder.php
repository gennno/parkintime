<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Profil;
use App\Models\Kendaraan;
use App\Models\LahanParkir;
use App\Models\SlotParkir;
use App\Models\Tiket;
use DateTime;

class TiketSeeder extends Seeder
{
 public function run()
    {
        $users = User::where('role', 'user')->get();
        $slots = SlotParkir::with('lahan')->get(); // akses tarif_per_jam

        $jumlahData = 200;

        for ($i = 0; $i < $jumlahData; $i++) {
            $user = $users->random();
            $slot = $slots->random();

            // Generate waktu masuk acak tahun 2025
            $bulan = rand(1, 12);
            $hari = rand(1, 28); // amannya sampai 28 untuk semua bulan
            $jam = rand(6, 20); // waktu masuk antar jam 6 pagi - 8 malam
            $menit = rand(0, 59);
            $waktuMasuk = new DateTime("2025-$bulan-$hari $jam:$menit:00");

            $durasi = rand(1, 5); // durasi parkir dalam jam
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
