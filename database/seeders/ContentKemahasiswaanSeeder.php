<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContentKemahasiswaan;


class ContentKemahasiswaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            [
                'kemahasiswaan_id'      => '4',
                'title'                 => '-',
                'description'           => '-',
                'content'               => '#',
                'image_content'         => '-',
                'date'                  => \Carbon\Carbon::now(),
                'publish'               => '1',
            ],
        ];

        foreach ($contents as $content) {
            ContentKemahasiswaan::create($content);
        }
    }
}
