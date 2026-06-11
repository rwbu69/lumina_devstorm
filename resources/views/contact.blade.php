<x-app-layout :hideNavbar="true" title="Hubungi Kami" meta_description="Hubungi tim Lumina Media untuk pertanyaan, kerjasama, atau bantuan seputar pemesanan buku digital rohani.">
    <x-user-navbar />
    
    <div class="min-h-screen bg-[#FDFBF7] font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            
            <div class="mb-16">
                <h1 class="text-5xl md:text-6xl font-serif text-[#1e40af] mb-4">Hubungi Kami</h1>
                <p class="text-slate-500 text-lg max-w-2xl">
                    Kami siap mendengarkan visi Anda. Mari berkolaborasi untuk menciptakan karya yang bermakna.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 md:gap-24">
                
                {{-- Left: Form --}}
                <div>
                    <form action="#" method="POST" class="space-y-10">
                        <div>
                            <label for="name" class="block text-xs font-bold text-[#60a5fa] uppercase tracking-widest mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" class="w-full bg-transparent border-0 border-b-2 border-[#93c5fd] focus:border-[#1e40af] focus:ring-0 px-0 py-2 text-slate-700 placeholder-slate-400 transition-colors">
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-bold text-[#60a5fa] uppercase tracking-widest mb-2">Email</label>
                            <input type="email" id="email" name="email" placeholder="nama@perusahaan.com" class="w-full bg-transparent border-0 border-b-2 border-[#93c5fd] focus:border-[#1e40af] focus:ring-0 px-0 py-2 text-slate-700 placeholder-slate-400 transition-colors">
                        </div>

                        <div>
                            <label for="message" class="block text-xs font-bold text-[#60a5fa] uppercase tracking-widest mb-2">Pesan</label>
                            <textarea id="message" name="message" rows="4" placeholder="Tuliskan detail proyek atau pertanyaan Anda" class="w-full bg-transparent border-0 border-b-2 border-[#93c5fd] focus:border-[#1e40af] focus:ring-0 px-0 py-2 text-slate-700 placeholder-slate-400 transition-colors resize-none"></textarea>
                        </div>

                        <div>
                            <button type="submit" class="bg-[#1e40af] hover:bg-[#1e3a8a] text-white text-sm font-bold tracking-wider py-4 px-10 transition-colors uppercase">
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Right: Contact Info --}}
                <div class="space-y-12 pt-2">
                    <div>
                        <p class="text-xs font-bold text-[#93c5fd] uppercase tracking-widest mb-2">Whatsapp</p>
                        <p class="text-2xl font-serif text-[#1e40af]">+62 812 3456 7890</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold text-[#93c5fd] uppercase tracking-widest mb-2">Email</p>
                        <p class="text-2xl font-serif text-[#1e40af]">halo@luminamedia.id</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold text-[#93c5fd] uppercase tracking-widest mb-2">Lokasi</p>
                        <p class="text-slate-500 leading-relaxed">
                            Gedung Senopati Suites, Lt. 12<br>
                            Jl. Senopati No. 41, Jakarta Selatan<br>
                            DKI Jakarta, Indonesia
                        </p>
                    </div>

                    <div class="pt-6">
                        <blockquote class="border-l-4 border-[#1e40af] pl-6 py-1">
                            <p class="text-lg italic text-[#60a5fa] font-serif">
                                "Every interaction is an opportunity to create something extraordinary."
                            </p>
                        </blockquote>
                    </div>
                </div>

            </div>

        </div>
    </div>
    
    <div class="border-t border-slate-200 py-8 font-sans bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <span class="font-bold text-lg tracking-tight font-serif text-[#1e40af] uppercase">Lumina Media</span>
            <span class="text-slate-400 text-sm">© {{ date('Y') }} Lumina Media. Hak Cipta Dilindungi.</span>
        </div>
    </div>
</x-app-layout>
