<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory(500)->create();

        $this->call(RolesPermisosSeeder::class);

        $admin=Role::create(['name' => 'admin']);
        $userAdmin=\App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password'=> bcrypt('admin123456')
        ]);
        $userAdmin->assignRole($admin);
    }
}
