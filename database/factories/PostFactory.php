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
    public function definition(): array
    {
        $photo_path = fake()->image(public_path('storage/photos/post'));
        return [
            'user_id' => User::query()->creator()->inRandomOrder()->first()->id,
            'caption' => fake()->realText(100),
            'is_private' => fake()->boolean(),
            'published_at' => now(),
            'photo_path' => str_replace('/var/www/html/public/', '', $photo_path)
        ];
    }
}
