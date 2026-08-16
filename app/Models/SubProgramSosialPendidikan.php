<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProgramSosialPendidikan extends Model
{
    use HasFactory;

    protected $table = 'sub_program_sosial_pendidikan';

    protected $fillable = [
        'program_sosial_pendidikan_id',
        'judul',
        'deskripsi',
        'foto',
    ];

    // Relasi ke program utama
    public function program()
    {
        return $this->belongsTo(ProgramSosialPendidikan::class, 'program_sosial_pendidikan_id');
    }
}
