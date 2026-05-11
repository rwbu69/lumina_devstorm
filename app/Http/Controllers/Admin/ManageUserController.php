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

        return view('admin.users.show', compact('user', 'books'));
    }

    public function updateCredentials(Request $request, User $user): RedirectResponse
    {
        // Implementation for updating credentials
        return back()->with('success', 'Kredensial berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
