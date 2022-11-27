<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Emprunter>
 */
class EmprunterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //dateDebut	heureDebut	duree	etatEmprunt	isValider	ressource_id	user_id	created_at	updated_at	
            'dateDebut' => fake()-> date($format = 'Y-m-d', $max = 'now'),
            'heureDebut' => fake() -> time($format = 'H:i:s', $max = 'now'),
            'duree' => fake() ->numberBetween($min = 1, $max = 24),
            'etatEmprunt' => fake()->boolean(),
            'isValider' => fake()->boolean(),
            'ressource_id' => fake() -> numberBetween($min = 1, $max = 20),
            'user_id' => fake() ->numberBetween($min = 1, $max = 20) ,
            'created_at' => fake() ->date($format = 'Y-m-d', $max = 'now') ,
            'updated_at' => fake() -> date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
