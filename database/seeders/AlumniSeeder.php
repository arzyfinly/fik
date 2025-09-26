<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumni;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alumni = [
            [
                'keyword'               => 'Tentang Alumni Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_alumni_id'   => '1',
            ],
            [
                'keyword'               => 'Ikatan Alumni Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_alumni_id'   => '2',
            ],
            [
                'keyword'               => 'Tracer Study Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_alumni_id'   => '3',
            ],
            [
                'keyword'               => 'Peluang Kerja Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_alumni_id'   => '4',
            ],
        ];

        foreach ($alumni as $row) {
            Alumni::create($row);
        }
    }
}
