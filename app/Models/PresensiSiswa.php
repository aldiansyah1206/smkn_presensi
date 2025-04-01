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
        'tanggal',
        'waktu'
    ];

      // Relasi ke presensi
      public function presensi()
      {
          return $this->belongsTo(Presensi::class, 'presensi_id');
      }
      // Relasi ke siswa
      public function siswa()
      {
        return $this->belongsTo(Siswa::class, 'siswa_id');
      }
}
