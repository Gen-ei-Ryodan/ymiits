<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaManfaat extends Model
{
    use HasFactory;

    protected $table = 'penerima_manfaat';
    
    protected $fillable = [
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'foto5',
        'foto6',
    ];
}