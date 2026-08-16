<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramWakaf extends Model
{
    use HasFactory;

    protected $table = 'program_wakaf';
    
    protected $fillable = [
        'deskripsi',
    ];

    // Relasi ke sub program
    public function subPrograms()
    {
        return $this->hasMany(SubProgramWakaf::class);
    }
}