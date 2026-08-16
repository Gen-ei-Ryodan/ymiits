<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKemanusiaan extends Model
{
    use HasFactory;

    protected $table = 'program_kemanusiaan';
    
    protected $fillable = [
        'deskripsi',
    ];

    // Relasi ke sub program
    public function subPrograms()
    {
        return $this->hasMany(SubProgramKemanusiaan::class);
    }
}