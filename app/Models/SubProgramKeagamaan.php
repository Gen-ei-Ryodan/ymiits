<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProgramKeagamaan extends Model
{
    use HasFactory;

    protected $table = 'sub_program_keagamaan';

    protected $fillable = [
        'program_keagamaan_id',
        'judul',
        'deskripsi',
        'foto',
    ];

    // Relasi balik ke program keagamaan utama
    public function program()
    {
        return $this->belongsTo(ProgramKeagamaan::class, 'program_keagamaan_id');
    }
}
