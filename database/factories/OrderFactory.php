<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'tanggal_pesan' => fake()->dateTimeBetween('-6 months', 'now'),
            'total_tagihan' => 0,
            'status' => fake()->randomElement(['pending', 'verified', 'cancelled']),
        ];
    }
}
