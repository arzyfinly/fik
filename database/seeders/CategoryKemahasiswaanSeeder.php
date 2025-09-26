<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryKemahasiswaan;

class CategoryKemahasiswaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Categories = [
            [
                'name' => 'Beasiswa',
            ],
            [
                'name' => 'Prestasi Mahasiswa',
            ],
            [
                'name' => 'Ormawa',
            ],
            [
                'name' => 'Pendaftaran',
            ],
        ];

        foreach ($Categories as $category) {
            CategoryKemahasiswaan::create($category);
        }
    }
}
