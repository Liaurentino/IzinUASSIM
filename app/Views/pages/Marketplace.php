<div class="space-y-8">
    <div class="main-card p-8 rounded-2xl shadow-xl transition duration-300 space-y-6">
        <h2 class="text-3xl font-bold text-text-dark">Marketplace</h2>
        
        <div class="flex items-center space-x-4">
            <div class="flex-grow flex items-center bg-white border border-gray-300 rounded-xl shadow-inner overflow-hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Cari disini" class="w-full px-4 py-3 focus:outline-none text-text-dark">
            </div>
            <button class="bg-secondary-purple text-white p-3 rounded-xl shadow-lg hover:bg-opacity-90 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-4.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
            </button>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6 pt-4">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <a href="<?= base_url('marketplace/detail/' . esc($product['id'])) ?>" class="group bg-white p-4 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:scale-105 border border-gray-200">
                        <div class="relative overflow-hidden rounded-lg mb-3">
                            <img src="<?= esc($product['image_url']) ?>" alt="<?= esc($product['name']) ?>" class="w-full h-32 object-cover transition-transform duration-300 group-hover:scale-110">
                        </div>
                        <h3 class="text-md font-semibold text-text-dark truncate mt-2"><?= esc($product['name']) ?></h3>
                        <p class="text-lg font-bold text-primary-blue mt-1">Rp. <?= number_format(esc($product['price']), 0, ',', '.') ?></p>
                        <p class="text-xs text-gray-500 mt-1"><?= esc($product['sold_count']) ?>+ Terjual • <span class="text-yellow-500">★ <?= esc($product['rating']) ?></span></p>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="col-span-full text-center text-gray-500">Tidak ada produk ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>
</div>