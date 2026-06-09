<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function store(CartService $cartService): RedirectResponse
    {
        $items = $cartService->getItems();
        
        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // Create Order
        $order = Order::create([
            'user_id' => Auth::id(),
            'tanggal_pesan' => now(),
            'total_tagihan' => $cartService->getTotal(),
            'status' => 'pending',
        ]);

        // Create Order Details
        foreach ($items as $book) {
            OrderDetail::create([
                'order_id' => $order->id,
                'book_id' => $book->id,
                'harga_saat_beli' => $book->harga,
            ]);
        }

        // Clear Cart
        $cartService->clear();

        return redirect()->route('orders.show', $order->id)->with('success', 'Checkout berhasil! Silakan selesaikan pembayaran.');
    }

    public function show(Order $order): View
    {
        // Safety check
        if (Auth::id() !== $order->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        $order->load(['orderDetails.book.category', 'payment']);

        return view('orders.show', [
            'order' => $order,
        ]);
    }

    public function uploadPayment(Request $request, Order $order): RedirectResponse
    {
        if (Auth::id() !== $order->user_id) {
            abort(403);
        }

        $request->validate([
            'file_bukti' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'metode_pembayaran' => ['required', 'string', 'max:255'],
        ], [
            'file_bukti.required' => 'Bukti transfer wajib diunggah.',
            'file_bukti.image' => 'File harus berupa gambar (JPEG, PNG, JPG).',
            'file_bukti.max' => 'Ukuran gambar maksimal adalah 2MB.',
            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih.',
        ]);

        // Store file proof of payment
        $path = $request->file('file_bukti')->store('proofs', 'public');

        // Create or update payment
        Payment::updateOrCreate(
            ['order_id' => $order->id],
            [
                'file_bukti' => $path,
                'tanggal_upload' => now(),
                'status_verifikasi' => 'pending',
                'metode_pembayaran' => $request->input('metode_pembayaran'),
            ]
        );

        return redirect()->route('orders.success', $order->id);
    }

    public function success(Order $order): View
    {
        if (Auth::id() !== $order->user_id) {
            abort(403);
        }

        return view('orders.success', [
            'order' => $order,
        ]);
    }
}
