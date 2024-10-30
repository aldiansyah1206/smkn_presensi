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
        'status'
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
        return $this->belongsTo(Siswa::class);
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function presensiSiswa()
    {
        return $this->hasMany(PresensiSiswa::class);
    }
}
