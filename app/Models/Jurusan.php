<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    
    protected $table = 'jurusan';
    protected $guarded = ['id'];
    protected $fillable = ["name"];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'siswa_id');
    }
    
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
