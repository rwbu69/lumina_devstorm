@props(['id' => 'edit-book-modal'])

<div id="{{ $id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900/50">
    <div class="relative p-4 w-full max-w-3xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white font-serif">
                        Edit Detail Buku
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Ganti dan update informasi pada buku di Lumina Media</p>
                </div>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="{{ $id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="judul" class="block mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Judul Buku</label>
                        <input type="text" name="judul" id="judul" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Judul" required>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="penulis" class="block mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Penulis</label>
                        <input type="text" name="penulis" id="penulis" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Penulis" required>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="kategori" class="block mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Kategori</label>
                        <select id="kategori" name="kategori" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected>Klasik</option>
                            <option value="FI">Fiksi</option>
                            <option value="NF">Non-Fiksi</option>
                            <option value="ED">Edukasi</option>
                        </select>
                    </div>
                    <div class="col-span-2 sm:col-span-1 hidden sm:block"></div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="harga" class="block mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Harga (IDR)</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-500 bg-gray-50 border border-e-0 border-gray-300 rounded-s-md">
                                Rp
                            </span>
                            <input type="number" name="harga" id="harga" class="rounded-none rounded-e-md bg-white border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5" placeholder="125000">
                        </div>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="stok" class="block mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Stok</label>
                        <input type="number" name="stok" id="stok" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="24" required>
                    </div>

                    <div class="col-span-2">
                        <label for="sinopsis" class="block mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Sinopsis</label>
                        <textarea id="sinopsis" name="sinopsis" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-md border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Sinopsis"></textarea>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Upload Cover Baru</label>
                    <div class="flex items-start gap-4">
                        <!-- Current Cover Preview -->
                        <div class="w-32 h-40 bg-gray-300 rounded-md shrink-0 border border-gray-200 overflow-hidden flex items-center justify-center">
                            <span class="text-gray-400 text-xs">Preview</span>
                        </div>

                        <!-- Upload Area -->
                        <div class="flex items-center justify-center w-full h-40">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-full border-2 border-blue-200 border-dashed rounded-lg cursor-pointer bg-blue-50/30 hover:bg-blue-50">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-2 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-1 text-sm text-gray-500 font-semibold">Klik untuk ganti cover atau drag and drop</p>
                                    <p class="text-xs text-gray-400">SVG, PNG, JPG (Maks. 2MB)</p>
                                </div>
                                <input id="dropzone-file" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end border-t pt-4 mt-6 space-x-3">
                    <button type="button" class="text-gray-600 bg-transparent hover:bg-gray-100 font-bold rounded-lg text-sm px-5 py-2.5 text-center" data-modal-hide="{{ $id }}">
                        Batal
                    </button>
                    <button type="submit" class="text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 4.5V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6.5M10 2v4h4M4 8h8M4 11h8"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
