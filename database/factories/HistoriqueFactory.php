<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Historique>
 */
class HistoriqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //created_at	updated_at	
            'created_at' => fake()-> date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => fake()-> date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
