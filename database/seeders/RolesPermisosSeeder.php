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
            'can-view-users',
            'can-create-users',
            'can-edit-users',
            'can-delete-users',

            'ver-articulos',
            'crear-articulos',
            'editar-articulos',
            'borar-articulos',
        ];

        $rolCiente=Role::create(['name' => 'cliente']);


        foreach ($permisos as $permiso) {
           $created=Permission::create(['name'=>$permiso]);
           if($permiso=='can-view-users'){
            $rolCiente->givePermissionTo($permiso);
           }
        }
    }
}
