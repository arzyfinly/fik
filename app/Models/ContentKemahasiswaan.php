<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentKemahasiswaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'image_content',
        'date',
        'publish',
        'kemahasiswaan_id'
    ];

    protected $nullable = [
        'image_content',
    ];

    public function kemahasiswaan()
    {
        return $this->belongsTo(Kemahasiswaan::class);
    }
}
