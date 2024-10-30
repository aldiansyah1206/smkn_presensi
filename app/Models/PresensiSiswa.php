<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiSiswa extends Model
{
    use HasFactory;
    protected $table = 'presensi_siswa';
    protected $fillable = [
        'presensi_id',  
        'siswa_id',  
        'foto_selfie', 
        'status'
    ];

      // Relasi ke presensi
      public function presensi()
      {
          return $this->belongsTo(Presensi::class);
      }
      // Relasi ke siswa
      public function siswa()
      {
          return $this->belongsTo(User::class, 'siswa_id');
      }
}
