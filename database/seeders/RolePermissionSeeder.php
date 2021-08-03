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
        $SuperAdminRole = Role::create(['name'=>'super-admin']);
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'guest']);

        $createCategoryPermission = Permission::create(['name' => 'create category']);
        $editCategoryPermission = Permission::create(['name' => 'edit category']);
        $deleteCategoryPermission = Permission::create(['name' => 'delete category']);
        $createGroupPermission = Permission::create(['name' => 'create group']);
        $editGroupPermission = Permission::create(['name' => 'edit group']);
        $deleteGroupPermission = Permission::create(['name' => 'delete group']);

        $SuperAdminRole->givePermissionTo([$createCategoryPermission,$editCategoryPermission,$deleteCategoryPermission]);
        $SuperAdminRole->givePermissionTo([$createGroupPermission,$editGroupPermission,$deleteGroupPermission]);



    }
}
