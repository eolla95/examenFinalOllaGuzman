<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        \App\Models\User::factory(2)->create();
        \App\Models\Sucursal::factory(10)->create();
        \App\Models\Empleado::factory(10)->create();
    }
}
