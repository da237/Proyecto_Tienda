<?php

namespace Database\Seeders;

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
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borar-usuario',

            'ver-articulos',
            'crear-articulos',
            'editar-articulos',
            'borar-articulos',
        ];

        foreach ($permisos as $permiso) {
          Permission::create(['name'=>$permiso]);
        }
    }
}
