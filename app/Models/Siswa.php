<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $guarded = ['id'];
 
    protected $fillable = [
        'user_id',
        'kelas_id',
        'jurusan_id',
        'jenis_kelamin',
        'no_hp',
        'alamat'
    ];

    /**
     * Relasi dengan model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi dengan model Kelas
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    /**
     * Relasi dengan model Jurusan
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * Relasi dengan model Kegiatan
     */
    public function kegiatan()
    {
        return $this->belongsToMany(Kegiatan::class, 'kegiatan_siswa', 'siswa_id', 'kegiatan_id');
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
}
