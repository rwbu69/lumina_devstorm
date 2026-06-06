<x-auth.layout title="Masuk">
    <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden px-8 py-10">
        <x-auth.header
            title="Masuk"
            subtitle="Selamat datang kembali"
        />

        @if (session('status'))
            <div class="mb-4 bg-emerald-50 text-emerald-600 border border-emerald-200 px-4 py-3 rounded-xl text-sm font-medium">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" novalidate x-data="{
            username: '{{ old('username') }}',
            password: '',
            errors: {},
            validate() {
                this.errors = {};
                if (!this.username) this.errors.username = 'Nama akun harus diisi.';
                if (!this.password) this.errors.password = 'Kata sandi harus diisi.';
                else if (this.password.length < 8) this.errors.password = 'Kata sandi minimal 8 karakter.';
                return Object.keys(this.errors).length === 0;
            }
        }" @submit="if(!validate()) $event.preventDefault()">
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
                        x-model="username"
                        @input="if(errors.username) delete errors.username"
                        :class="errors.username ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'"
                        class="block w-full pl-11 pr-4 py-3 bg-white border rounded-xl text-[15px] placeholder-slate-400 focus:outline-none focus:border-[#1a4fd9] focus:ring-1 focus:ring-[#1a4fd9] transition-all"
                        placeholder="Masukkan nama akun Anda"
                        autofocus
                    />
                </div>
                <div class="text-slate-500 text-[13px] mt-1.5 ml-1">Nama akun yang Anda daftarkan.</div>
                <template x-if="errors.username">
                    <div class="text-rose-500 text-xs mt-1.5 pl-1 font-medium flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" /><span x-text="errors.username"></span></div>
                </template>
                @error('username')
                    <div x-show="!errors.username" class="text-rose-500 text-xs mt-1.5 pl-1 font-medium flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" />{{ $message }}</div>
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
                        x-model="password"
                        @input="if(errors.password) delete errors.password"
                        :class="errors.password ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'"
                        class="block w-full pl-11 pr-4 py-3 bg-white border rounded-xl text-[15px] placeholder-slate-400 focus:outline-none focus:border-[#1a4fd9] focus:ring-1 focus:ring-[#1a4fd9] transition-all"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                    />
                </div>
                <div class="text-slate-500 text-[13px] mt-1.5 ml-1">Masukkan kata sandi yang sesuai.</div>
                <template x-if="errors.password">
                    <div class="text-rose-500 text-xs mt-1.5 pl-1 font-medium flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" /><span x-text="errors.password"></span></div>
                </template>
                @error('password')
                    <div x-show="!errors.password" class="text-rose-500 text-xs mt-1.5 pl-1 font-medium flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" />{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3.5 px-4 rounded-xl text-[15px] font-semibold text-white bg-[#1a4fd9] hover:bg-[#1e3a8a] focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all mb-8">
                Masuk
            </button>

            <!-- Footer Link -->
            <div class="text-center">
                <span class="text-slate-500 text-[15px]">Belum punya akun?</span>
                <a href="{{ route('register') }}" class="font-semibold text-[#1a4fd9] hover:text-[#1e3a8a] hover:underline transition-colors text-[15px] ml-1">Daftar di sini</a>
            </div>
        </form>
    </div>

    @if (session('success'))
        <div id="success-toast" class="fixed bottom-6 right-6 z-50 bg-gradient-to-br from-emerald-500 to-emerald-600 text-white px-5 py-4 rounded-xl shadow-lg flex items-center gap-4 min-w-[320px] font-sans opacity-0 translate-y-5 transition-all duration-300 ease-out">
            <div class="bg-white text-emerald-600 rounded-full w-8 h-8 flex items-center justify-center shrink-0 shadow-sm">
                <x-heroicon-o-check class="font-bold size-6" />
            </div>
            <div class="flex-grow">
                <div class="font-bold text-sm mb-0.5">Registrasi Sukses</div>
                <div class="text-xs opacity-95">{{ session('success') }}</div>
            </div>
        </div>

        <script>
            (function() {
                const toast = document.getElementById('success-toast');
                if (toast) {
                    setTimeout(function() {
                        toast.classList.remove('opacity-0', 'translate-y-5');
                        toast.classList.add('opacity-100', 'translate-y-0');
                    }, 150);

                    setTimeout(function() {
                        toast.classList.remove('opacity-100', 'translate-y-0');
                        toast.classList.add('opacity-0', 'translate-y-5');
                        setTimeout(function() {
                            toast.remove();
                        }, 400);
                    }, 3150);
                }
            })();
        </script>
    @endif
</x-auth.layout>
