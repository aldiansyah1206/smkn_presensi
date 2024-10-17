<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'presensi';
    protected $fillable = ['siswa_id', 'kegiatan_id', 'tanggal', 'foto_selfie'];
    /**
     * Get the siswa that owns the Presensi.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }


    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

}
