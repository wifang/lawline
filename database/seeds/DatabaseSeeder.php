<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('users')->insert([
            'firstName' => str_random(5),
            'lastName' => str_random(5),
            'email' => str_random(5).'@gmail.com',
            'password' => bcrypt('secret')
        ]);
    }
}
