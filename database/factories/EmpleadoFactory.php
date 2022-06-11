<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'edad' => $this->faker->numberBetween(18, 99),
            'sueldo_base' => $this->faker->numberBetween(350, 800),
            'direccion' => $this->faker->city,
            'foto'=> $this->faker->imageUrl($width = 200, $height = 200),
            'id_administrador'=> 1,
            'id_sucursal'=> 1,
        ];
    }
}
