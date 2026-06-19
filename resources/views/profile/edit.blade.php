<x-app-layout :hideNavbar="true" title="Profil Saya">
    <x-user-navbar />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-10">
            <h1 class="text-3xl font-serif font-bold text-slate-800 mb-3">Profil Saya</h1>
            <p class="text-slate-500 text-lg">Kelola informasi akun dan pengaturan keamanan Anda.</p>
        </div>

        <div class="space-y-8">
            <div class="bg-white border border-slate-200 shadow-sm rounded-3xl overflow-hidden p-8">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white border border-slate-200 shadow-sm rounded-3xl overflow-hidden p-8">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white border border-rose-200 shadow-sm rounded-3xl overflow-hidden p-8 relative">
                <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-bl-[100px] -z-10"></div>
                <div class="max-w-2xl z-10">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
