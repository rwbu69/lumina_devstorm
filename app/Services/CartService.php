<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Book;
use Illuminate\Support\Facades\Session;

class CartService
{
    private const SESSION_KEY = 'cart';

    /**
     * Get all book IDs in the cart.
     *
     * @return array<int>
     */
    public function getBookIds(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }

    /**
     * Get all book models in the cart.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, Book>
     */
    public function getItems(): \Illuminate\Database\Eloquent\Collection
    {
        $ids = $this->getBookIds();
        if (empty($ids)) {
            return new \Illuminate\Database\Eloquent\Collection();
        }

        return Book::with('category')->whereIn('id', $ids)->get();
    }

    /**
     * Add a book to the cart.
     */
    public function add(int $bookId): void
    {
        $ids = $this->getBookIds();
        if (!in_array($bookId, $ids, true)) {
            $ids[] = $bookId;
            Session::put(self::SESSION_KEY, $ids);
        }
    }

    /**
     * Remove a book from the cart.
     */
    public function remove(int $bookId): void
    {
        $ids = $this->getBookIds();
        $ids = array_filter($ids, fn ($id) => (int) $id !== (int) $bookId);
        Session::put(self::SESSION_KEY, array_values($ids));
    }

    /**
     * Clear the cart.
     */
    public function clear(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    /**
     * Get total price of items in the cart.
     */
    public function getTotal(): float
    {
        return (float) $this->getItems()->sum('harga');
    }

    /**
     * Check if a book is already in the cart.
     */
    public function has(int $bookId): bool
    {
        return in_array((int) $bookId, $this->getBookIds(), true);
    }
}
