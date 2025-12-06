<!-- Halaman Detail Produk (Mengambil dari mockup 140449) -->
<div class="space-y-8">
    <div class="main-card p-8 rounded-2xl shadow-xl transition duration-300 space-y-6">
        <h2 class="text-3xl font-bold text-text-dark border-b pb-4 mb-4">Detail Produk</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Kolom Kiri: Gambar Produk -->
            <div class="lg:col-span-1">
                <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200">
                    <img src="<?= esc($product['image_url']) ?>" alt="<?= esc($product['name']) ?>" class="w-full rounded-lg object-cover">
                </div>
            </div>

            <!-- Kolom Tengah: Info Produk & Aksi -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Info Produk -->
                <div class="space-y-3">
                    <h1 class="text-4xl font-extrabold text-secondary-purple"><?= esc($product['name']) ?></h1>
                    <p class="text-sm text-gray-500"><?= esc($product['sold_count']) ?>+ Terjual • Rating <span class="text-yellow-500 font-bold">★ <?= esc($product['rating']) ?></span></p>
                    <p class="text-3xl font-bold text-primary-blue">Rp. <?= number_format(esc($product['price']), 0, ',', '.') ?></p>
                    <p class="text-sm font-medium text-gray-700">Stock: <span class="font-semibold text-green-600"><?= esc($product['stock']) ?></span></p>
                </div>
                
                <!-- Varian & Lokasi -->
                <div class="flex items-center space-x-4">
                    <span class="inline-block bg-primary-blue text-white text-xs font-semibold px-3 py-1 rounded-full"><?= esc($product['variant'] ?? 'Varian') ?></span>
                    <div class="flex items-center text-gray-600 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span><?= esc($product['location'] ?? 'Lokasi') ?></span>
                    </div>
                </div>

                <!-- Aksi Beli -->
                <div class="flex space-x-4 items-center">
                    <a href="#" class="bg-secondary-purple text-white py-3 px-8 rounded-xl font-bold text-lg shadow-lg hover:bg-opacity-90 transition duration-300">
                        Beli Langsung
                    </a>
                    
                    <div class="flex items-center space-x-1 border border-gray-300 rounded-xl shadow-inner overflow-hidden">
                        <button class="text-primary-blue text-xl px-4 py-2 hover:bg-gray-100 transition duration-300">-</button>
                        <span class="text-lg font-semibold text-text-dark px-2">1</span>
                        <button class="text-primary-blue text-xl px-4 py-2 hover:bg-gray-100 transition duration-300">+</button>
                    </div>
                    <button class="bg-primary-blue text-white py-3 px-8 rounded-xl font-bold text-lg shadow-lg hover:bg-opacity-90 transition duration-300">
                        Beli
                    </button>
                </div>
            </div>
            
            <!-- Deskripsi & Merchant -->
            <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
                <!-- Deskripsi Produk -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 space-y-3">
                    <h3 class="text-xl font-bold text-text-dark">Deskripsi</h3>
                    <p class="text-gray-700"><?= nl2br(esc($product['description'])) ?></p>
                </div>
                
                <!-- Info Merchant -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 space-y-3">
                    <h3 class="text-xl font-bold text-text-dark">Toko / Merchant</h3>
                    <div class="flex items-start space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary-purple flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1M5 21h14M7 3h10a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V5z" />
                        </svg>
                        <div>
                            <p class="font-semibold text-lg text-primary-blue"><?= esc($merchant['business_name'] ?? 'Merchant Tidak Ditemukan') ?></p>
                            <p class="text-sm text-gray-600"><?= nl2br(esc($merchant['address'] ?? '')) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>