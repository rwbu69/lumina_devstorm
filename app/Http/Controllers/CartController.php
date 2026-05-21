<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(CartService $cartService): View
    {
        $items = $cartService->getItems();
        $total = $cartService->getTotal();

        return view('cart.index', [
            'items' => $items,
            'total' => $total,
        ]);
    }

    public function store(Request $request, CartService $cartService): RedirectResponse
    {
        $request->validate([
            'book_id' => ['required', 'exists:books,id'],
        ]);

        $cartService->add((int) $request->input('book_id'));

        return redirect()->route('cart.index')->with('success', 'Buku rohani berhasil ditambahkan ke keranjang!');
    }

    public function destroy(int $id, CartService $cartService): RedirectResponse
    {
        $cartService->remove($id);

        return redirect()->route('cart.index')->with('success', 'Buku rohani berhasil dihapus dari keranjang.');
    }
}
