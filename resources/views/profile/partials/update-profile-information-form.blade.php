<section>
    <header>
        <h2 class="text-xl font-bold text-slate-800">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Perbarui informasi profil akun Anda dan alamat email.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="nama" class="block font-medium text-sm text-slate-700 mb-1">Nama</label>
            <input id="nama" name="nama" type="text" class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all w-full text-slate-900" value="{{ old('nama', $user->nama) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
        </div>

        <div>
            <label for="email" class="block font-medium text-sm text-slate-700 mb-1">Email</label>
            <input id="email" name="email" type="email" class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all w-full text-slate-900" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-slate-800">
                        Alamat email Anda belum diverifikasi.

                        <button form="send-verification" class="underline text-sm text-slate-600 hover:text-slate-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lumina-blue">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-emerald-600">
                            Tautan verifikasi baru telah dikirim ke alamat email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="inline-flex items-center justify-center bg-lumina-blue hover:bg-blue-800 text-white font-bold py-2.5 px-6 rounded-xl shadow-sm transition-all focus:ring-4 focus:ring-lumina-blue/30 outline-none">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
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
