<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'presensi';
    protected $fillable = [
        'pembina_id',  
        'kegiatan_id', 
        'tanggal',
    ];
    /**
     *
     */
    public function pembina()
    {
        return $this->belongsTo(Pembina::class);
    }
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'presensi_siswa')
        ->withPivot('foto_selfie', 'tanggal', 'waktu')
        ->withTimestamps();
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }

    public function presensiSiswa()
    {
        return $this->hasMany(PresensiSiswa::class);
    }
}
