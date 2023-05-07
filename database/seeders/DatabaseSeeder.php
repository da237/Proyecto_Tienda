<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Products;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {


        Storage::deleteDirectory('public/images');
        Storage::makeDirectory('public/images');
        \App\Models\User::factory(500)->create();

        $this->call(RolesPermisosSeeder::class);


        Products::factory(2)->create();

        $admin=Role::create(['name' => 'admin']);
        $userAdmin=\App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password'=> bcrypt('admin123456')
        ]);
        $userAdmin->assignRole($admin);

        $userClient=\App\Models\User::factory()->create([
            'name' => 'client',
            'email' => 'client@example.com',
            'password'=> bcrypt('123456')
        ]);
        $userClient->assignRole('cliente');
    }
}
