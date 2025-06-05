<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Tiket;
use App\Models\LahanParkir;
use App\Models\SlotParkir;

class DashboardController extends Controller {
    public function index() {
        $jumlahPengguna=DB::table('user')->count();
        $jumlahlahan=DB::table('lahan_parkir')->count();
        $jumlahkendaraan=DB::table('kendaraan')->count();
        $jumlahtiket=DB::table('tiket')->count();
        $totalSpot = DB::table('slot_parkir')->count();
        $vipSpot = DB::table('slot_parkir')
        ->where('jenis', 'paid') // sesuaikan dengan nama kolom & isi sebenarnya
        ->count();
        $regularSpot = $totalSpot - $vipSpot;

$tahunIni = date('Y');
// Ambil data tiket per bulan untuk tahun ini
$jumlahTiketBulanan = DB::table('tiket')
    ->selectRaw('MONTH(waktu_keluar) as bulan, COUNT(*) as jumlah')
    ->whereYear('waktu_keluar', $tahunIni)
    ->groupBy('bulan')
    ->orderBy('bulan')
    ->pluck('jumlah', 'bulan')
    ->toArray();

     // Hitung rata-rata durasi per lahan
    $rataDurasiPerLahan = LahanParkir::with('slotParkir.tiket')
        ->get()
        ->mapWithKeys(function ($lahan) {
            $durasiJam = 0;
            $jumlahTiket = 0;

            foreach ($lahan->slotParkir as $slot) {
                foreach ($slot->tiket as $tiket) {
                    if ($tiket->waktu_keluar && $tiket->waktu_masuk) {
                        $durasi = strtotime($tiket->waktu_keluar) - strtotime($tiket->waktu_masuk);
                        $durasiJam += $durasi / 3600; // dalam jam
                        $jumlahTiket++;
                    }
                }
            }

            $rata = $jumlahTiket > 0 ? round($durasiJam / $jumlahTiket, 2) : 0;
            return [$lahan->nama_lokasi => $rata];
        });

    // Total spot per lahan
    $spotPerLahan = LahanParkir::withCount('slotParkir')
        ->get()
        ->mapWithKeys(function ($lahan) {
            return [$lahan->nama_lokasi => $lahan->slot_parkir_count];
        });



        return view('dashboard-admin', compact('jumlahPengguna',
                'jumlahlahan',
                'jumlahkendaraan',
                'jumlahtiket',
                'vipSpot',
                'regularSpot',
                'jumlahTiketBulanan', 
                'tahunIni',
                'totalSpot',
        'rataDurasiPerLahan',
        'spotPerLahan'
            ));

    }
}
