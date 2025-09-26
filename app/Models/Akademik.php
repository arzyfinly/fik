<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akademik extends Model
{
    use HasFactory;
    protected $fillable = [
        'keyword',
        'image_header',
        'category_academic_id',
    ];

    protected $nullable = [
        'image_header',
    ];

    protected $with = ['categoryAcademic'];

    public function categoryAcademic()
    {
        return $this->belongsTo(CategoryAcademic::class);
    }
}
