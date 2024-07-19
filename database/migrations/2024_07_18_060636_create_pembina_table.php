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
        Schema::create('pembina', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('kegiatan_id');
            $table->enum('jenis_kelamin', ["p", "l"]);
            $table->string('no_hp')->nullable();
            $table->string('image')->nullable();
            $table->string('alamat');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('kegiatan_id')->references('id')->on('kegiatan')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembina');
    }
};
