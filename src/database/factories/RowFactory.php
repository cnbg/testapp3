<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'   => $this->faker->unique()->randomNumber(6, true),
            'name' => $this->faker->name(),
            'date' => $this->faker->date(),
        ];
    }
}
