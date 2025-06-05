<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lahan_parkir', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi');
            $table->string('alamat');
            $table->string('foto')->nullable();
            $table->decimal('tarif_per_jam', 8, 2);
            $table->string('status'); // aktif / tidak aktif
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lahan_parkir');
    }
};