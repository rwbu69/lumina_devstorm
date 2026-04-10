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
            ['nama_kategori' => 'Fiksi', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Non-Fiksi', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Teknologi', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Bisnis', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Religi', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
