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

        $this->call(UsersSeeder::class);

        \App\Models\Group::factory(10)->create();

        \App\Models\Material::factory(10)->create();


    }
}
