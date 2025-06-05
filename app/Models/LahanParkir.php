<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LahanParkir extends Model
{
        use HasFactory;
    protected $table = 'lahan_parkir';

    protected $fillable = [
        'nama_lokasi', 'alamat', 'foto', 'tarif_per_jam', 'status'
    ];

    public function slotParkir()
    {
        return $this->hasMany(SlotParkir::class, 'id_lahan');
    }
}

