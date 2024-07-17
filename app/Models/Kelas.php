<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $guarded = ['id'];
    protected $fillable = ["name"];

    
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'siswa_id');
    }
    public function jurusan()
    {
        return $this->hasMany(Jurusan::class, 'jurusan_id');
    }
}
