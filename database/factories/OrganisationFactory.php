<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organisation>
 */
class OrganisationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //id nom created_at update_at
            'nomOrganisation' => fake()->unique()->name(),
            // 'created_at' => fake()-> date($format = 'Y-m-d', $max = 'now'),
            // 'updated_at' => fake()-> date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
