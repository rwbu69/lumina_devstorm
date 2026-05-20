<?php

namespace Database\Seeders;


use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = FakerFactory::create('id_ID');

        $this->call(CategorySeeder::class);

        User::query()->firstOrCreate(
            ['email' => 'admin@lumina.id'],
            [
                'nama' => 'Admin Lumina',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );


        User::query()->firstOrCreate(
            ['email' => 'user@lumina.id'],
            [
                'nama' => 'User Lumina',
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
            );

        $users = User::factory()->count(10)->create([
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        $categories = Category::query()->get();

        $books = Book::factory()
            ->count(50)
            ->state(new Sequence(fn () => [
                'category_id' => $categories->random()->id,
            ]))
            ->create();

        $orders = Order::factory()
            ->count(20)
            ->state(new Sequence(fn () => [
                'user_id' => $users->random()->id,
            ]))
            ->create();

        foreach ($orders as $order) {
            $detailCount = $faker->numberBetween(1, 3);
            $pickedBooks = $books->random($detailCount);

            if ($pickedBooks instanceof Book) {
                $pickedBooks = collect([$pickedBooks]);
            }

            $totalTagihan = 0;

            foreach ($pickedBooks as $book) {
                OrderDetail::query()->create([
                    'order_id' => $order->id,
                    'book_id' => $book->id,
                    'harga_saat_beli' => $book->harga,
                ]);

                $totalTagihan += (int) $book->harga;
            }

            $order->update([
                'total_tagihan' => $totalTagihan,
            ]);

            if ($order->status === 'verified') {
                $uploadAt = Carbon::instance($order->tanggal_pesan)
                    ->addHours($faker->numberBetween(1, 72));

                if ($uploadAt->greaterThan(now())) {
                    $uploadAt = now();
                }

                Payment::factory()->create([
                    'order_id' => $order->id,
                    'tanggal_upload' => $uploadAt,
                    'status_verifikasi' => 'approved',
                ]);
            }
        }
    }
}
