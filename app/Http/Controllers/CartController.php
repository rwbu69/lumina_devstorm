<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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

    public function store(Request $request, CartService $cartService)
    {
        $request->validate([
            'book_id' => ['required', 'exists:books,id'],
        ]);

        $bookId = (int) $request->input('book_id');

        if (\Illuminate\Support\Facades\Auth::check()) {
            $ownedBookIds = \Illuminate\Support\Facades\Auth::user()->ownedBookIds();
            if (in_array($bookId, $ownedBookIds, true)) {
                if ($request->wantsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Anda sudah memiliki buku ini.',
                    ], 400);
                }
                return back()->with('error', 'Anda sudah memiliki buku ini.');
            }
        }

        $cartService->add($bookId);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'cart_count' => count(session('cart', [])),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Buku rohani berhasil ditambahkan ke keranjang!');
    }

    public function destroy(int $id, CartService $cartService): RedirectResponse
    {
        $cartService->remove($id);

        return redirect()->route('cart.index')->with('success', 'Buku rohani berhasil dihapus dari keranjang.');
    }
}
