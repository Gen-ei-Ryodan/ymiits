<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProgramWakaf extends Model
{
    use HasFactory;

    protected $table = 'sub_program_wakaf';

    protected $fillable = [
        'program_wakaf_id',
        'judul',
        'deskripsi',
        'foto',
    ];

    // Relasi ke program utama
    public function program()
    {
        return $this->belongsTo(ProgramWakaf::class, 'program_wakaf_id');
    }
}
