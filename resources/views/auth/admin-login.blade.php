<x-auth.layout title="Masuk Admin">
    <div class="bg-white border border-slate-200 shadow-xl rounded-3xl overflow-hidden">
        <div class="p-6 md:p-8">
            <x-auth.header title="Masuk Admin" subtitle="Selamat datang kembali, Administrator" />

            <form method="POST" action="{{ route('admin.login.store') }}" novalidate x-data="{
                username: '{{ old('username') }}',
                password: '',
                errors: {},
                validate() {
                    this.errors = {};
                    if (!this.username) this.errors.username = 'Nama akun admin harus diisi.';
                    if (!this.password) this.errors.password = 'Kata sandi harus diisi.';
                    return Object.keys(this.errors).length === 0;
                }
            }"
                @submit="if(!validate()) $event.preventDefault()">
                @csrf

                <div class="mb-5">
                    <label for="username" class="block font-bold mb-1.5 text-slate-800 text-sm">Nama Akun Admin</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <x-heroicon-o-user class="text-lumina-blue size-6" />
                        </div>
                        <input id="username" type="text" name="username" x-model="username"
                            @input="if(errors.username) delete errors.username"
                            :class="errors.username ? 'border-rose-500 focus:ring-rose-500/20 ring-1 ring-rose-500' :
                                'border-slate-200'"
                            class="block w-full pl-11 pr-4 py-3 bg-slate-50 border rounded-xl text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all"
                            placeholder="Masukkan nama akun Anda" autofocus autocomplete="username" />
                    </div>
                    <template x-if="errors.username">
                        <div class="text-rose-500 text-xs mt-1.5 pl-2 font-medium flex items-center">
                            <x-heroicon-s-exclamation-circle class="me-1 size-4" /><span
                                x-text="errors.username"></span>
                        </div>
                    </template>
                    @error('username')
                        <div x-show="!errors.username"
                            class="text-rose-500 text-xs mt-1.5 pl-2 font-medium flex items-center">
                            <x-heroicon-s-exclamation-circle class="me-1 size-4" />{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block font-bold mb-1.5 text-slate-800 text-sm">Kata Sandi</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <x-heroicon-o-lock-closed class="text-lumina-blue size-6" />
                        </div>
                        <input id="password" type="password" name="password" x-model="password"
                            @input="if(errors.password) delete errors.password"
                            :class="errors.password ? 'border-rose-500 focus:ring-rose-500/20 ring-1 ring-rose-500' :
                                'border-slate-200'"
                            class="block w-full pl-11 pr-4 py-3 bg-slate-50 border rounded-xl text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all"
                            placeholder="••••••••" autocomplete="current-password" />
                    </div>
                    <template x-if="errors.password">
                        <div class="text-rose-500 text-xs mt-1.5 pl-2 font-medium flex items-center">
                            <x-heroicon-s-exclamation-circle class="me-1 size-4" /><span
                                x-text="errors.password"></span>
                        </div>
                    </template>
                    @error('password')
                        <div x-show="!errors.password"
                            class="text-rose-500 text-xs mt-1.5 pl-2 font-medium flex items-center">
                            <x-heroicon-s-exclamation-circle class="me-1 size-4" />{{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full flex items-center justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-lumina-blue hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-lumina-blue/30 transition-all">
                    Masuk ke Dasbor
                </button>
            </form>
        </div>
    </div>
</x-auth.layout>
