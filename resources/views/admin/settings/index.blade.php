<x-admin.layout :title="'Pengaturan Website - Admin Panel'">
    <div x-data="{ showMaintenanceModal: false, currentStatus: '{{ $settings['is_maintenance_mode'] ?? 'false' }}' }">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Pengaturan Website</h1>
            <p class="text-slate-500 mt-1">Konfigurasi konten identitas, kontak, dan status website.</p>
        </div>

        <!-- Maintenance Mode Section (Top) -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-8">
            <div class="p-6 md:p-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-slate-900 mb-2">Mode Maintenance</h2>
                    <p class="text-slate-600 leading-relaxed">
                        Mode Maintenance digunakan untuk menutup akses publik (guest dan user reguler) ke seluruh halaman website. 
                        Ketika diaktifkan, pengunjung akan melihat halaman informasi bahwa situs sedang dalam perbaikan. 
                        Akses hanya akan diberikan kepada Admin dan Superadmin untuk keperluan pengujian dan perbaikan sistem.
                    </p>
                </div>
                <div class="shrink-0">
                    @if (($settings['is_maintenance_mode'] ?? 'false') == 'true')
                        <button @click="showMaintenanceModal = true" class="w-full md:w-auto bg-rose-50 text-rose-600 hover:bg-rose-100 border border-rose-200 px-6 py-3 rounded-xl font-bold shadow-sm transition-all text-center">
                            Mode Maintenance: AKTIF
                        </button>
                    @else
                        <button @click="showMaintenanceModal = true" class="w-full md:w-auto bg-white text-slate-700 hover:bg-slate-50 border border-slate-300 hover:border-slate-400 px-6 py-3 rounded-xl font-bold shadow-sm transition-all text-center">
                            Aktifkan Mode Maintenance
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <form action="{{ route('admin.settings.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Card Identitas -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-4">
                    <h3 class="text-lg font-bold text-slate-800">
                        Identitas & Hero Banner
                    </h3>
                    <p class="text-sm text-slate-500 mt-1">Atur nama website dan tampilan banner utama pada halaman beranda.</p>
                </div>
                
                <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Website <span class="text-rose-500">*</span></label>
                        <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'Lumina Media') }}" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl focus:ring-4 focus:ring-lumina-blue/10 focus:border-lumina-blue transition-all shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Hero Title</label>
                        <input type="text" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? 'Platform Penerbitan & Toko Buku Modern') }}" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl focus:ring-4 focus:ring-lumina-blue/10 focus:border-lumina-blue transition-all shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Hero Subtitle</label>
                        <textarea name="hero_subtitle" rows="2" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl focus:ring-4 focus:ring-lumina-blue/10 focus:border-lumina-blue transition-all shadow-sm">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? 'Temukan ratusan koleksi buku digital dan fisik terbaik untuk menemani perjalanan literasimu.') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Card Kontak -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-4">
                    <h3 class="text-lg font-bold text-slate-800">
                        Kontak & Informasi Footer
                    </h3>
                    <p class="text-sm text-slate-500 mt-1">Detail kontak yang akan dihubungi oleh pengguna dan deskripsi footer.</p>
                </div>
                
                <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Email Kontak</label>
                        <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? 'hello@lumina.id') }}" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl focus:ring-4 focus:ring-lumina-blue/10 focus:border-lumina-blue transition-all shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Telepon / WhatsApp</label>
                        <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '+62 812 3456 7890') }}" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl focus:ring-4 focus:ring-lumina-blue/10 focus:border-lumina-blue transition-all shadow-sm">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Singkat Footer</label>
                        <textarea name="footer_description" rows="3" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl focus:ring-4 focus:ring-lumina-blue/10 focus:border-lumina-blue transition-all shadow-sm">{{ old('footer_description', $settings['footer_description'] ?? 'Lumina Media adalah platform penerbitan dan toko buku yang menyediakan koleksi literatur berkualitas.') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-lumina-blue text-white px-8 py-3.5 rounded-xl font-bold hover:opacity-90 transition-colors shadow-sm hover:shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>

        <!-- Maintenance Mode Modal -->
        <div x-show="showMaintenanceModal" 
             style="display: none;" 
             class="fixed inset-0 z-9999 overflow-y-auto" 
             aria-labelledby="modal-title" 
             role="dialog" 
             aria-modal="true">
             
            <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                
                <!-- Dim Background -->
                <div x-show="showMaintenanceModal" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0" 
                     x-transition:enter-end="opacity-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100" 
                     x-transition:leave-end="opacity-0" 
                     class="fixed inset-0 bg-slate-900/75 transition-opacity" 
                     @click="showMaintenanceModal = false" 
                     aria-hidden="true"></div>

                <!-- Modal Panel -->
                <div x-show="showMaintenanceModal" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative inline-block bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg w-full border border-slate-200 align-middle">
                    
                    <div class="bg-white px-6 pt-8 pb-6 sm:px-8">
                        <div>
                            @if (($settings['is_maintenance_mode'] ?? 'false') == 'true')
                                <div class="mt-2 text-left">
                                    <h3 class="text-xl font-bold text-slate-900 mb-4" id="modal-title">Nonaktifkan Mode Maintenance?</h3>
                                    <div class="space-y-3">
                                        <p class="text-sm text-slate-600 leading-relaxed">Website akan kembali beroperasi secara normal dan seluruh pengunjung publik akan dapat mengakses halaman utama.</p>
                                        <p class="text-sm text-slate-600 leading-relaxed">Apakah Anda yakin ingin membuka akses publik sekarang?</p>
                                    </div>
                                </div>
                            @else
                                <div class="mt-2 text-left">
                                    <h3 class="text-xl font-bold text-slate-900 mb-4" id="modal-title">Aktifkan Mode Maintenance?</h3>
                                    <div class="space-y-3">
                                        <p class="text-sm text-slate-600 leading-relaxed">Saat diaktifkan, seluruh aktivitas transaksi akan ditangguhkan dan pengunjung umum tidak akan bisa mengakses website.</p>
                                        <p class="text-sm text-slate-600 leading-relaxed">Hanya <strong>Admin</strong> dan <strong>Superadmin</strong> yang masih dapat melakukan login. Lanjutkan?</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="bg-slate-50 px-6 py-4 sm:px-8 sm:flex sm:flex-row-reverse border-t border-slate-100 gap-3">
                        <form action="{{ route('admin.settings.store') }}" method="POST" class="w-full sm:w-auto">
                            @csrf
                            @if (($settings['is_maintenance_mode'] ?? 'false') == 'true')
                                <input type="hidden" name="is_maintenance_mode" value="false">
                                <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-5 py-2.5 bg-emerald-600 text-sm font-bold text-white hover:bg-emerald-700 focus:outline-none transition-colors">
                                    Buka Akses Publik
                                </button>
                            @else
                                <input type="hidden" name="is_maintenance_mode" value="true">
                                <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-5 py-2.5 bg-rose-600 text-sm font-bold text-white hover:bg-rose-700 focus:outline-none transition-colors">
                                    Aktifkan Mode
                                </button>
                            @endif
                        </form>
                        <button type="button" @click="showMaintenanceModal = false" class="mt-3 sm:mt-0 w-full inline-flex justify-center rounded-xl border border-slate-300 shadow-sm px-5 py-2.5 bg-white text-sm font-bold text-slate-700 hover:bg-slate-50 focus:outline-none transition-colors sm:w-auto">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
