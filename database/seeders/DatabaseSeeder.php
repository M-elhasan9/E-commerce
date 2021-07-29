<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $this->call(RolePermissionSeeder::class);

        \App\Models\User::factory(10)->create();

        \App\Models\Group::factory(10)->create();
        \App\Models\Category::factory(10)->create();

        \App\Models\Material::factory(50)->create();



    }
}
