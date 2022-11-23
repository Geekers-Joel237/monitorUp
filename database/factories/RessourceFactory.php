<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RessourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // nomRessource	description	isDisponible	categorie_id	organisation_id	created_at	updated_at
            'nomRessource' => fake()->unique()->name(),
            'description' => fake()->unique()->name(),
            'isDisponible' => fake()->boolean(),
            'categorie_id' => fake()->numberBetween($min = 1, $max = 20),
            'organisation_id' => fake()->numberBetween($min = 1, $max = 20),
            // 'created_at' => fake() ->date($format = 'Y-m-d', $max = 'now') ,
            // 'updated_at' => fake() -> date($format = 'Y-m-d', $max = 'now'),
       
        ];
    }
}
