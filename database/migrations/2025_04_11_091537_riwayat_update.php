<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('riwayat_update', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dompet');
            $table->string('status');
            $table->string('deskripsi');
            $table->decimal('jumlah', 10, 2);
            $table->timestamp('datetime');
            $table->timestamps();

            $table->foreign('id_dompet')->references('id')->on('dompet')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayat_update');
    }
};
