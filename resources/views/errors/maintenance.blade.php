<x-app-layout :hideNavbar="true">
    <div class="min-h-screen flex items-center justify-center p-6 bg-[#FDFBF7]">
        <div class="max-w-lg w-full bg-white rounded-3xl shadow-sm border border-slate-200 p-8 md:p-12 text-center relative overflow-hidden">
            <!-- Decorative bg -->
            <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-lumina-blue/10 to-transparent"></div>
            
            <div class="relative z-10">
                <div class="w-20 h-20 bg-lumina-blue/10 text-lumina-blue rounded-full flex items-center justify-center mx-auto mb-8 shadow-sm border border-lumina-blue/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>

                <h1 class="text-3xl md:text-4xl font-serif font-bold text-lumina-blue mb-4 tracking-tight">Situs Sedang Diperbaiki</h1>
                <p class="text-slate-500 mb-10 text-lg leading-relaxed">
                    Mohon maaf atas ketidaknyamanan ini. Saat ini kami sedang melakukan pemeliharaan rutin untuk meningkatkan pengalaman Anda. Silakan kembali beberapa saat lagi.
                </p>

                <div class="border-t border-slate-100 pt-8 mt-2">
                    <p class="text-xs text-slate-400 mb-4 font-bold uppercase tracking-widest">Hanya untuk Admin / Superadmin</p>
                    <x-btn variant="primary" size="lg" href="{{ route('admin.login') }}" class="w-full text-base">
                        Masuk ke Dashboard
                    </x-btn>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
