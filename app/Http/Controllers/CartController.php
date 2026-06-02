<?php

declare(strict_types=1);

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Book;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
=======
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
use Illuminate\View\View;

class CartController extends Controller
{
<<<<<<< HEAD
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
=======
    public function index(): View
    {
        return view('cart.index');
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
    }
}
