<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentBerita extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'content',
        'image_content',
        'date',
        'publish',
        'berita_id'
    ];

    protected $nullable = [
        'image_content',
    ];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}
