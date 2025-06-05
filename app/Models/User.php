<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasFactory; 

    protected $table = 'user';

    protected $fillable = [
        'email', 'password', 'no_hp', 'role', 'datetime'
    ];

    protected $hidden = [
        'password',
    ];

    public function profil()
    {
        return $this->hasOne(Profil::class, 'id_user');
    }

    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class, 'id_user');
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class, 'id_user');
    }
}

