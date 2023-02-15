<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->title,
            'commentable_id' => Post::factory()->create()->id,
            'commentable_type' => Post::class,
            'owner_id' => User::factory()->create()->id
        ];
    }
}
