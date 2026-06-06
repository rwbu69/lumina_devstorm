<x-auth.layout title="Daftar">
    <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden px-8 py-10">
        <x-auth.header
            title="Daftar Akun Baru"
            subtitle="Bergabunglah dengan komunitas pembaca kami."
        />

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <!-- Nama Akun (Username) -->
            <div class="mb-5">
                <label for="username" class="block font-serif font-semibold mb-2 text-[#1e3a8a] text-[15px]">Nama Akun</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <x-heroicon-o-user class="text-slate-500 size-6" />
                    </div>
                    <input
                        id="username"
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        class="block w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-[15px] placeholder-slate-400 focus:outline-none focus:border-[#1a4fd9] focus:ring-1 focus:ring-[#1a4fd9] transition-all @error('username') border-rose-500 @enderror"
                        placeholder="Masukkan nama akun Anda"
                        required
                        maxlength="16"
                        pattern="^[a-zA-Z0-9_]+$"
                        title="Hanya boleh berisi huruf, angka, dan garis bawah (_)"
                        autofocus
                    />
                </div>
                <div class="text-slate-500 text-[13px] mt-1.5 ml-1">Maksimal 16 karakter.</div>
                @error('username')
                    <div class="text-rose-500 text-xs mt-1.5 pl-1 font-medium"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</div>
                @enderror
            </div>

            <!-- Alamat Email (Email) -->
            <div class="mb-5">
                <label for="email" class="block font-serif font-semibold mb-2 text-[#1e3a8a] text-[15px]">Alamat Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <x-heroicon-o-envelope class="text-slate-500 size-6" />
                    </div>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="block w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-[15px] placeholder-slate-400 focus:outline-none focus:border-[#1a4fd9] focus:ring-1 focus:ring-[#1a4fd9] transition-all @error('email') border-rose-500 @enderror"
                        placeholder="contoh@email.com"
                        required
                        maxlength="255"
                    />
                </div>
                <div class="text-slate-500 text-[13px] mt-1.5 ml-1">Format email yang valid.</div>
                @error('email')
                    <div class="text-rose-500 text-xs mt-1.5 pl-1 font-medium"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</div>
                @enderror
            </div>

            <!-- Kata Sandi (Password) -->
            <div class="mb-8">
                <label for="password" class="block font-serif font-semibold mb-2 text-[#1e3a8a] text-[15px]">Kata Sandi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <x-heroicon-o-lock-closed class="text-slate-500 size-6" />
                    </div>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="block w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-[15px] placeholder-slate-400 focus:outline-none focus:border-[#1a4fd9] focus:ring-1 focus:ring-[#1a4fd9] transition-all @error('password') border-rose-500 @enderror"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                        required
                        minlength="8"
                    />
                </div>
                <div class="text-slate-500 text-[13px] mt-1.5 ml-1">Minimal 8 karakter.</div>
                @error('password')
                    <div class="text-rose-500 text-xs mt-1.5 pl-1 font-medium"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</div>
                @enderror
            </div>

            <!-- Konfirmasi Kata Sandi (Password Confirmation) -->
            <div class="mb-8">
                <label for="password_confirmation" class="block font-serif font-semibold mb-2 text-[#1e3a8a] text-[15px]">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <x-heroicon-s-lock-closed class="text-slate-500 size-6" />
                    </div>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="block w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-[15px] placeholder-slate-400 focus:outline-none focus:border-[#1a4fd9] focus:ring-1 focus:ring-[#1a4fd9] transition-all"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                        required
                        minlength="8"
                    />
                </div>
                <div class="text-slate-500 text-[13px] mt-1.5 ml-1">Ketik ulang kata sandi Anda.</div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3.5 px-4 rounded-xl text-[15px] font-semibold text-white bg-[#1a4fd9] hover:bg-[#1e3a8a] focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all mb-8">
                Daftar Sekarang
            </button>

            <!-- Footer Link -->
            <div class="text-center">
                <span class="text-slate-500 text-[15px]">Sudah punya akun?</span>
                <a href="{{ route('login') }}" class="font-semibold text-[#1a4fd9] hover:text-[#1e3a8a] hover:underline transition-colors text-[15px] ml-1">Masuk di sini</a>
            </div>
        </form>
    </div>

    </div>
</x-auth.layout>
