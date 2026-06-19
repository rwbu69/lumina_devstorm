<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-rose-600 flex items-center">
            <x-heroicon-o-exclamation-triangle class="w-6 h-6 mr-2" />
            Hapus Akun
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Setelah akun Anda dihapus, semua sumber daya dan data yang terkait akan dihapus secara permanen. Termasuk koleksi buku digital yang telah Anda beli.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center justify-center bg-rose-500 hover:bg-rose-600 text-white font-bold py-2.5 px-6 rounded-xl shadow-sm transition-all focus:ring-4 focus:ring-rose-500/30 outline-none"
    >
        Hapus Akun Permanen
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-slate-800 mb-2">
                Apakah Anda yakin ingin menghapus akun?
            </h2>

            <p class="text-sm text-slate-500 mb-6">
                Setelah akun Anda dihapus, semua data dan koleksi buku digital Anda akan hilang secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi penghapusan akun.
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Kata Sandi</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all w-full text-slate-900"
                    placeholder="Masukkan Kata Sandi Anda"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-rose-500" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-colors">
                    Batal
                </button>

                <button type="submit" class="px-6 py-2.5 bg-rose-500 text-white font-bold rounded-xl shadow-sm hover:bg-rose-600 transition-colors">
                    Ya, Hapus Akun Saya
                </button>
            </div>
        </form>
    </x-modal>
</section>
