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

        $users = User::factory()->count(10)->create([
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        $categories = Category::query()->get();

        $sampleCategory = $categories->first() ?? Category::query()->create([
            'nama_kategori' => 'Umum',
        ]);

        $sampleBooks = collect([
            ['judul' => 'Buku A', 'penulis' => 'Penulis A', 'harga' => 98000],
            ['judul' => 'Buku B', 'penulis' => 'Penulis B', 'harga' => 105000],
            ['judul' => 'Buku C', 'penulis' => 'Penulis C', 'harga' => 120000],
            ['judul' => 'Buku D', 'penulis' => 'Penulis D', 'harga' => 150000],
        ])->map(function (array $bookData) use ($sampleCategory): Book {
            return Book::query()->firstOrCreate(
                ['judul' => $bookData['judul']],
                [
                    'category_id' => $sampleCategory->id,
                    'penulis' => $bookData['penulis'],
                    'harga' => $bookData['harga'],
                    'file_buku' => 'books/'.strtolower(str_replace(' ', '-', $bookData['judul'])).'.pdf',
                ]
            );
        });

        $sampleCustomers = collect([
            ['nama' => 'Andi Ardiansyah', 'email' => 'andi.ardiansyah@example.com'],
            ['nama' => 'Budi Santoso', 'email' => 'budi.santoso@example.com'],
            ['nama' => 'Citra Putri', 'email' => 'citra.putri@example.com'],
            ['nama' => 'Dedi Mahendra', 'email' => 'dedi.mahendra@example.com'],
        ])->map(function (array $customerData) {
            return User::query()->firstOrCreate(
                ['email' => $customerData['email']],
                [
                    'nama' => $customerData['nama'],
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'email_verified_at' => now(),
                ]
            );
        });

        $sampleOrders = collect([
            [
                'user' => $sampleCustomers[0],
                'tanggal_pesan' => Carbon::now()->subDays(3)->setTime(9, 15),
                'status' => 'verified',
                'metode_pembayaran' => 'transfer_bank',
                'books' => [$sampleBooks[0]],
            ],
            [
                'user' => $sampleCustomers[1],
                'tanggal_pesan' => Carbon::now()->subDays(2)->setTime(14, 30),
                'status' => 'pending',
                'metode_pembayaran' => 'cod',
                'books' => [$sampleBooks[1]],
            ],
            [
                'user' => $sampleCustomers[2],
                'tanggal_pesan' => Carbon::now()->subDays(1)->setTime(11, 5),
                'status' => 'cancelled',
                'metode_pembayaran' => 'ewallet',
                'books' => [$sampleBooks[2]],
            ],
            [
                'user' => $sampleCustomers[3],
                'tanggal_pesan' => Carbon::now()->subDay()->setTime(16, 40),
                'status' => 'verified',
                'metode_pembayaran' => 'transfer_bank',
                'books' => [$sampleBooks[3]],
            ],
        ]);

        foreach ($sampleOrders as $sampleOrder) {
            $order = Order::query()->create([
                'user_id' => $sampleOrder['user']->id,
                'tanggal_pesan' => $sampleOrder['tanggal_pesan'],
                'total_tagihan' => 0,
                'status' => $sampleOrder['status'],
            ]);

            $totalTagihan = 0;

            foreach ($sampleOrder['books'] as $book) {
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
                Payment::factory()->create([
                    'order_id' => $order->id,
                    'tanggal_upload' => Carbon::instance($order->tanggal_pesan)->addHours(2),
                    'status_verifikasi' => 'approved',
                    'metode_pembayaran' => $sampleOrder['metode_pembayaran'],
                ]);
            }
        }

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
                    'metode_pembayaran' => $faker->randomElement(['transfer_bank', 'cod', 'ewallet', 'virtual_account']),
                ]);
            }
        }
    }
}
