<x-admin.layout :title="'Lumina Media - Edit Buku'">
    <x-admin.section-header
        title="Edit Buku"
        subtitle="Perbarui informasi buku sebelum disimpan."
    >
        <a href="{{ route('admin.books.show', $book) }}" class="btn btn-light border rounded-3">
            <i class="bi bi-eye me-2"></i>
            Lihat
        </a>
        <a href="{{ route('admin.books.index') }}" class="btn btn-light border rounded-3">
            Kembali
        </a>
    </x-admin.section-header>

    <div class="mt-4"></div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="judul" class="form-label text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.5px;">Judul Buku</label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul" value="{{ old('judul', $book->judul) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="penulis" class="form-label text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.5px;">Penulis</label>
                        <input type="text" name="penulis" id="penulis" class="form-control" placeholder="Penulis" value="{{ old('penulis', $book->penulis) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="category_id" class="form-label text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.5px;">Kategori</label>
                        <select id="category_id" name="category_id" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @php
                                $categories = \App\Models\Category::all();
                            @endphp
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 d-none d-md-block"></div>

                    <div class="col-md-6">
                        <label for="harga" class="form-label text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.5px;">Harga (IDR)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted">Rp</span>
                            <input type="number" name="harga" id="harga" class="form-control" placeholder="125000" value="{{ old('harga', intval($book->harga)) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="stok" class="form-label text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.5px;">Stok</label>
                        <input type="number" name="stok" id="stok" class="form-control" placeholder="24" value="{{ old('stok', $book->stok) }}" required>
                    </div>

                    <div class="col-12">
                        <label for="sinopsis" class="form-label text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.5px;">Sinopsis</label>
                        <textarea id="sinopsis" name="sinopsis" rows="3" class="form-control" placeholder="Sinopsis">{{ old('sinopsis', $book->sinopsis) }}</textarea>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.5px;">Upload Cover Baru</label>
                    <div class="d-flex align-items-start gap-4">
                        <div class="bg-light rounded border d-flex align-items-center justify-content-center flex-shrink-0" style="width: 120px; height: 160px; overflow: hidden;">
                            @if($book->gambar)
                                <img src="{{ asset('storage/' . $book->gambar) }}" alt="Preview" class="w-100 h-100 object-fit-cover">
                            @else
                                <span class="text-muted small">Preview</span>
                            @endif
                        </div>

                        <div class="w-100">
                            <div class="border border-2 border-primary border-opacity-25 border-dashed rounded p-4 text-center bg-primary bg-opacity-10 w-100 h-100 d-flex flex-column align-items-center justify-content-center position-relative">
                                <i class="bi bi-cloud-upload text-primary fs-3 mb-2"></i>
                                <label for="gambar" class="fw-semibold text-secondary mb-1 stretched-link" style="cursor: pointer;">Klik untuk ganti cover atau drag and drop</label>
                                <span class="text-muted small">SVG, PNG, JPG (Maks. 2MB)</span>
                                <input class="position-absolute opacity-0" type="file" id="gambar" name="gambar" accept="image/*" style="width: 1px; height: 1px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end border-top pt-4 mt-4 gap-2">
                    <a href="{{ route('admin.books.index') }}" class="btn text-secondary fw-bold bg-transparent">Batal</a>
                    <button type="submit" class="btn btn-primary text-white d-inline-flex align-items-center px-4 shadow-sm" style="background-color: #1e3a8a; border-color: #1e3a8a;">
                        <i class="bi bi-save me-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin.layout>
