<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View; // Tambahkan ini untuk return view

class ManageUserController extends Controller
{
    // 1. UBAH BAGIAN INI: Mengembalikan tampilan halaman tabel daftar user
    public function index(): View
    {
        // Mengarah ke resources/views/admin/users/index.blade.php
        return view('admin.users.index');
    }

    // 2. TAMBAHKAN FUNGSI BARU INI: Mengembalikan halaman informasi akun Siti Aminah + Modal Hapus
    public function show(): View
    {
        // Mengarah ke resources/views/admin/users/show.blade.php
        return view('admin.users.show');
    }

    public function updateCredentials(Request $request, User $user): RedirectResponse
    {
        return redirect()->route('admin.users.index');
    }

    // Fungsi destroy bawaan Anda (sudah benar untuk menghapus user)
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}