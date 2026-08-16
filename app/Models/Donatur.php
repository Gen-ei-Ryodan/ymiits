<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    protected $table = 'donatur';
    
    protected $fillable = [
        'foto1',
        'foto2',
        'foto3',
        'angka_donatur',
    ];
}