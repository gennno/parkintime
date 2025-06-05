<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotParkir extends Model
{
        use HasFactory;
    protected $table = 'slot_parkir';

    protected $fillable = [
        'id_lahan', 'kode_slot', 'jenis', 'status'
    ];

    public function lahan()
    {
        return $this->belongsTo(LahanParkir::class, 'id_lahan');
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class, 'id_slot');
    }
}
