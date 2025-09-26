<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryAlumni;

class CategoryAlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Alumni = [
            [
                'name' => 'Tentang Alumni FIK',
            ],
            [
                'name' => 'Ikatan Alumni FIK',
            ],
            [
                'name' => 'Tracer Study',
            ],
            [
                'name' => 'Peluang Kerja',
            ]
        ];

        foreach ($Alumni as $alumnis) {
            CategoryAlumni::create($alumnis);
        }
    }
}
