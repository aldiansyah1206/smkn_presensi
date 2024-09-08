<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembina extends Model
{
    use HasFactory;
    
    protected $table = 'pembina'; 
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id', 
        'jenis_kelamin', 
        'no_hp', 
        'alamat'
    ];

    // Mendefinisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function canAddKegiatan()
    {
        return $this->kegiatan()->count() < 2;
    }
    // Mendefinisikan relasi dengan model Kegiatan
    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }
    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
}
