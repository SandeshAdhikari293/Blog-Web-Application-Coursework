<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
             'title' => fake()->sentence(2),
             'content' => fake()->paragraph(3),
             'user_id' => User::all()->random()->id, //gets a valid user id from existing instances in the database
        ];
    }
}
