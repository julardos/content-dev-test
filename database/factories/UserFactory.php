<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function configure()
    {
        return parent::afterCreating(function (User $user) {
            if ($user->is_content_creator)
            {
                $user->profile()->create([
                    'is_post_locked' => fake()->boolean(),
                    'expertise' => fake()->jobTitle(),
                    'description' => fake()->realText(),
                    'genres' => [fake()->city()]
                ]);
            }
        });
    }

    public function definition()
    {
        return [
            'name' => \fake()->name(),
            'email' => \fake()->unique()->safeEmail(),
            'email_verified_at' => \now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
            'is_content_creator' => fake()->boolean(20)
        ];
    }

    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
