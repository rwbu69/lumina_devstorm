<x-auth.layout title="Daftar">
    <div class="card border-0 shadow rounded-4 bg-white">
        <div class="card-body p-4 p-md-5">
            <x-auth.header
                title="Daftar Akun Baru"
                subtitle="Bergabunglah dengan komunitas pembaca kami."
            />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Akun</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                        <input
                            id="nama"
                            type="text"
                            name="nama"
                            value="{{ old('nama') }}"
                            class="form-control @error('nama') is-invalid @enderror bg-white"
                            placeholder="Masukkan nama akun anda"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror bg-white"
                            placeholder="contoh@email.com"
                            required
                            autocomplete="username"
                        />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror bg-white"
                            placeholder="••••••••"
                            required
                            autocomplete="new-password"
                        />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-text">Minimal 8 karakter.</div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror bg-white"
                            placeholder="••••••••"
                            required
                            autocomplete="new-password"
                        />
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 rounded-3">
                    Daftar Sekarang
                </button>

                <div class="text-center text-secondary small mt-4">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Masuk di sini</a>
                </div>
            </form>
        </div>
    </div>
</x-auth.layout>
