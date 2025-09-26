<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentAcademic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'image_content',
        'date',
        'publish',
        'akademik_id'
    ];

    protected $nullable = [
        'image_content',
    ];

    public function akademik()
    {
        return $this->belongsTo(Akademik::class);
    }
}
