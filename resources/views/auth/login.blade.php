<x-auth.layout title="Masuk">
    <div class="card border-0 shadow-lg overflow-hidden glass-card rounded-5" style="max-width: 420px; margin: auto; background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.5);">
        <div class="card-body p-4 p-md-5">
            <x-auth.header
                title="Masuk"
                subtitle="Selamat datang kembali di Lumina"
            />

            @if (session('status'))
                <div class="alert alert-success border-0 rounded-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Nama Akun (Username) -->
                <div class="mb-4">
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
                            placeholder="Masukkan nama akun"
                            required
                            autofocus
                            style="box-shadow: none; font-size: 0.95rem;"
                        />
                    </div>
                    @error('username')
                        <div class="text-danger small mt-1 ps-2 fw-medium"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kata Sandi (Password) -->
                <div class="mb-4">
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
                            placeholder="Masukkan kata sandi"
                            required
                            style="box-shadow: none; font-size: 0.95rem;"
                        />
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1 ps-2 fw-medium"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100 py-2 fs-6 fw-bold rounded-4 mb-4 btn-glow-primary" style="background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%); border: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); color: white;">
                    Masuk Sekarang <i class="bi bi-arrow-right-short ms-1 fs-5 align-middle"></i>
                </button>

                <!-- Footer Link -->
                <div class="text-center mt-3">
                    <span class="text-secondary opacity-75">Belum punya akun?</span>
                    <a href="{{ route('register') }}" class="text-decoration-none fw-bold text-primary hover-underline">Daftar di sini</a>
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
    @if (session('success'))
        <!-- Custom Self-Contained Toast with Inline Styles for CSS Isolation & Zero Dependencies -->
        <div id="success-toast" style="
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 99999;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 16px 20px;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 16px;
            min-width: 320px;
            font-family: 'Inter', sans-serif;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        ">
            <div style="
                background: white;
                color: #059669;
                border-radius: 50%;
                width: 32px;
                height: 32px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            ">
                <i class="bi bi-check-lg" style="font-size: 1.2rem; font-weight: bold;"></i>
            </div>
            <div style="flex-grow: 1;">
                <div style="font-weight: 700; font-size: 0.95rem; margin-bottom: 2px;">Registrasi Sukses</div>
                <div style="font-size: 0.85rem; opacity: 0.95;">{{ session('success') }}</div>
            </div>
        </div>

        <script>
            (function() {
                // Instant execution to bypass DOMContentLoaded timing issues
                const toast = document.getElementById('success-toast');
                if (toast) {
                    // Animate entry after a brief timeout
                    setTimeout(function() {
                        toast.style.opacity = '1';
                        toast.style.transform = 'translateY(0)';
                    }, 150);

                    // Auto dismiss after 3 seconds
                    setTimeout(function() {
                        toast.style.opacity = '0';
                        toast.style.transform = 'translateY(20px)';
                        setTimeout(function() {
                            toast.remove();
                        }, 400);
                    }, 3150);
                }
            })();
        </script>
    @endif
</x-auth.layout>
