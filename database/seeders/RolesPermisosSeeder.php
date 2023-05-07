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

        $permisos = [
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',
            'change-status-users',

            'ver-products',
            'crear-products',
            'editar-products',
            'borar-products',
        ];

        $rolCiente=Role::create(['name' => 'cliente']);


        foreach ($permisos as $permiso) {
           $created=Permission::create(['name'=>$permiso]);
           if($permiso=='view-users'){
            $rolCiente->givePermissionTo($permiso);
           }
        }
    }
}
