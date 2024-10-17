<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjadwalan extends Model
{
    use HasFactory;
    protected $table = 'penjadwalan';
    protected $fillable = [
        'kegiatan_id',
        'tanggal_mulai',
        'tanggal_selesai',
    ];
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
    
}
