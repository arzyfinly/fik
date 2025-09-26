<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryBerita;

class CategoryBeritaSeeder extends Seeder
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
                'name' => 'Informasi',
            ],
            [
                'name' => 'Pengumuman',
            ],
            [
                'name' => 'Agenda',
            ],
        ];

        foreach ($Categories as $category) {
            CategoryBerita::create($category);
        }
    }
}
