<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $fillable = [
        'keyword',
        'image_header',
        'category_berita_id',
    ];

    protected $nullable = [
        'image_header',
    ];

    protected $with = ['categoryBerita'];

    public function categoryBerita()
    {
        return $this->belongsTo(CategoryBerita::class);
    }
}
