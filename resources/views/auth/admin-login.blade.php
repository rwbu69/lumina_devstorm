<x-auth.layout title="Masuk Admin">
    <div class="card border-0 shadow rounded-4 bg-white">
        <div class="card-body p-4 p-md-5">
            <x-auth.header
                title="Masuk Admin"
                subtitle="Selamat datang kembali Admin"
            />

            <form method="POST" action="{{ route('admin.login.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold">Nama Akun Admin</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                        <input
                            id="username"
                            type="text"
                            name="username"
                            value="{{ old('username') }}"
                            class="form-control bg-white @error('username') is-invalid @enderror"
                            placeholder="Masukkan nama akun Anda"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control bg-white @error('password') is-invalid @enderror"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                        />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 rounded-3">
                    Masuk
                </button>
            </form>
        </div>
    </div>
</x-auth.layout>
