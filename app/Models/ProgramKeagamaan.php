<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKeagamaan extends Model
{
    use HasFactory;

    protected $table = 'program_keagamaan';

    protected $fillable = [
        'deskripsi', // hanya 1 deskripsi utama
    ];

    // Relasi ke banyak sub program
    public function subPrograms()
    {
        return $this->hasMany(SubProgramKeagamaan::class);
    }
}
