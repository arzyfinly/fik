<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Akademik;


class AcademicSeeder extends Seeder
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
                'keyword'               => 'Panduan Pendidikan Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_academic_id'   => '1',
            ],
            [
                'keyword'               => 'Program Studi Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_academic_id'   => '2',
            ],
            [
                'keyword'               => 'kalender Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_academic_id'   => '3',
            ],
            [
                'keyword'               => 'Yudisium dan Wisuda Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_academic_id'   => '4',
            ],
        ];

        foreach ($akademiks as $academic) {
            Akademik::create($academic);
        }
    }
}
