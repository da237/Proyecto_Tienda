<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Migrations\RollbackCommand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    //     $permisos = [
    //         'view-users',
    //         'create-users',
    //         'edit-users',
    //         'delete-users',
    //         'change-status-users',

    //         'ver-products',
    //         'crear-products',
    //         'editar-products',
    //         'borar-products',
    //     ];

    //     $rolCiente=Role::create(['name' => 'cliente']);


    //     foreach ($permisos as $permiso) {
    //        $created=Permission::create(['name'=>$permiso]);
    //        if($permiso=='view-users'){
    //         $rolCiente->givePermissionTo($permiso);
    //        }
    //     }

    //     foreach ($permisos as $permiso) {
    //         $created=Permission::create(['name'=>$permiso]);
    //         if($permiso=='ver-products'){
    //          $rolCiente->givePermissionTo($permiso);
    //         }
    //      }

    $role1 = Role::create(['name' => 'admin']);
    $role2 = Role::create(['name' => 'cliente']);

    Permission::create(['name' => 'view-users'])->assignRole($role1);
    Permission::create(['name' => 'create-users'])->assignRole($role1);
    Permission::create(['name' => 'edit-users'])->assignRole($role1);
    Permission::create(['name' => 'delete-users'])->assignRole($role1);
    Permission::create(['name' => 'change-status-users'])->assignRole($role1);
    Permission::create(['name' => 'ver-products'])->assignRole($role1, $role2);
    Permission::create(['name' => 'crear-products'])->assignRole($role1);
    Permission::create(['name' => 'editar-products'])->assignRole($role1);
    Permission::create(['name' => 'borar-products'])->assignRole($role1);



    }
}
