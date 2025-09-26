<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'                  => 'admin',
                'email'                 => 'admin@unibamadura.ac.id',
                'password'              => Hash::make('12345678'),
                'created_at'            => \Carbon\Carbon::now(),
                'email_verified_at'     => \Carbon\Carbon::now()
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
