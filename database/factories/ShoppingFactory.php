<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shopping>
 */
class ShoppingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Shopping '. $this->faker->name,
            'createddate' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
