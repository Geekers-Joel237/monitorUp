<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategorieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //titre	organisation_id	created_at	updated_at
            'titre' => fake()->unique()->name(),
            'organisation_id' => fake()->numberBetween($min = 1, $max = 20),
            
        ];
    }
}
