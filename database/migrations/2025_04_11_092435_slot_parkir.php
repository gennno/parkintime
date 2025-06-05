<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('slot_parkir', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lahan');
            $table->string('kode_slot');
            $table->string('jenis'); // paid / free
            $table->string('status'); // kosong / terisi
            $table->timestamps();

            $table->foreign('id_lahan')->references('id')->on('lahan_parkir')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('slot_parkir');
    }
};
