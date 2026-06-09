<x-auth.layout title="Daftar">
    <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden px-8 py-10">
        <x-auth.header title="Daftar Akun Baru" subtitle="Bergabunglah dengan komunitas pembaca kami." />

        <form method="POST" action="{{ route('register') }}" novalidate x-data="{
            username: '{{ old('username') }}',
            email: '{{ old('email') }}',
            password: '',
            password_confirmation: '',
            errors: {},
            validate() {
                this.errors = {};
                if (!this.username) this.errors.username = 'Nama akun harus diisi.';
                else if (this.username.length > 16) this.errors.username = 'Maksimal 16 karakter.';
                else if (!/^[a-zA-Z0-9_]+$/.test(this.username)) this.errors.username = 'Hanya boleh berisi huruf, angka, dan garis bawah (_).';

                if (!this.email) this.errors.email = 'Alamat email harus diisi.';
                else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email)) this.errors.email = 'Format email tidak valid.';

                if (!this.password) this.errors.password = 'Kata sandi harus diisi.';
                else if (this.password.length < 8) this.errors.password = 'Kata sandi minimal 8 karakter.';

                if (!this.password_confirmation) this.errors.password_confirmation = 'Konfirmasi kata sandi harus diisi.';
                else if (this.password !== this.password_confirmation) this.errors.password_confirmation = 'Konfirmasi kata sandi tidak cocok.';

                return Object.keys(this.errors).length === 0;
            }
        }"
            @submit="if(!validate()) $event.preventDefault()">
            @csrf

            <!-- Nama Akun (Username) -->
            <div class="mb-5">
                <label for="username" class="block font-serif font-semibold mb-2 text-[#1e3a8a] text-[15px]">Nama
                    Akun</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <x-heroicon-o-user class="text-slate-500 size-6" />
                    </div>
                    <input id="username" type="text" name="username" x-model="username"
                        @input="if(errors.username) delete errors.username"
                        :class="errors.username ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'"
                        class="block w-full pl-11 pr-4 py-3 bg-white border rounded-xl text-[15px] placeholder-slate-400 focus:outline-none focus:border-lumina-blue focus:ring-1 focus:ring-lumina-blue transition-all"
                        placeholder="Masukkan nama akun Anda" autofocus />
                </div>
                <div class="text-slate-500 text-[13px] mt-1.5 ml-1">Maksimal 16 karakter.</div>
                <template x-if="errors.username">
                    <div class="text-rose-500 text-xs mt-1.5 pl-1 font-medium flex items-center">
                        <x-heroicon-o-exclamation-circle class="mr-1 size-4" /><span x-text="errors.username"></span>
                    </div>
                </template>
                @error('username')
                    <div x-show="!errors.username" class="text-rose-500 text-xs mt-1.5 pl-1 font-medium flex items-center">
                        <x-heroicon-o-exclamation-circle class="mr-1 size-4" />{{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Alamat Email (Email) -->
            <div class="mb-5">
                <label for="email" class="block font-serif font-semibold mb-2 text-[#1e3a8a] text-[15px]">Alamat
                    Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <x-heroicon-o-envelope class="text-slate-500 size-6" />
                    </div>
                    <input id="email" type="email" name="email" x-model="email"
                        @input="if(errors.email) delete errors.email"
                        :class="errors.email ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'"
                        class="block w-full pl-11 pr-4 py-3 bg-white border rounded-xl text-[15px] placeholder-slate-400 focus:outline-none focus:border-lumina-blue focus:ring-1 focus:ring-lumina-blue transition-all"
                        placeholder="contoh@email.com" />
                </div>
                <div class="text-slate-500 text-[13px] mt-1.5 ml-1">Format email yang valid.</div>
                <template x-if="errors.email">
                    <div class="text-rose-500 text-xs mt-1.5 pl-1 font-medium flex items-center">
                        <x-heroicon-o-exclamation-circle class="mr-1 size-4" /><span x-text="errors.email"></span>
                    </div>
                </template>
                @error('email')
                    <div x-show="!errors.email" class="text-rose-500 text-xs mt-1.5 pl-1 font-medium flex items-center">
                        <x-heroicon-o-exclamation-circle class="mr-1 size-4" />{{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Kata Sandi (Password) -->
            <div class="mb-8">
                <label for="password" class="block font-serif font-semibold mb-2 text-[#1e3a8a] text-[15px]">Kata
                    Sandi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <x-heroicon-o-lock-closed class="text-slate-500 size-6" />
                    </div>
                    <input id="password" type="password" name="password" x-model="password"
                        @input="if(errors.password) delete errors.password"
                        :class="errors.password ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'"
                        class="block w-full pl-11 pr-4 py-3 bg-white border rounded-xl text-[15px] placeholder-slate-400 focus:outline-none focus:border-lumina-blue focus:ring-1 focus:ring-lumina-blue transition-all"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />
                </div>
                <div class="text-slate-500 text-[13px] mt-1.5 ml-1">Minimal 8 karakter.</div>
                <template x-if="errors.password">
                    <div class="text-rose-500 text-xs mt-1.5 pl-1 font-medium flex items-center">
                        <x-heroicon-o-exclamation-circle class="mr-1 size-4" /><span x-text="errors.password"></span>
                    </div>
                </template>
                @error('password')
                    <div x-show="!errors.password" class="text-rose-500 text-xs mt-1.5 pl-1 font-medium flex items-center">
                        <x-heroicon-o-exclamation-circle class="mr-1 size-4" />{{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Konfirmasi Kata Sandi (Password Confirmation) -->
            <div class="mb-8">
                <label for="password_confirmation"
                    class="block font-serif font-semibold mb-2 text-[#1e3a8a] text-[15px]">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <x-heroicon-s-lock-closed class="text-slate-500 size-6" />
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        x-model="password_confirmation"
                        @input="if(errors.password_confirmation) delete errors.password_confirmation"
                        :class="errors.password_confirmation ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'"
                        class="block w-full pl-11 pr-4 py-3 bg-white border rounded-xl text-[15px] placeholder-slate-400 focus:outline-none focus:border-lumina-blue focus:ring-1 focus:ring-lumina-blue transition-all"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />
                </div>
                <div class="text-slate-500 text-[13px] mt-1.5 ml-1">Ketik ulang kata sandi Anda.</div>
                <template x-if="errors.password_confirmation">
                    <div class="text-rose-500 text-xs mt-1.5 pl-1 font-medium flex items-center">
                        <x-heroicon-o-exclamation-circle class="mr-1 size-4" /><span
                            x-text="errors.password_confirmation"></span>
                    </div>
                </template>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full py-3.5 px-4 rounded-xl text-[15px] font-semibold text-white bg-lumina-blue hover:bg-[#1e3a8a] focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all mb-8">
                Daftar Sekarang
            </button>

            <!-- Footer Link -->
            <div class="text-center">
                <span class="text-slate-500 text-[15px]">Sudah punya akun?</span>
                <a href="{{ route('login') }}"
                    class="font-semibold text-lumina-blue hover:text-[#1e3a8a] hover:underline transition-colors text-[15px] ml-1">Masuk
                    di sini</a>
            </div>
        </form>
    </div>

    </div>
</x-auth.layout>
