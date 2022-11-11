<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'user_id' => $this->factoryForModel(User::class),
            'user_id' => $this->factoryForModel(User::class)->create()->id,
            'title' => $this->faker->text(15),
            'description' => $this->faker->text(100),
        ];
    }
}
