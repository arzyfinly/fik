<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryInformasiPublik;

class CategoryInformasiPublikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $informasi_publik = [
            [
                'name' => 'Pakta Integritas',
            ],
            [
                'name' => 'Aturan Gratifikasi',
            ],
            [
                'name' => 'Dokumen Zona Integritas',
            ],
            [
                'name' => 'Uniba Madura Expo',
            ],
            [
                'name' => 'SOP',
            ]
        ];

        foreach ($informasi_publik as $informasi_publiks) {
            CategoryInformasiPublik::create($informasi_publiks);
        }
    }
}
