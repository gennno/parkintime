<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dompet extends Model
{
    use HasFactory;

    protected $fillable = ['id_akun', 'email', 'balance', 'status', 'tipe', 'datetime'];

    // Relationships
    public function akun()
    {
        return $this->belongsTo(Akun::class, 'id_akun');
    }

    public function riwayatUpdate()
    {
        return $this->hasMany(RiwayatUpdate::class, 'id_dompet');
    }
}
