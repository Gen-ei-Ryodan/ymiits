<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProgramKemanusiaan extends Model
{
    use HasFactory;

    protected $table = 'sub_program_kemanusiaan';

    protected $fillable = [
        'program_kemanusiaan_id',
        'judul',
        'deskripsi',
        'foto',
    ];

    // Relasi ke program utama
    public function program()
    {
        return $this->belongsTo(ProgramKemanusiaan::class, 'program_kemanusiaan_id');
    }
}
