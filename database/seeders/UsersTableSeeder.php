<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Sebastian Demarchi',
            'email' => 'sdemarchi@stilodigital.com.ar',
            'password' => bcrypt('jav28INTRA'),
        ]);
    }
}
