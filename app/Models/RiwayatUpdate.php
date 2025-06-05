<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatUpdate extends Model
{
    use HasFactory;
    protected $fillable = ['id_dompet', 'status', 'deskripsi', 'jumlah', 'datetime'];

    // Relationships
    public function dompet()
    {
        return $this->belongsTo(Dompet::class, 'id_dompet');
    }
}

