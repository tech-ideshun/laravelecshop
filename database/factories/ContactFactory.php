<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 6),
            'title' => $this->faker->title,
            'content' => $this->faker->realText,
            'status' => $this->faker->numberBetween(1, 3)
        ];
    }
}
