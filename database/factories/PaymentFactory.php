<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'file_bukti' => 'payments/'.Str::uuid().'.jpg',
            'tanggal_upload' => fake()->dateTimeBetween('-6 months', 'now'),
            'status_verifikasi' => fake()->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
