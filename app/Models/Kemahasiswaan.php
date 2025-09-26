<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kemahasiswaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'keyword',
        'image_header',
        'category_kemahasiswaan_id',
    ];

    protected $nullable = [
        'image_header',
    ];

    protected $with = ['categoryKemahasiswaan'];

    public function categoryKemahasiswaan()
    {
        return $this->belongsTo(CategoryKemahasiswaan::class);
    }
}
