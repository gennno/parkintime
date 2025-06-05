<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
        use HasFactory;
    protected $table = 'profil';

    protected $fillable = [
        'id_user', 'email', 'nama_lengkap', 'foto', 'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
