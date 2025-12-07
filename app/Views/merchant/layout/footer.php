<!-- app/Views/merchant/layout/footer.php -->
        </div>
    </main>
</div>

</body>
</html>

<!-- ========================================== -->
<!-- app/Views/merchant/dashboard.php -->
<!-- ========================================== -->

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Products -->
    <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-primary-blue">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Produk</p>
                <p class="text-3xl font-bold text-text-dark mt-2"><?= esc($totalProducts) ?></p>
            </div>
            <div class="w-14 h-14 bg-soft-blue rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Reservations -->
    <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-secondary-purple">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Reservasi</p>
                <p class="text-3xl font-bold text-text-dark mt-2"><?= esc($totalReservations) ?></p>
            </div>
            <div class="w-14 h-14 bg-purple-50 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-secondary-purple" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Sold -->
    <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Terjual</p>
                <p class="text-3xl font-bold text-text-dark mt-2"><?= esc($totalSold) ?></p>
            </div>
            <div class="w-14 h-14 bg-green-50 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Recent Products -->
<div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-text-dark">Produk Terbaru</h3>
        <a href="<?= base_url('merchant/dashboard/products/add') ?>" class="bg-primary-blue text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition duration-200 flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tambah Produk</span>
        </a>
    </div>

    <?php if (!empty($recentProducts)): ?>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Produk</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Harga</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Stok</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Terjual</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Rating</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($recentProducts as $product): ?>
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <img src="<?= esc($product['image_url']) ?>" alt="<?= esc($product['name']) ?>" class="w-12 h-12 rounded-lg object-cover">
                                    <span class="ml-3 font-medium text-gray-900"><?= esc($product['name']) ?></span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-gray-700">Rp <?= number_format($product['price'], 0, ',', '.') ?></td>
                            <td class="px-4 py-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full <?= $product['stock'] > 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                    <?= esc($product['stock']) ?>
                                </span>
                            </td>
                            <td class="px-4 py-4 text-gray-700"><?= esc($product['sold_count']) ?></td>
                            <td class="px-4 py-4">
                                <span class="text-yellow-500">★ <?= esc($product['rating']) ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="text-center py-12">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <p class="mt-4 text-gray-500">Belum ada produk. Tambahkan produk pertama Anda!</p>
            <a href="<?= base_url('merchant/dashboard/products/add') ?>" class="mt-4 inline-block bg-primary-blue text-white px-6 py-2 rounded-lg hover:bg-opacity-90 transition duration-200">
                Tambah Produk
            </a>
        </div>
    <?php endif; ?>
</div>