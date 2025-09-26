<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profil;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            [
                'keyword'               => 'Sejarah Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_profile_id'   => '1',
            ],
            [
                'keyword'               => 'Visi Misi dan Tujuan Fakultas Fakultas Ekonomi dan bisnis UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_profile_id'   => '2',
            ],
            [
                'keyword'               => 'Pimpinan Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_profile_id'   => '3',
            ],
            [
                'keyword'               => 'Staff Dosen Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_profile_id'   => '4',
            ],
            [
                'keyword'               => 'Fasilitas Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_profile_id'   => '5',
            ],
            [
                'keyword'               => 'Akreditasi Fakultas Ilmu Komunikasi UNIBA Madura',
                'image_header'          => 'default.JPG',
                'category_profile_id'   => '6',
            ],
        ];

        foreach ($profiles as $profile) {
            Profil::create($profile);
        }
    }
}
