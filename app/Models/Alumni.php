<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'keyword',
        'image_header',
        'category_alumni_id',
    ];

    protected $nullable = [
        'image_header',
    ];

    protected $with = ['categoryAlumni'];

    public function categoryAlumni()
    {
        return $this->belongsTo(CategoryAlumni::class);
    }
}
