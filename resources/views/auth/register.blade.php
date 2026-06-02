<x-auth.layout title="Daftar">
    <div class="card border-0 shadow-lg overflow-hidden glass-card rounded-5" style="max-width: 460px; margin: auto; background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.5);">
        <div class="card-body p-4 p-md-5">
            <x-auth.header
                title="Daftar Akun Baru"
                subtitle="Bergabunglah dengan komunitas pembaca kami"
            />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama Lengkap (Name) -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold mb-1 text-dark" style="font-size: 0.9rem;">Nama</label>
                    <div class="input-group border rounded-4 overflow-hidden shadow-sm transition-all focus-ring-div" style="border-color: #cbd5e1 !important; background: #fff;">
                        <span class="input-group-text bg-white border-0 ps-3">
                            <i class="bi bi-person-badge text-primary"></i>
                        </span>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control border-0 py-2 ps-2 @error('name') is-invalid @enderror"
                            placeholder="Masukkan nama lengkap Anda"
                            required
                            autofocus
                            style="box-shadow: none; font-size: 0.95rem;"
                        />
                    </div>
                    @error('name')
                        <div class="text-danger small mt-1 ps-2 fw-medium"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama Akun (Username) -->
                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold mb-1 text-dark" style="font-size: 0.9rem;">Nama Akun</label>
                    <div class="input-group border rounded-4 overflow-hidden shadow-sm transition-all focus-ring-div" style="border-color: #cbd5e1 !important; background: #fff;">
                        <span class="input-group-text bg-white border-0 ps-3">
                            <i class="bi bi-person text-primary"></i>
                        </span>
                        <input
                            id="username"
                            type="text"
                            name="username"
                            value="{{ old('username') }}"
                            class="form-control border-0 py-2 ps-2 @error('username') is-invalid @enderror"
                            placeholder="Huruf, angka, & underscore saja"
                            required
                            style="box-shadow: none; font-size: 0.95rem;"
                        />
                    </div>
                    @error('username')
                        <div class="text-danger small mt-1 ps-2 fw-medium"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}</div>
                    @enderror
                </div>

                <!-- Alamat Email (Email) -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold mb-1 text-dark" style="font-size: 0.9rem;">Alamat Email</label>
                    <div class="input-group border rounded-4 overflow-hidden shadow-sm transition-all focus-ring-div" style="border-color: #cbd5e1 !important; background: #fff;">
                        <span class="input-group-text bg-white border-0 ps-3">
                            <i class="bi bi-envelope text-primary"></i>
                        </span>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control border-0 py-2 ps-2 @error('email') is-invalid @enderror"
                            placeholder="contoh@email.com"
                            required
                            style="box-shadow: none; font-size: 0.95rem;"
                        />
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1 ps-2 fw-medium"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kata Sandi (Password) -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold mb-1 text-dark" style="font-size: 0.9rem;">Kata Sandi</label>
                    <div class="input-group border rounded-4 overflow-hidden shadow-sm transition-all focus-ring-div" style="border-color: #cbd5e1 !important; background: #fff;">
                        <span class="input-group-text bg-white border-0 ps-3">
                            <i class="bi bi-lock text-primary"></i>
                        </span>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control border-0 py-2 ps-2 @error('password') is-invalid @enderror"
                            placeholder="Minimal 8 karakter"
                            required
                            style="box-shadow: none; font-size: 0.95rem;"
                        />
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1 ps-2 fw-medium"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}</div>
                    @enderror
                </div>

                <!-- Konfirmasi Kata Sandi (Password Confirmation) -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold mb-1 text-dark" style="font-size: 0.9rem;">Konfirmasi Kata Sandi</label>
                    <div class="input-group border rounded-4 overflow-hidden shadow-sm transition-all focus-ring-div" style="border-color: #cbd5e1 !important; background: #fff;">
                        <span class="input-group-text bg-white border-0 ps-3">
                            <i class="bi bi-shield-check text-primary"></i>
                        </span>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            class="form-control border-0 py-2 ps-2"
                            placeholder="Ulangi kata sandi Anda"
                            required
                            style="box-shadow: none; font-size: 0.95rem;"
                        />
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100 py-2 fs-6 fw-bold rounded-4 mb-4 btn-glow-primary" style="background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%); border: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); color: white;">
                    Daftar Sekarang <i class="bi bi-arrow-right-short ms-1 fs-5 align-middle"></i>
                </button>

                <!-- Footer Link -->
                <div class="text-center mt-3">
                    <span class="text-secondary opacity-75">Sudah punya akun?</span>
                    <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-primary hover-underline">Masuk di sini</a>
                </div>
            </form>
        </div>
    </div>

    <style>
        .focus-ring-div:focus-within {
            border-color: #1d4ed8 !important;
            box-shadow: 0 0 0 4px rgba(29, 78, 216, 0.15) !important;
            transform: translateY(-1px);
        }
        .btn-glow-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(29, 78, 216, 0.3) !important;
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%) !important;
        }
        .hover-underline:hover {
            text-decoration: underline !important;
        }
        .glass-card {
            transition: all 0.3s ease;
        }
        .glass-card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08) !important;
        }
    </style>
</x-auth.layout>
