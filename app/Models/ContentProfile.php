<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'image_content',
        'date',
        'publish',
        'profil_id'
    ];

    protected $nullable = [
        'image_content',
    ];

    protected $with = ['profil'];

    public function profil()
    {
        return $this->belongsTo(Profil::class);
    }
}
