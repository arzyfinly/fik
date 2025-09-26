<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContentAlumni;


class ContentAlumniSeeder extends Seeder
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
                'alumni_id'             => '3',
                'title'                 => '-',
                'description'           => '-',
                'content'               => '#',
                'image_content'         => '-',
                'date'                  => \Carbon\Carbon::now(),
                'publish'               => '1',
            ],
        ];

        foreach ($contents as $content) {
            ContentAlumni::create($content);
        }
    }
}
