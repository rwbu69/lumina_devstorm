<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AdminActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'user';

        $user = User::create($validated);
        AdminActivityLogger::log('Tambah User', "Menambahkan user baru {$user->email} (ID: {$user->id})");

        return back()->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        $this->authorizeAdminAction($user);
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
        $this->authorizeAdminAction($user);
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,user',
        ]);

        $user->update($validated);
        AdminActivityLogger::log('Update User', "Memperbarui profil user {$user->email} (ID: {$user->id})");

        return back()->with('success', 'Profil pengguna berhasil diperbarui.');
    }

    public function updateCredentials(Request $request, User $user): RedirectResponse
    {
        $this->authorizeAdminAction($user);
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user->update([
            'password' => bcrypt($request->password),
        ]);
        AdminActivityLogger::log('Update Password User', "Memperbarui password user {$user->email} (ID: {$user->id})");

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function addAccess(Request $request, User $user): RedirectResponse
    {
        $this->authorizeAdminAction($user);
        $request->validate([
            'book_id' => 'required|exists:books,id',
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
        AdminActivityLogger::log('Tambah Akses Buku', "Menambahkan akses buku '{$book->judul}' ke user {$user->email} (ID: {$user->id})");

        return back()->with('success', 'Akses buku berhasil ditambahkan.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorizeAdminAction($user);

        $email = $user->email;
        $id = $user->id;
        $user->delete();
        AdminActivityLogger::log('Hapus User', "Menghapus user {$email} (ID: {$id})");

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }

    private function authorizeAdminAction(User $targetUser): void
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = \Illuminate\Support\Facades\Auth::user();
        if ($currentUser->role === 'admin' && in_array($targetUser->role, ['admin', 'superadmin'])) {
            abort(403, 'Akses ditolak: Anda tidak memiliki wewenang untuk mengubah atau menghapus sesama Admin atau Superadmin.');
        }
    }
}
