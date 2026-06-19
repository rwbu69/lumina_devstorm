<section>
    <header>
        <h2 class="text-xl font-bold text-slate-800">
            Ubah Kata Sandi
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block font-medium text-sm text-slate-700 mb-1">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all w-full text-slate-900" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block font-medium text-sm text-slate-700 mb-1">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all w-full text-slate-900" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block font-medium text-sm text-slate-700 mb-1">Konfirmasi Kata Sandi Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all w-full text-slate-900" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="inline-flex items-center justify-center bg-lumina-blue hover:bg-blue-800 text-white font-bold py-2.5 px-6 rounded-xl shadow-sm transition-all focus:ring-4 focus:ring-lumina-blue/30 outline-none">
                Simpan Kata Sandi
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-emerald-600 flex items-center"
                >
                    <x-heroicon-o-check-circle class="w-5 h-5 mr-1" />
                    Tersimpan.
                </p>
            @endif
        </div>
    </form>
</section>
