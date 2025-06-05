<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dompet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('email');
            $table->decimal('balance', 10, 2);
            $table->string('status');
            $table->string('tipe');
            $table->timestamp('datetime');
            $table->timestamps();

            // Add foreign key constraint to no_hp from user table
            $table->foreign('email')->references('email')->on('user')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dompet');
    }
};
