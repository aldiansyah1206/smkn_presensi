<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presensi_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('presensi_id'); 
            $table->unsignedBigInteger('siswa_id'); 
            $table->string('foto_selfie'); 
            $table->date('tanggal');  
            $table->time('waktu')->nullable();  
            $table->timestamps();
            $table->foreign('presensi_id')->references('id')->on('presensi')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_siswa');
    }
};
