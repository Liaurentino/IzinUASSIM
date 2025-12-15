<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-primary-blue hover:shadow-xl transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Produk</p>
                <p class="text-3xl font-bold text-text-dark mt-2"><?= esc($total_products) ?></p>
            </div>
            <div class="w-14 h-14 bg-soft-blue rounded-full flex items-center justify-center">
                <i class="fas fa-box text-primary-blue text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-xl transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Reservasi Pending</p>
                <p class="text-3xl font-bold text-text-dark mt-2"><?= esc($pending_reservations) ?></p>
            </div>
            <div class="w-14 h-14 bg-yellow-50 rounded-full flex items-center justify-center">
                <i class="fas fa-clock text-yellow-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Terjual</p>
                <p class="text-3xl font-bold text-text-dark mt-2">28</p>
            </div>
            <div class="w-14 h-14 bg-green-50 rounded-full flex items-center justify-center">
                <i class="fas fa-chart-line text-green-500 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-gradient-to-br from-primary-blue to-secondary-purple rounded-2xl shadow-xl p-8 text-white hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-bold mb-2">Tambah Produk</h3>
                <p class="text-blue-100 mb-4">Tambahkan produk baru ke marketplace</p>
                <a href="<?= base_url('merchant/products/add') ?>" 
                   class="inline-block bg-white text-primary-blue px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Tambah Produk
                </a>
            </div>
            <i class="fas fa-box-open text-6xl opacity-20"></i>
        </div>
    </div>

    <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-2xl shadow-xl p-8 text-white hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-bold mb-2">Kelola Reservasi</h3>
                <p class="text-green-100 mb-4">Lihat dan kelola reservasi service</p>
                <a href="<?= base_url('merchant/reservations') ?>" 
                   class="inline-block bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-200">
                    <i class="fas fa-calendar-check mr-2"></i>Lihat Reservasi
                </a>
            </div>
            <i class="fas fa-calendar-alt text-6xl opacity-20"></i>
        </div>
    </div>
</div>

<?php if (!empty($recent_products)): ?>
<div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-text-dark">Produk Terbaru</h3>
        <a href="<?= base_url('merchant/products') ?>" class="text-primary-blue hover:text-secondary-purple font-semibold text-sm">
            Lihat Semua →
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Produk</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Harga</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Stok</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Terjual</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Rating</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach ($recent_products as $product): ?>
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-4 py-4">
                            <div class="flex items-center">
                                <img src="<?= esc($product['image_url']) ?>" 
                                     alt="<?= esc($product['name']) ?>" 
                                     class="w-12 h-12 rounded-lg object-cover mr-3">
                                <span class="font-medium text-gray-900"><?= esc($product['name']) ?></span>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-gray-700">Rp <?= number_format($product['price'], 0, ',', '.') ?></td>
                        <td class="px-4 py-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full <?= $product['stock'] > 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                <?= esc($product['stock']) ?>
                            </span>
                        </td>
                        <td class="px-4 py-4 text-gray-700"><?= esc($product['sold_count']) ?></td>
                        <td class="px-4 py-4">
                            <span class="text-yellow-500 font-semibold">
                                <i class="fas fa-star"></i> <?= esc($product['rating']) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php else: ?>
<div class="bg-white rounded-2xl shadow-lg p-12 text-center">
    <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
    <p class="text-gray-500 mb-4">Belum ada produk. Tambahkan produk pertama Anda!</p>
    <a href="<?= base_url('merchant/products/add') ?>" 
       class="inline-block bg-primary-blue text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition duration-200">
        <i class="fas fa-plus mr-2"></i>Tambah Produk
    </a>
</div>
<?php endif; ?>