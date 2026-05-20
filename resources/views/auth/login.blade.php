<x-auth.layout title="Masuk">
    <div class="card border-0 shadow-lg overflow-hidden" style="max-width: 400px; margin: auto;">
        <div class="card-body p-4 p-md-5 bg-white">
            <x-auth.header
                title="Masuk"
                subtitle="Selamat datang kembali"
            />

            @if (session('status'))
                <div class="alert alert-success border-0 rounded-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Nama Akun -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-medium mb-1" style="color: #4b5563;">Nama Akun</label>
                    <div class="input-group border rounded-4 overflow-hidden" style="border-color: #d1d5db !important;">
                        <span class="input-group-text bg-white border-0 ps-3">
                            <i class="bi bi-person text-secondary"></i>
                        </span>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control border-0 py-2 ps-2 @error('email') is-invalid @enderror"
                            placeholder="Masukkan nama akun Anda"
                            required
                            autofocus
                            style="box-shadow: none;"
                        />
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1 ps-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kata Sandi -->
                <div class="mb-4">
                    <label for="password" class="form-label fw-medium mb-1" style="color: #4b5563;">Kata Sandi</label>
                    <div class="input-group border rounded-4 overflow-hidden" style="border-color: #d1d5db !important;">
                        <span class="input-group-text bg-white border-0 ps-3">
                            <i class="bi bi-lock text-secondary"></i>
                        </span>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control border-0 py-2 ps-2 @error('password') is-invalid @enderror"
                            placeholder="••••••••"
                            required
                            style="box-shadow: none;"
                        />
                    </div>
                    <div class="text-secondary small mt-1 ps-1 opacity-75">Minimal 8 karakter.</div>
                    @error('password')
                        <div class="text-danger small mt-1 ps-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100 py-2 fs-6 fw-medium rounded-4 mb-4" style="background-color: #1d4ed8; border-color: #1d4ed8; transition: all 0.3s ease;">
                    Masuk
                </button>

                <!-- Footer Link -->
                <div class="text-center mt-3">
                    <span class="text-secondary opacity-75">Belum punya akun?</span>
                    <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Daftar di sini</a>
                </div>
            </form>
        </div>
    </div>

    <style>
        .input-group:focus-within {
            border-color: #1d4ed8 !important;
            box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.1);
        }
        .btn-primary:hover {
            background-color: #1e40af !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
    </style>
</x-auth.layout>
