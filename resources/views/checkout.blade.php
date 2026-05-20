<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Pemesanan - Lumina Media</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lora:wght@600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #FAF8F5;
        }
        .font-figma-serif {
            font-family: 'Lora', Georgia, serif;
        }
    </style>
</head>
<body class="text-[#112D4E] antialiased min-h-screen flex flex-col">

    <nav class="bg-white px-6 md:px-16 py-4 flex justify-between items-center border-b border-gray-100 shadow-xs">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-gradient-to-tr from-blue-600 to-amber-400 rounded-full flex items-center justify-center text-white font-bold text-[11px]"></div>
            <span class="text-base font-bold text-[#0F3661] tracking-tight">Lumina Media</span>
        </div>
        <div class="hidden md:flex items-center space-x-8 text-xs font-medium text-gray-400">
            <a href="#" class="hover:text-gray-900">Beranda</a>
            <a href="#" class="hover:text-gray-900">Katalog</a>
            <a href="#" class="hover:text-gray-900">Koleksi Saya</a>
            <a href="#" class="hover:text-gray-900">Kontak</a>
        </div>
        <div class="flex items-center space-x-4">
            <div class="relative p-1 text-gray-500 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"></path>
                </svg>
                <span class="absolute -top-1 -right-1 bg-amber-500 text-white font-bold text-[8px] w-3.5 h-3.5 rounded-full flex items-center justify-center">2</span>
            </div>
            <div class="w-8 h-8 bg-orange-100 border border-orange-200 rounded-full flex items-center justify-center text-orange-600 text-xs font-bold shadow-inner">U</div>
        </div>
    </nav>

    <main class="max-w-6xl w-full mx-auto px-6 md:px-12 py-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-start flex-grow">
        
        <div class="lg:col-span-5 space-y-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-figma-serif text-gray-900 tracking-tight mb-1">Rincian Pemesanan</h1>
                <p class="text-[11px] text-gray-400">Mohon cek dulu pesanan anda sebelum melakukan pembayaran</p>
            </div>

            <div class="space-y-3">
                <div class="bg-white border border-gray-100/80 rounded-2xl p-4 flex items-center justify-between shadow-[0_2px_8px_rgba(0,0,0,0.02)]">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-16 bg-gray-200 rounded-xl shrink-0"></div>
                        <div>
                            <h4 class="text-xs font-bold text-gray-800">Judul Buku 1</h4>
                            <p class="text-[9px] text-gray-400 font-semibold tracking-wider uppercase mt-0.5">KATEGORI</p>
                            <p class="text-[11px] text-gray-400 mt-2">Jumlah : 1</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-[#0A5AD1]">Rp 150.000</span>
                </div>

                <div class="bg-white border border-gray-100/80 rounded-2xl p-4 flex items-center justify-between shadow-[0_2px_8px_rgba(0,0,0,0.02)]">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-16 bg-gray-200 rounded-xl shrink-0"></div>
                        <div>
                            <h4 class="text-xs font-bold text-gray-800">Judul Buku 2</h4>
                            <p class="text-[9px] text-gray-400 font-semibold tracking-wider uppercase mt-0.5">KATEGORI</p>
                            <p class="text-[11px] text-gray-400 mt-2">Jumlah : 1</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-[#0A5AD1]">Rp 85.000</span>
                </div>
            </div>

            <div class="pt-2 space-y-2.5">
                <div class="flex justify-between text-xs text-gray-400">
                    <span>Subtotal</span>
                    <span class="font-medium">Rp 235.000</span>
                </div>
                <div class="border-t border-dashed border-gray-300 my-1"></div>
                <div class="flex justify-between items-center">
                    <span class="text-sm font-bold text-gray-900">Total</span>
                    <span class="text-base font-bold text-[#0A5AD1]">Rp 235.000</span>
                </div>
            </div>
        </div>

        <div class="lg:col-span-7 space-y-5">
            
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                
                <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-[0_4px_12px_rgba(0,0,0,0.01)] space-y-4 mb-5">
                    <h3 class="text-xs font-bold text-gray-800 tracking-wide">Informasi Kontak Pembayaran</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[9px] font-bold text-gray-400 tracking-wide uppercase">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap" required class="w-full text-xs px-3.5 py-2.5 border border-gray-200 rounded-xl text-gray-700 font-medium focus:outline-none focus:border-blue-500 transition">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-bold text-gray-400 tracking-wide uppercase">Email Address</label>
                            <input type="email" name="email" placeholder="budi@example.com" required class="w-full text-xs px-3.5 py-2.5 border border-gray-200 rounded-xl text-gray-700 font-medium focus:outline-none focus:border-blue-500 transition">
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[9px] font-bold text-gray-400 tracking-wide uppercase">WhatsApp Number</label>
                        <input type="text" name="no_whatsapp" placeholder="+62 812 3456 7890" required class="w-full text-xs px-3.5 py-2.5 border border-gray-200 rounded-xl text-gray-700 font-medium focus:outline-none focus:border-blue-500 transition">
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-[0_4px_12px_rgba(0,0,0,0.01)] space-y-4">
                    <div>
                        <h3 class="text-xs font-bold text-gray-800 tracking-wide">Metode Pembayaran</h3>
                        <p class="text-[9px] text-[#0A5AD1] font-bold uppercase tracking-widest mt-0.5">BANK TRANSFER</p>
                    </div>

                    <div class="border border-blue-200 rounded-2xl bg-[#F6F9FF] p-4 md:p-5 space-y-4">
                        <div class="flex items-center space-x-2">
                            <span class="bg-[#0A3D36] text-white px-2 py-0.5 text-[9px] font-bold rounded-sm tracking-wide">BCA</span>
                            <span class="text-xs font-bold text-gray-800">Bank Central Asia (BCA)</span>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                            <div>
                                <p class="text-[9px] font-bold text-gray-400 tracking-wide uppercase">NOMOR REKENING</p>
                                <div class="flex items-center space-x-1.5 mt-0.5">
                                    <span class="text-lg font-bold text-[#0F3661] tracking-wide">8690 1234 567</span>
                                    <svg class="w-3.5 h-3.5 text-[#0A5AD1] cursor-pointer" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold text-gray-400 tracking-wide uppercase">NAMA REKENING</p>
                                <p class="text-xs font-bold text-gray-800 mt-1.5">Lumina Media Group</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-2 text-[10px] md:text-[11px] text-gray-400 leading-relaxed pt-3 border-t border-gray-200/60">
                            <svg class="w-3.5 h-3.5 text-[#0A5AD1] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p>Silakan transfer sesuai dengan nominal <span class="font-semibold text-gray-600">Total</span> ke rekening di atas. Proses verifikasi manual memakan waktu maksimal 1x24 jam.</p>
                        </div>
                    </div>

                    <div class="flex justify-end pt-1">
                        <button type="submit" class="bg-[#0A5AD1] hover:bg-blue-700 text-white font-semibold text-xs px-5 py-3 rounded-xl transition flex items-center space-x-2 shadow-md shadow-blue-600/20">
                            <span>Konfirmasi Pembayaran</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </main>

</body>
</html>