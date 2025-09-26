<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $fillable = [
        'keyword',
        'image_header',
        'category_profile_id',
    ];

    protected $nullable = [
        'image_header',
    ];

    protected $with = ['categoryProfile'];

    public function categoryProfile()
    {
        return $this->belongsTo(CategoryProfile::class);
    }
}
