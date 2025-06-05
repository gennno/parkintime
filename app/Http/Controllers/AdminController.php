<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\LahanParkir;
use Illuminate\Support\Facades\DB;
use App\Models\Kendaraan;

class AdminController extends Controller
{
    // Menampilkan daftar semua user
    public function index()
    {
        $jumlahPengguna=DB::table('user')->count();
        $users = User::all(); // Ambil semua data user
        return view('daftar-pengguna', compact('users','jumlahPengguna')); // Kirim ke view 'users/index.blade.php'
    }

    // Menampilkan detail user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Edit user (tampilan form)
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Update user (simpan hasil edit)
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'role' => 'required|string',
        ]);

        $user->update($request->only(['name', 'email', 'phone', 'role']));

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    // Data lahan parkir
    public function lahan()
{
    $lahanParkir = LahanParkir::all();
    $jumlahlahan=DB::table('lahan_parkir')->count();
    return view('data-lahan-parkir', compact('lahanParkir','jumlahlahan'));
}
public function lahandetail()
{
    $lahanParkir = LahanParkir::all();
    return view('detail-lahan-parkir', compact('lahanParkir'));
}
public function kendaraan()
{
    $kendaraan = Kendaraan::all();
    
        $jumlahkendaraan=DB::table('kendaraan')->count();
    return view('data-kendaraan', compact('kendaraan','jumlahkendaraan'));
}

}
