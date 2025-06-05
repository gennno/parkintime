<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('profil', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('email');
            $table->string('nama_lengkap');
            $table->string('foto')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamps();

            // Add index and foreign key constraint
            $table->foreign('email')->references('email')->on('user')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('profil');
    }
};
