<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil - Lumina Media</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lora:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    
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

    <main class="flex-grow flex flex-col items-center justify-center text-center px-6 py-16">
        <div class="max-w-xl w-full flex flex-col items-center">
            
            <div class="w-16 h-16 bg-[#EDF3FF] rounded-full flex items-center justify-center text-[#0A5AD1] mb-6 shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
                </svg>
            </div>

            <h1 class="text-4xl md:text-5xl font-figma-serif text-[#112D4E] tracking-tight mb-3">Terima Kasih!</h1>
            <p class="text-xs md:text-sm font-bold text-[#0A5AD1] tracking-wide mb-6">Pembayaran Berhasil Dikonfirmasi</p>

            <div class="space-y-3 max-w-md text-gray-500 text-xs md:text-sm leading-relaxed mb-8">
                <p>
                    Terima kasih atas pesanan Anda. Kami akan segera memverifikasi bukti pembayaran Anda dalam waktu <span class="font-bold text-gray-800">1x24 jam</span>.
                </p>
                <p class="text-[11px] text-gray-400">
                    Anda dapat memantau status pesanan di halaman Profil atau Katalog Buku Saya.
                </p>
            </div>

            <div class="flex flex-row items-center justify-center gap-3 w-full">
                <a href="#" class="bg-[#0A5AD1] hover:bg-blue-700 text-white font-semibold text-xs px-5 py-3 rounded-xl transition shadow-md shadow-blue-600/20 whitespace-nowrap">
                    Lihat Koleksi Buku Saya
                </a>
                <a href="#" class="bg-white hover:bg-gray-50 border border-[#0A5AD1] text-[#0A5AD1] font-semibold text-xs px-5 py-3 rounded-xl transition whitespace-nowrap">
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </main>

</body>
</html>