<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'image',
        'author',
        'source_id',
        'external_id',
        'url',
        'published_at'
    ];

    /**
     * Get the source of the news
     */
    public function source()
    {
        return $this->belongsTo(NewsSource::class, 'source_id');
    }
}