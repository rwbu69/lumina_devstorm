<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        Category::query()->insert([
            ['nama_kategori' => 'Teologi Sistematika', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Sejarah Gereja', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Studi Alkitab', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Spiritualitas', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Apologetika', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
