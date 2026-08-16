<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProgramSosialKeumatan extends Model
{
    use HasFactory;

    protected $table = 'sub_program_sosial_keumatan';

    protected $fillable = [
        'program_sosial_keumatan_id',
        'judul',
        'deskripsi',
        'foto',
    ];

    // Relasi ke program utama
    public function program()
    {
        return $this->belongsTo(ProgramSosialKeumatan::class, 'program_sosial_keumatan_id');
    }
}
