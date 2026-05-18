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
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
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
                default => route('home', absolute: false),
            };

            return redirect()->intended($redirectTo);
        }

        throw ValidationException::withMessages([
            $usernameField => ['Username atau password salah.'],
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
