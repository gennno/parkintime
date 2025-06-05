<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LahanParkirSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lahan_parkir')->insert([
            [
                'nama_lokasi'   => 'Parkiran Mall A',
                'alamat'        => 'Jl. Raya Sudirman No. 123, Jakarta',
                'foto'          => null,
                'tarif_per_jam' => 5000.00,
                'status'        => 'aktif',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'nama_lokasi'   => 'Parkiran Kantor B',
                'alamat'        => 'Jl. Gatot Subroto No. 88, Bandung',
                'foto'          => null,
                'tarif_per_jam' => 4000.00,
                'status'        => 'aktif',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'nama_lokasi'   => 'Parkiran Stasiun C',
                'alamat'        => 'Jl. Pemuda No. 10, Surabaya',
                'foto'          => null,
                'tarif_per_jam' => 3000.00,
                'status'        => 'tidak aktif',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]
        ]);
    }
}
