<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #Roles
        $role1 = Role::create(['name'=>'Admin']);
        $role2 = Role::create(['name'=>'Enlace']);

        #Permisos
        Permission::create(['name'=> 'admin.user.store']);
        Permission::create(['name'=> 'admin.empleado.store']);
        Permission::create(['name'=> 'admin.empleado.update']);
        Permission::create(['name'=> 'admin.empleado.destroy']);
        Permission::create(['name'=> 'admin.empleado.index']);
        Permission::create(['name'=> 'admin.empleado.report']);

        #Asignacion de permisos
        $role1->permissions()->attach([1, 2, 3, 4, 5, 6]);
        $role2->permissions()->attach([6]);
    }
}
