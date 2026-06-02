<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function username()
    {
        return 'username';
    }

    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $usernameField = $this->username();

        $request->validate([
            $usernameField => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            $usernameField . '.required' => 'Nama Akun wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = [
            'username' => $request->input($usernameField),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $redirectTo = match ($request->user()?->role) {
                'admin' => route('admin.dashboard', absolute: false),
                default => route('catalog.index', absolute: false), // DIUBAH: home → catalog.index
            };

            return redirect()->intended($redirectTo);
        }

        throw ValidationException::withMessages([
            $usernameField => ['Username atau password salah.'],
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}