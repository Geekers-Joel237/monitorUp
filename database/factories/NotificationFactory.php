<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //contenu	emetteur_id	recepteur_id	created_at	updated_at
            'contenu' => fake() -> unique() -> name(),
            'emetteur_id' => fake() -> unique(),
            'recepteur_id'=> fake() -> unique(),
            'created_at' => fake()-> date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => fake()-> date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
