<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
        use HasFactory;
    protected $table = 'kendaraan';

    protected $fillable = [
        'id_user', 'no_kendaraan', 'brand', 'year', 'model', 'colour', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

