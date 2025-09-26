<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiPublik extends Model
{
    use HasFactory;

    protected $fillable = [
        'keyword',
        'image_header',
        'category_informasi_publik_id',
    ];

    protected $nullable = [
        'image_header',
    ];

    protected $with = ['categoryInformasiPublik'];

    public function categoryInformasiPublik()
    {
        return $this->belongsTo(CategoryInformasiPublik::class);
    }
}
