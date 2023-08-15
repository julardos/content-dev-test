<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->notCreator()->inRandomOrder()->first()->id,
            'creator_id' => User::query()->creator()->inRandomOrder()->first()->id,
            'number' => $this->faker->randomNumber(8),
            'total_price' => $this->faker->numberBetween(25000, 200000),
            'payment_status' => Order::STATUS_PAID,
            'paid_at' => Carbon::now(),
            'expired_at' => Carbon::now()->addHours(2),
            'subscribed_end_date' => Carbon::now()->addDays(30)
        ];
    }
}
