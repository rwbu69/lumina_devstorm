<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManageUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        // Fetch books from verified orders
        $user->load(['orders.orderDetails.book']);
        
        $books = $user->orders()
            ->where('status', 'verified')
            ->with('orderDetails.book')
            ->get()
            ->pluck('orderDetails')
            ->flatten()
            ->pluck('book')
            ->unique('id');

        $allBooks = \App\Models\Book::all();

        return view('admin.users.show', compact('user', 'books', 'allBooks'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
        ]);

        $user->update($validated);
        return back()->with('success', 'Profil pengguna berhasil diperbarui.');
    }

    public function updateCredentials(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function addAccess(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);

        $book = \App\Models\Book::findOrFail($request->book_id);

        // Create a verified order to grant access
        $order = $user->orders()->create([
            'total_tagihan' => 0,
            'status' => 'verified',
            'tanggal_pesan' => now(),
        ]);

        $order->orderDetails()->create([
            'book_id' => $book->id,
            'jumlah' => 1,
            'harga_saat_beli' => 0,
        ]);

        return back()->with('success', 'Akses buku berhasil ditambahkan.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
