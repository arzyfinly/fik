<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentAlumni extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'image_content',
        'date',
        'publish',
        'alumni_id'
    ];

    protected $nullable = [
        'image_content',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
