<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentInformasiPublik extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'content',
        'image_content',
        'date',
        'publish',
        'informasi_publik_id'
    ];

    protected $nullable = [
        'image_content',
    ];

    public function informasi_publik()
    {
        return $this->belongsTo(InformasiPublik::class);
    }
}
