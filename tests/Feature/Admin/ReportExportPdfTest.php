<?php

declare(strict_types=1);

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\User;

it('blocks non admin users from accessing report export', function (): void {
    $user = User::factory()->create(['role' => 'user']);

    $this->actingAs($user)
        ->get(route('admin.reports.exportPdf'))
        ->assertForbidden();
});

it('exports filtered sales report to pdf for admin users', function (): void {
    $admin = User::factory()->create(['role' => 'admin']);
    $customer = User::factory()->create(['role' => 'user', 'nama' => 'Pelanggan Satu']);
    $category = Category::query()->create(['nama_kategori' => 'Novel']);
    $book = Book::query()->create([
        'category_id' => $category->id,
        'judul' => 'Bumi Manusia',
        'penulis' => 'Pramoedya Ananta Toer',
        'harga' => 125000,
        'file_buku' => 'books/sample.pdf',
    ]);

    $order = Order::query()->create([
        'user_id' => $customer->id,
        'tanggal_pesan' => now()->subDay(),
        'total_tagihan' => 125000,
        'status' => 'verified',
    ]);

    OrderDetail::query()->create([
        'order_id' => $order->id,
        'book_id' => $book->id,
        'harga_saat_beli' => 125000,
    ]);

    Payment::query()->create([
        'order_id' => $order->id,
        'file_bukti' => 'payments/sample.jpg',
        'tanggal_upload' => now()->subHours(2),
        'status_verifikasi' => 'approved',
        'metode_pembayaran' => 'transfer_bank',
    ]);

    $response = $this->actingAs($admin)->get(route('admin.reports.exportPdf', [
        'tanggal_awal' => now()->subDays(2)->format('Y-m-d'),
        'tanggal_akhir' => now()->format('Y-m-d'),
        'metode_pembayaran' => 'transfer_bank',
    ]), [
        'X-Requested-With' => 'XMLHttpRequest',
        'Accept' => 'application/pdf',
    ]);

    $response->assertOk();
    $response->assertHeader('content-type', 'application/pdf');
    expect($response->content())->toStartWith('%PDF');
});

it('rejects export when no report data exists', function (): void {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get(route('admin.reports.exportPdf', [
            'tanggal_awal' => now()->subDays(2)->format('Y-m-d'),
            'tanggal_akhir' => now()->format('Y-m-d'),
            'metode_pembayaran' => 'transfer_bank',
        ]), [
            'X-Requested-With' => 'XMLHttpRequest',
            'Accept' => 'application/pdf',
        ])
        ->assertStatus(422)
        ->assertJsonStructure(['message']);
});
