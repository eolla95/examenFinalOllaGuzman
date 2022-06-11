<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use App\Models\Sucursal;
use App\Models\Empleado;
use App\Models\User;


use function Ramsey\Uuid\v1;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([RoleSeeder::class]);
        
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@itca.edu.sv',
            'password'=> bcrypt('123456')
        ])->assignRole('Admin');

        User::create([
            'name' => 'Enlace',
            'email' => 'enlace@itca.edu.sv',
            'password'=> bcrypt('123456')
        ])->assignRole('Enlace');
        
        Sucursal::factory(10)->create();
        Empleado::factory(10)->create();
    }
}
