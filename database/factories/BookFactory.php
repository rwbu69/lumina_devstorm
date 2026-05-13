<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        $categoryId = Category::query()->inRandomOrder()->value('id')
            ?? Category::query()->create(['nama_kategori' => 'Uncategorized'])->id;

        $judul = Str::title(fake()->words(fake()->numberBetween(2, 5), true));

        return [
            'category_id' => $categoryId,
            'judul' => $judul,
            'penulis' => fake()->name(),
            'harga' => fake()->numberBetween(50_000, 250_000),
            'deskripsi' => fake()->paragraph(5),
            'file_buku' => 'books/'.Str::uuid().'.pdf',
        ];
    }
}
