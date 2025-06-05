<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Tiket extends Model
{
    use HasFactory;
    protected $table = 'tiket';

    protected $fillable = [
        'id_user', 'id_slot', 'status', 'waktu_masuk', 'waktu_keluar', 'biaya_total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function slot()
    {
        return $this->belongsTo(SlotParkir::class, 'id_slot');
    }
}