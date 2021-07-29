<?php

namespace Database\Seeders;

use Backpack\PermissionManager\app\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'super-admin']);
        Role::create(['name'=>'admin']);
        $role = Role::create(['name'=>'user']);

        $permission = Permission::create(['name' => 'add material']);
        $role->givePermissionTo($permission);


    }
}
