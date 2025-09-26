<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InformasiPublik;


class InformasiPublikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $akademiks = [
            [
                'keyword'               => 'Pakta Integritas Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_informasi_publik_id'   => '1',
            ],
            [
                'keyword'               => 'Aturan Gratifikasi Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_informasi_publik_id'   => '2',
            ],
            [
                'keyword'               => 'Dokumen Zona Integritas Ekonomi dan Bisnis UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_informasi_publik_id'   => '3',
            ],
            [
                'keyword'               => 'Uniba Madura Expo Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_informasi_publik_id'   => '4',
            ],
            [
                'keyword'               => 'SOP Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_informasi_publik_id'   => '5',
            ],
        ];

        foreach ($akademiks as $informasi_publik) {
            InformasiPublik::create($informasi_publik);
        }
    }
}
