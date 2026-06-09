<x-app-layout :hideNavbar="true">
    <x-user-navbar />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Back Link -->
        <div class="mb-8">
            <a href="{{ route('catalog.index') }}" class="inline-flex items-center text-slate-500 hover:text-lumina-blue font-semibold transition-colors">
                <x-heroicon-o-arrow-left class="mr-2 size-5" /> Kembali Belanja
            </a>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl shadow-sm mb-8 flex items-center" role="alert">
                <x-heroicon-s-check-circle class="mr-3 size-6" />
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Side: Invoice Details -->
            <div class="lg:w-2/3">
                <div class="bg-white border border-slate-200 shadow-sm rounded-3xl p-6 md:p-10">
                    <div class="flex flex-wrap justify-between items-start border-b border-slate-100 pb-6 mb-6 gap-4">
                        <div>
                            <span class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-2 block">Invoice Transaksi</span>
                            <h2 class="font-serif font-bold text-lumina-blue text-3xl mb-2">#INV-{{ str_pad((string)$order->id, 5, '0', STR_PAD_LEFT) }}</h2>
                            <p class="text-slate-500 text-sm flex items-center"><x-heroicon-o-calendar class="mr-2 size-5" />{{ $order->tanggal_pesan->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            @if ($order->status === 'verified')
                                <span class="inline-flex items-center bg-emerald-50 text-emerald-600 px-4 py-2 rounded-full font-bold text-sm"><x-heroicon-s-check-badge class="mr-2 size-5" />Selesai / Terverifikasi</span>
                            @elseif ($order->status === 'cancelled')
                                <span class="inline-flex items-center bg-rose-50 text-rose-600 px-4 py-2 rounded-full font-bold text-sm"><x-heroicon-s-x-circle class="mr-2 size-5" />Dibatalkan</span>
                            @else
                                <span class="inline-flex items-center bg-amber-50 text-amber-600 px-4 py-2 rounded-full font-bold text-sm"><x-heroicon-o-clock class="mr-2 size-5" />Menunggu Verifikasi</span>
                            @endif
                        </div>
                    </div>

                    <!-- Items List -->
                    <h5 class="font-bold text-slate-800 text-xl mb-4">Item Pembelian</h5>
                    <div class="border border-slate-200 rounded-2xl overflow-hidden mb-8">
                        @foreach ($order->orderDetails as $detail)
                            <div class="p-4 sm:p-5 flex items-center justify-between border-b border-slate-100 last:border-0 hover:bg-slate-50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="bg-lumina-blue/10 rounded-xl flex items-center justify-center shrink-0 w-12 h-16">
                                        <x-heroicon-o-book-open class="text-lumina-blue size-6" />
                                    </div>
                                    <div>
                                        <h6 class="font-bold text-slate-800 text-lg mb-1">{{ $detail->book->judul ?? 'Buku Tidak Tersedia' }}</h6>
                                        <p class="text-slate-500 text-sm">Oleh: <span class="font-semibold">{{ $detail->book->penulis ?? '-' }}</span></p>
                                    </div>
                                </div>
                                <span class="font-bold text-lumina-blue text-lg whitespace-nowrap ml-4">Rp {{ number_format($detail->harga_saat_beli, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Calculation -->
                    <div class="flex justify-between items-center border-t border-slate-100 pt-6">
                        <span class="text-slate-600 font-bold text-lg">Total Pembayaran</span>
                        <span class="font-bold text-lumina-blue text-3xl">Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}</span>
                    </div>

                    <!-- Payment Information Instructions -->
                    @if ($order->status === 'pending')
                        <div class="mt-10 p-6 sm:p-8 rounded-3xl bg-slate-50 border border-slate-200">
                            <h5 class="font-bold text-lumina-blue text-xl mb-4 flex items-center"><x-heroicon-o-building-library class="mr-3 size-8" />Instruksi Pembayaran</h5>
                            <p class="text-slate-600 mb-6">Silakan lakukan transfer dana sesuai total tagihan di atas ke salah satu rekening pembayaran resmi Lumina Media berikut:</p>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <span class="inline-block bg-lumina-blue text-white text-xs font-bold px-2.5 py-1 rounded-md mb-3">BANK BCA</span>
                                    <div class="font-bold text-slate-800 text-2xl mb-1 tracking-tight" id="bca-num">123-456-7890</div>
                                    <p class="text-slate-500 text-sm">a/n PT Lumina Media Nusantara</p>
                                </div>
                                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                                    <span class="inline-block bg-amber-400 text-amber-900 text-xs font-bold px-2.5 py-1 rounded-md mb-3">GOPAY / OVO</span>
                                    <div class="font-bold text-slate-800 text-2xl mb-1 tracking-tight">0812-3456-7890</div>
                                    <p class="text-slate-500 text-sm">a/n PT Lumina Media Nusantara</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Side: Proof Upload Form / Proof Status -->
            <div class="lg:w-1/3">
                <div class="bg-white border border-slate-200 shadow-sm rounded-3xl p-6 md:p-8 sticky top-24">
                    @if ($order->status === 'verified')
                        <div class="text-center py-6">
                            <div class="bg-emerald-50 text-emerald-600 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                                <x-heroicon-s-check-badge class="size-12" />
                            </div>
                            <h5 class="font-bold text-emerald-600 text-xl mb-3">Transaksi Selesai</h5>
                            <p class="text-slate-500 mb-8">Pembayaran Anda telah diverifikasi oleh admin. Buku digital Anda sudah siap dibaca!</p>
                            <a href="{{ route('collection.index') }}" class="flex items-center justify-center w-full bg-emerald-600 text-white font-bold py-3.5 px-4 rounded-xl shadow-sm hover:bg-emerald-700 transition-all">
                                <x-heroicon-o-bookmark class="mr-2 size-6" /> Akses Koleksi Saya
                            </a>
                        </div>
                    @elseif ($order->status === 'cancelled')
                        <div class="text-center py-6">
                            <div class="bg-rose-50 text-rose-500 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                                <x-heroicon-s-x-circle class="size-12" />
                            </div>
                            <h5 class="font-bold text-rose-500 text-xl mb-3">Pesanan Dibatalkan</h5>
                            <p class="text-slate-500">Pesanan ini telah dibatalkan karena kendala transaksi atau waktu pembayaran habis.</p>
                        </div>
                    @else
                        <!-- Order is Pending -->
                        @if ($order->payment)
                            <!-- Payment receipt uploaded, waiting for verification -->
                            <div class="text-center py-6">
                                <div class="bg-amber-50 text-amber-500 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                                    <x-heroicon-o-clock class="size-12" />
                                </div>
                                <h5 class="font-bold text-amber-500 text-xl mb-3">Menunggu Verifikasi</h5>
                                <p class="text-slate-500 mb-6">Bukti transfer Anda menggunakan metode <span class="font-bold text-slate-800">{{ $order->payment->metode_pembayaran }}</span> telah kami terima. Kami akan segera memeriksa transaksi Anda.</p>
                                
                                <div class="border border-slate-200 rounded-2xl overflow-hidden shadow-sm bg-slate-50 mb-6">
                                    <div class="py-2.5 bg-slate-100 text-slate-600 text-sm font-bold border-b border-slate-200">Bukti Pembayaran Anda</div>
                                    <div class="p-4 flex justify-center">
                                        <img src="{{ asset('storage/' . $order->payment->file_bukti) }}" alt="Bukti Pembayaran" class="max-w-full h-auto max-h-64 object-contain rounded-lg border border-slate-200">
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <span class="text-slate-500 text-sm block mb-3">Butuh mengunggah ulang bukti?</span>
                                    <button @click="document.getElementById('upload-box').classList.toggle('hidden')" class="px-4 py-2 border border-slate-300 rounded-lg text-slate-600 font-semibold text-sm hover:bg-slate-50 transition-colors">
                                        Unggah Ulang
                                    </button>
                                </div>
                            </div>
                        @endif

                        <!-- Payment Upload Form (hidden if uploaded, but shown by default if not) -->
                        <div id="upload-box" class="{{ $order->payment ? 'hidden mt-8 pt-8 border-t border-slate-100' : '' }}">
                            <h5 class="font-bold text-slate-800 text-xl mb-6 flex items-center"><x-heroicon-o-cloud-arrow-up class="mr-3 text-lumina-blue size-5" />Konfirmasi Pembayaran</h5>
                            
                            <form action="{{ route('orders.uploadPayment', $order->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <!-- Payment Method Select -->
                                <div class="mb-5">
                                    <label for="metode_pembayaran" class="block font-bold text-slate-700 text-sm mb-2">Metode Pembayaran <span class="text-rose-500">*</span></label>
                                    <select name="metode_pembayaran" id="metode_pembayaran" class="w-full bg-slate-50 border @error('metode_pembayaran') border-rose-500 @else border-slate-300 @enderror text-slate-900 rounded-xl focus:ring-lumina-blue focus:border-lumina-blue block py-3 px-4 transition-colors" required>
                                        <option value="" disabled selected>-- Pilih Rekening Tujuan --</option>
                                        <option value="Transfer Bank BCA" {{ (old('metode_pembayaran') ?? ($order->payment->metode_pembayaran ?? '')) === 'Transfer Bank BCA' ? 'selected' : '' }}>Transfer Bank BCA</option>
                                        <option value="Gopay / OVO E-Wallet" {{ (old('metode_pembayaran') ?? ($order->payment->metode_pembayaran ?? '')) === 'Gopay / OVO E-Wallet' ? 'selected' : '' }}>Gopay / OVO E-Wallet</option>
                                    </select>
                                    <p class="text-slate-500 text-xs mt-1.5 font-medium">Pilih bank/layanan yang Anda tuju untuk transfer.</p>
                                    @error('metode_pembayaran')
                                        <p class="text-rose-500 text-sm mt-2 flex items-center"><x-heroicon-o-exclamation-circle class="mr-1.5 size-5" />{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- File Upload -->
                                <div class="mb-8">
                                    <label for="file_bukti" class="block font-bold text-slate-700 text-sm mb-2">Unggah Bukti Transfer <span class="text-rose-500">*</span></label>
                                    <input type="file" name="file_bukti" id="file_bukti" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-lumina-blue/10 file:text-lumina-blue hover:file:bg-lumina-blue/20 transition-all border @error('file_bukti') border-rose-500 @else border-slate-300 @enderror rounded-xl bg-slate-50" accept=".jpg,.jpeg,.png" required>
                                    <p class="text-slate-500 text-xs mt-2 font-medium">Hanya format JPG, JPEG, atau PNG (Maksimal 2MB).</p>
                                    @error('file_bukti')
                                        <p class="text-rose-500 text-sm mt-2 flex items-center"><x-heroicon-o-exclamation-circle class="mr-1.5 size-5" />{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="w-full flex items-center justify-center bg-blue-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-sm transition-all hover:opacity-90">
                                    Kirim Konfirmasi
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
