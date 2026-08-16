<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramSosialPendidikan extends Model
{
    use HasFactory;

    protected $table = 'program_sosial_pendidikan';
    
    protected $fillable = [
        'deskripsi',
    ];

    // Relasi ke sub program
    public function subPrograms()
    {
        return $this->hasMany(SubProgramSosialPendidikan::class);
    }
}