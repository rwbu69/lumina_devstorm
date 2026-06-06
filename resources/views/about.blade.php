<x-app-layout :hideNavbar="true">
    <x-user-navbar />
    
    <div class="min-h-screen bg-[#FDFBF7] font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            
            {{-- Section 1: Hero --}}
            <div class="relative rounded-[2.5rem] p-16 md:p-28 text-center mb-24 overflow-hidden border border-amber-100/50 shadow-sm">
                <!-- Subtle Gold Radial Gradient Background -->
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-amber-100/60 via-amber-50/20 to-white"></div>
                
                <div class="relative z-10">
                    <h1 class="text-5xl md:text-7xl font-serif text-slate-800 mb-8 italic tracking-tight">Terang bagi Pikiran,<br>Damai bagi Jiwa.</h1>
                    <p class="text-slate-600 text-lg md:text-2xl max-w-3xl mx-auto font-light leading-relaxed">
                        Menghadirkan literatur teologi yang mendalam untuk menerangi perjalanan iman Anda.
                    </p>
                </div>
            </div>

            {{-- Section 2: Tentang Kami & Visi Misi --}}
            <div class="mb-32">
                <div class="text-center mb-20">
                    <p class="text-amber-600 font-bold tracking-[0.2em] text-sm uppercase mb-4">Tentang Kami</p>
                    <h2 class="text-4xl md:text-5xl font-serif text-slate-800 mb-10 tracking-tight">Menyebarkan Cahaya Teologi</h2>
                    <p class="text-slate-600 text-lg md:text-xl max-w-4xl mx-auto leading-relaxed font-light">
                        Lumina Media hadir dari kerinduan untuk menyediakan sumber daya literatur Kristen yang berakar kuat pada tradisi teologi klasik dan kontemporer. Kami percaya bahwa membaca bukan sekadar aktivitas intelektual, melainkan sarana ibadah untuk mengenal Sang Kebenaran lebih dalam. Di setiap halaman yang kami kurasi, terdapat harapan untuk membawa pencerahan bagi gereja dan masyarakat di Indonesia.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-16 md:gap-24 mt-24 max-w-5xl mx-auto items-start">
                    <div class="bg-white p-12 rounded-[2rem] border border-slate-100 shadow-sm h-full">
                        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-8">
                            <x-heroicon-o-eye class="size-8" />
                        </div>
                        <h3 class="text-3xl font-serif text-slate-800 mb-6">Visi</h3>
                        <p class="text-slate-600 italic text-lg leading-relaxed">"Lorem Ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel sapien sit amet erat vestibulum tristique."</p>
                    </div>
                    <div class="bg-white p-12 rounded-[2rem] border border-slate-100 shadow-sm h-full">
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-8">
                            <x-heroicon-o-viewfinder-circle class="size-8" />
                        </div>
                        <h3 class="text-3xl font-serif text-slate-800 mb-6">Misi</h3>
                        <ul class="space-y-4 text-slate-600 text-lg font-light">
                            <li class="flex items-start">
                                <x-heroicon-o-check class="text-indigo-600 mt-1.5 mr-4 size-5" />
                                <span>Lorem Ipsum dolor sit amet, consectetur adipiscing elit.</span>
                            </li>
                            <li class="flex items-start">
                                <x-heroicon-o-check class="text-indigo-600 mt-1.5 mr-4 size-5" />
                                <span>Curabitur vel sapien sit amet erat vestibulum tristique.</span>
                            </li>
                            <li class="flex items-start">
                                <x-heroicon-o-check class="text-indigo-600 mt-1.5 mr-4 size-5" />
                                <span>Proin gravida, mi id convallis rhoncus, nulla.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Section 3: Nilai-Nilai Kami --}}
            <div class="bg-white rounded-[3rem] p-16 md:p-24 text-center border border-slate-100 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-amber-50 rounded-full blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-50 rounded-full blur-3xl opacity-50 translate-y-1/2 -translate-x-1/2"></div>
                
                <div class="relative z-10">
                    <p class="text-indigo-600 font-bold tracking-[0.2em] text-sm uppercase mb-4">Prinsip Kami</p>
                    <h2 class="text-4xl md:text-5xl font-serif text-slate-800 mb-20 tracking-tight">Nilai-Nilai Kami</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                        <div class="flex flex-col items-center group">
                            <div class="w-20 h-20 bg-slate-50 group-hover:bg-indigo-50 transition-colors rounded-full flex items-center justify-center mb-8">
                                <x-heroicon-o-book-open class="size-10 text-indigo-900 group-hover:text-indigo-600 transition-colors" />
                            </div>
                            <h4 class="text-2xl font-serif text-slate-800 mb-4">Nilai 1</h4>
                            <p class="text-slate-500 font-light leading-relaxed">Penjelasan singkat mengenai nilai pertama yang menjadi pondasi utama kami.</p>
                        </div>
                        <div class="flex flex-col items-center group">
                            <div class="w-20 h-20 bg-slate-50 group-hover:bg-amber-50 transition-colors rounded-full flex items-center justify-center mb-8">
                                <x-heroicon-o-star class="size-10 text-amber-700 group-hover:text-amber-600 transition-colors" />
                            </div>
                            <h4 class="text-2xl font-serif text-slate-800 mb-4">Nilai 2</h4>
                            <p class="text-slate-500 font-light leading-relaxed">Penjelasan singkat mengenai nilai kedua yang memandu setiap langkah kami.</p>
                        </div>
                        <div class="flex flex-col items-center group">
                            <div class="w-20 h-20 bg-slate-50 group-hover:bg-indigo-50 transition-colors rounded-full flex items-center justify-center mb-8">
                                <x-heroicon-o-light-bulb class="size-10 text-indigo-900 group-hover:text-indigo-600 transition-colors" />
                            </div>
                            <h4 class="text-2xl font-serif text-slate-800 mb-4">Nilai 3</h4>
                            <p class="text-slate-500 font-light leading-relaxed">Penjelasan singkat mengenai nilai ketiga yang menjadi tujuan akhir kami.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    <div class="border-t border-slate-200 py-10 font-sans bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logolumina.svg') }}" alt="Logo Lumina" class="w-6 h-6 grayscale opacity-70">
                <span class="font-bold text-lg tracking-widest font-serif text-slate-400 uppercase">Lumina Media</span>
            </div>
            <span class="text-slate-400 text-sm font-light">© {{ date('Y') }} Lumina Media. Hak Cipta Dilindungi.</span>
        </div>
    </div>
</x-app-layout>
