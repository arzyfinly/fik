<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);

        $this->call(CategoryProfileSeeder::class);
        $this->call(CategoryAcademicSeeder::class);
        $this->call(CategoryKemahasiswaanSeeder::class);
        $this->call(CategoryBeritaSeeder::class);
        $this->call(CategoryInformasiPublikSeeder::class);
        $this->call(CategoryAlumniSeeder::class);

        $this->call(ProfileSeeder::class);
        $this->call(AcademicSeeder::class);
        $this->call(KemahasiswaanSeeder::class);
        $this->call(BeritaSeeder::class);
        $this->call(InformasiPublikSeeder::class);
        $this->call(AlumniSeeder::class);

        $this->call(ContentKemahasiswaanSeeder::class);
        $this->call(ContentAlumniSeeder::class);
        // $this->call(ContentProfilSeeder::class);
        // $this->call(ContentAcademicSeeder::class);
        // $this->call(ContentBeritaSeeder::class);
    }
}
