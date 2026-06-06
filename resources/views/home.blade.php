<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumina Media - Pusat Literatur Kristen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-md shadow-blue-200">L</div>
                <span class="text-xl font-bold text-blue-600 tracking-tight">Lumina <span class="text-amber-500">Media</span></span>
            </div>
            
            <div class="hidden md:flex space-x-8 font-medium text-sm text-gray-600">
                <a href="#" class="text-blue-600 border-b-2 border-blue-600 pb-1">Beranda</a>
                <a href="#" class="hover:text-blue-600 transition">Katalog</a>
                <a href="#" class="hover:text-blue-600 transition">Tentang Kami</a>
                <a href="#" class="hover:text-blue-600 transition">Kontak</a>
            </div>

            <div class="flex items-center space-x-4">
                <button class="text-gray-600 hover:text-blue-600 relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="absolute -top-1 -right-1 bg-amber-500 text-white text-xs w-4 h-4 rounded-full flex items-center justify-center font-bold">0</span>
                </button>
                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full text-sm font-semibold transition shadow-md shadow-blue-200">Masuk</a>
            </div>
        </div>
    </nav>

    <header class="max-w-7xl mx-auto px-6 py-12 lg:py-20 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-6">
            <h1 class="text-4xl lg:text-5xl font-black text-blue-900 leading-tight">
                Pusat Literatur <br><span class="text-blue-600">Kristen</span>
            </h1>
            <p class="text-gray-500 text-base lg:text-lg leading-relaxed max-w-md">
                Temukan koleksi buku rohani berkualitas, dari teologi mendalam hingga renungan harian yang memberkati kehidupan spiritual Anda.
            </p>
            <div class="flex flex-wrap gap-4 pt-2">
                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full font-semibold transition shadow-lg shadow-blue-200">Belanja Sekarang</a>
                <a href="#" class="border border-blue-600 text-blue-600 hover:bg-blue-50 px-6 py-3 rounded-full font-semibold transition">Lihat Katalog</a>
            </div>
        </div>
        <div class="flex justify-center lg:justify-end">
            <div class="w-full max-w-md aspect-[4/3] bg-gray-200 rounded-2xl flex items-center justify-center text-gray-400 font-bold tracking-widest text-lg shadow-inner">
                FOTO
            </div>
        </div>
    </header>

    <section class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex justify-between items-end mb-8">
            <h2 class="text-2xl font-bold text-blue-900 border-b-4 border-amber-400 pb-1">Buku Terbaru</h2>
            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-semibold flex items-center space-x-1 transition">
                <span>Lihat Semua</span>
                <span>&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($latestBooks as $book)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex flex-col justify-between hover:shadow-md transition">
                    <div class="w-full aspect-[3/4] bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden mb-4 shadow-sm">
                        @if($book->file_buku)
                            <img src="{{ asset('storage/' . $book->file_buku) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-400 text-xs font-bold tracking-wider">COVER</span>
                        @endif
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-bold text-gray-900 line-clamp-1">{{ $book->judul }}</h3>
                        <p class="text-xs text-gray-400">{{ $book->penulis }}</p>
                        <p class="text-xs font-medium text-amber-600 bg-amber-50 inline-block px-2 py-0.5 rounded">{{ $book->category->name ?? 'Umum' }}</p>
                        <p class="text-sm font-extrabold text-blue-600 pt-1">Rp {{ number_format($book->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                @for($i = 1; $i <= 4; $i++)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex flex-col justify-between">
                        <div class="w-full aspect-[3/4] bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                            <span class="text-gray-400 text-xs font-bold tracking-wider">COVER</span>
                        </div>
                        <div class="space-y-1">
                            <h3 class="font-bold text-blue-900">Judul</h3>
                            <p class="text-xs text-gray-400">Penulis / Author</p>
                            <p class="text-xs text-gray-400">Kategori</p>
                            <p class="text-sm font-extrabold text-blue-600 pt-1">Harga Barang</p>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-6 py-16 text-center space-y-4">
        <p class="text-sm font-semibold tracking-widest text-blue-500 uppercase">&mdash; AYAT ALKITAB &mdash;</p>
        <blockquote class="text-lg lg:text-xl font-medium text-blue-900 italic leading-relaxed">
            "Sebab Aku ini mengetahui rancangan-rancangan apa yang ada pada-Ku mengenai kamu, demikianlah firman TUHAN, yaitu rancangan damai sejahtera dan bukan rancangan kecelakaan, untuk memberikan kepadamu hari depan yang penuh harapan."
        </blockquote>
        <p class="text-xs font-bold text-amber-500">&mdash; Yeremia 29:11 &mdash;</p>
    </section>

    <footer class="bg-white border-t border-gray-100 mt-12">
        <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="space-y-4 col-span-2 md:col-span-1">
                <div class="flex items-center space-x-2">
                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-sm">L</div>
                    <span class="font-bold text-blue-600">Lumina Media</span>
                </div>
                <p class="text-xs text-gray-400 leading-relaxed">Toko Buku Kristen terpercaya yang menyediakan literatur rohani berkualitas untuk membangun iman jemaat di seluruh Indonesia.</p>
                <p class="text-xs text-gray-300">&copy; 2026 Lumina Media. Hak Cipta Dilindungi.</p>
            </div>
            
            <div class="space-y-3">
                <h4 class="font-bold text-sm text-gray-700">Kategori</h4>
                <ul class="text-xs text-gray-400 space-y-2">
                    <li><a href="#" class="hover:text-blue-600">Teologi</a></li>
                    <li><a href="#" class="hover:text-blue-600">Sains</a></li>
                    <li><a href="#" class="hover:text-blue-600">Opini</a></li>
                    <li><a href="#" class="hover:text-blue-600">Fiksi</a></li>
                </ul>
            </div>

            <div class="space-y-3">
                <h4 class="font-bold text-sm text-gray-700">Informasi</h4>
                <ul class="text-xs text-gray-400 space-y-2">
                    <li><a href="#" class="hover:text-blue-600">Karir</a></li>
                    <li><a href="#" class="hover:text-blue-600">Blog</a></li>
                </ul>
            </div>

            <div class="space-y-3">
                <h4 class="font-bold text-sm text-gray-700">Hubungi Kami</h4>
                <ul class="text-xs text-gray-400 space-y-2">
                    <li class="flex items-start space-x-1">
                        <span>📍</span>
                        <span>Jl. Mohammad Toha No. 11, Bandung</span>
                    </li>
                    <li class="flex items-center space-x-1">
                        <span>📞</span>
                        <span>0812-345-67823</span>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

</body>
</html>