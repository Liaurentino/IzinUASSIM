<!-- ========================================== -->
<!-- app/Views/merchant/products.php - Product List -->
<!-- ========================================== -->

<div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-2xl font-bold text-text-dark">Kelola Produk</h3>
        <a href="<?= base_url('merchant/dashboard/products/add') ?>" class="bg-gradient-to-r from-primary-blue to-secondary-purple text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition duration-300 transform hover:scale-105 flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tambah Produk Baru</span>
        </a>
    </div>

    <?php if (!empty($products)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($products as $product): ?>
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="<?= esc($product['image_url']) ?>" alt="<?= esc($product['name']) ?>" class="w-full h-48 object-cover">
                    <div class="p-4 space-y-3">
                        <h4 class="font-bold text-lg text-text-dark truncate"><?= esc($product['name']) ?></h4>
                        <p class="text-sm text-gray-600 line-clamp-2"><?= esc($product['description']) ?></p>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-primary-blue">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
                            <span class="text-sm text-gray-500">Stok: <?= esc($product['stock']) ?></span>
                        </div>
                        
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <span>★ <?= esc($product['rating']) ?></span>
                            <span>•</span>
                            <span><?= esc($product['sold_count']) ?> Terjual</span>
                        </div>
                        
                        <div class="flex space-x-2 pt-2">
                            <a href="<?= base_url('merchant/dashboard/products/edit/' . $product['id']) ?>" class="flex-1 bg-primary-blue text-white py-2 rounded-lg text-center hover:bg-opacity-90 transition duration-200">
                                Edit
                            </a>
                            <form action="<?= base_url('merchant/dashboard/products/delete/' . $product['id']) ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="flex-1">
                                <button type="submit" class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition duration-200">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-16">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <p class="mt-4 text-xl text-gray-500">Belum ada produk</p>
            <p class="text-gray-400 mt-2">Mulai tambahkan produk untuk ditampilkan di marketplace</p>
        </div>
    <?php endif; ?>
</div>


<!-- ========================================== -->
<!-- app/Views/merchant/add_product.php -->
<!-- ========================================== -->

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <h3 class="text-2xl font-bold text-text-dark mb-6">Tambah Produk Baru</h3>

        <?= form_open(base_url('merchant/dashboard/products/store'), ['class' => 'space-y-6']) ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Produk -->
                <div>
                    <label for="name" class="block text-sm font-medium text-text-dark mb-2">Nama Produk *</label>
                    <input type="text" id="name" name="name" value="<?= old('name') ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent"
                           placeholder="Contoh: Laptop Asus ROG">
                    <?php if ($validation->getError('name')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('name')) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Harga -->
                <div>
                    <label for="price" class="block text-sm font-medium text-text-dark mb-2">Harga *</label>
                    <input type="number" id="price" name="price" value="<?= old('price') ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent"
                           placeholder="15000000">
                    <?php if ($validation->getError('price')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('price')) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-medium text-text-dark mb-2">Deskripsi Produk *</label>
                <textarea id="description" name="description" rows="4" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent"
                          placeholder="Deskripsikan produk Anda dengan detail..."><?= old('description') ?></textarea>
                <?php if ($validation->getError('description')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('description')) ?></p>
                <?php endif; ?>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Stok -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-text-dark mb-2">Stok *</label>
                    <input type="number" id="stock" name="stock" value="<?= old('stock') ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent"
                           placeholder="10">
                    <?php if ($validation->getError('stock')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('stock')) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Varian -->
                <div>
                    <label for="variant" class="block text-sm font-medium text-text-dark mb-2">Varian</label>
                    <input type="text" id="variant" name="variant" value="<?= old('variant') ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent"
                           placeholder="Warna, Ukuran, dll">
                    <?php if ($validation->getError('variant')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('variant')) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Lokasi -->
                <div>
                    <label for="location" class="block text-sm font-medium text-text-dark mb-2">Lokasi *</label>
                    <input type="text" id="location" name="location" value="<?= old('location') ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent"
                           placeholder="Jakarta">
                    <?php if ($validation->getError('location')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('location')) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Image URL -->
            <div>
                <label for="image_url" class="block text-sm font-medium text-text-dark mb-2">URL Gambar</label>
                <input type="url" id="image_url" name="image_url" value="<?= old('image_url') ?>" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent"
                       placeholder="https://example.com/image.jpg">
                <p class="text-xs text-gray-500 mt-1">Kosongkan untuk menggunakan gambar default</p>
                <?php if ($validation->getError('image_url')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('image_url')) ?></p>
                <?php endif; ?>
            </div>

            <!-- Buttons -->
            <div class="flex space-x-4 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-primary-blue to-secondary-purple text-white py-3 rounded-xl font-semibold hover:shadow-lg transition duration-300">
                    Simpan Produk
                </button>
                <a href="<?= base_url('merchant/dashboard/products') ?>" class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-xl font-semibold text-center hover:bg-gray-300 transition duration-200">
                    Batal
                </a>
            </div>

        <?= form_close() ?>
    </div>
</div>


<!-- ========================================== -->
<!-- app/Views/merchant/edit_product.php -->
<!-- ========================================== -->

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <h3 class="text-2xl font-bold text-text-dark mb-6">Edit Produk</h3>

        <?= form_open(base_url('merchant/dashboard/products/update/' . $product['id']), ['class' => 'space-y-6']) ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Produk -->
                <div>
                    <label for="name" class="block text-sm font-medium text-text-dark mb-2">Nama Produk *</label>
                    <input type="text" id="name" name="name" value="<?= old('name', $product['name']) ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent">
                    <?php if ($validation->getError('name')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('name')) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Harga -->
                <div>
                    <label for="price" class="block text-sm font-medium text-text-dark mb-2">Harga *</label>
                    <input type="number" id="price" name="price" value="<?= old('price', $product['price']) ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent">
                    <?php if ($validation->getError('price')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('price')) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-medium text-text-dark mb-2">Deskripsi Produk *</label>
                <textarea id="description" name="description" rows="4" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent"><?= old('description', $product['description']) ?></textarea>
                <?php if ($validation->getError('description')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('description')) ?></p>
                <?php endif; ?>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Stok -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-text-dark mb-2">Stok *</label>
                    <input type="number" id="stock" name="stock" value="<?= old('stock', $product['stock']) ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent">
                    <?php if ($validation->getError('stock')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('stock')) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Varian -->
                <div>
                    <label for="variant" class="block text-sm font-medium text-text-dark mb-2">Varian</label>
                    <input type="text" id="variant" name="variant" value="<?= old('variant', $product['variant']) ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent">
                    <?php if ($validation->getError('variant')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('variant')) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Lokasi -->
                <div>
                    <label for="location" class="block text-sm font-medium text-text-dark mb-2">Lokasi *</label>
                    <input type="text" id="location" name="location" value="<?= old('location', $product['location']) ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent">
                    <?php if ($validation->getError('location')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('location')) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Image URL -->
            <div>
                <label for="image_url" class="block text-sm font-medium text-text-dark mb-2">URL Gambar</label>
                <input type="url" id="image_url" name="image_url" value="<?= old('image_url', $product['image_url']) ?>" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent">
                <?php if ($validation->getError('image_url')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('image_url')) ?></p>
                <?php endif; ?>
            </div>

            <!-- Preview Current Image -->
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-sm font-medium text-gray-700 mb-2">Preview Gambar Saat Ini:</p>
                <img src="<?= esc($product['image_url']) ?>" alt="Product" class="w-48 h-32 object-cover rounded-lg">
            </div>

            <!-- Buttons -->
            <div class="flex space-x-4 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-primary-blue to-secondary-purple text-white py-3 rounded-xl font-semibold hover:shadow-lg transition duration-300">
                    Update Produk
                </button>
                <a href="<?= base_url('merchant/dashboard/products') ?>" class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-xl font-semibold text-center hover:bg-gray-300 transition duration-200">
                    Batal
                </a>
            </div>

        <?= form_close() ?>
    </div>
</div>