<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryAcademic;

class CategoryAcademicSeeder extends Seeder
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
                'name' => 'Panduan Pendidikan FIK',
            ],
            [
                'name' => 'Program Studi',
            ],
            [
                'name' => 'Kalender Akademik',
            ],
            [
                'name' => 'Yudisium & Wisuda',
            ]
        ];

        foreach ($Categories as $category) {
            CategoryAcademic::create($category);
        }
    }
}
