<!-- ========================================== -->
<!-- app/Views/merchant/statistics.php -->
<!-- ========================================== -->

<div class="space-y-6">
    <!-- Revenue Card -->
    <div class="bg-gradient-to-r from-primary-blue to-secondary-purple rounded-2xl shadow-2xl p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-90">Total Pendapatan</p>
                <p class="text-4xl font-bold mt-2">Rp <?= number_format($totalRevenue, 0, ',', '.') ?></p>
                <p class="text-sm mt-2 opacity-75">Dari semua produk yang terjual</p>
            </div>
            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Products Performance -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h3 class="text-xl font-bold text-text-dark mb-6">Performa Produk</h3>
        
        <?php if (!empty($products)): ?>
            <div class="space-y-4">
                <?php foreach ($products as $product): 
                    $revenue = $product['price'] * $product['sold_count'];
                ?>
                    <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-3">
                                <img src="<?= esc($product['image_url']) ?>" alt="<?= esc($product['name']) ?>" class="w-16 h-16 rounded-lg object-cover">
                                <div>
                                    <h4 class="font-semibold text-gray-900"><?= esc($product['name']) ?></h4>
                                    <p class="text-sm text-gray-500">Harga: Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-primary-blue">Rp <?= number_format($revenue, 0, ',', '.') ?></p>
                                <p class="text-sm text-gray-500">Total Pendapatan</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-4 text-center text-sm">
                            <div class="bg-blue-50 rounded-lg p-2">
                                <p class="text-gray-600">Terjual</p>
                                <p class="font-bold text-primary-blue"><?= esc($product['sold_count']) ?></p>
                            </div>
                            <div class="bg-green-50 rounded-lg p-2">
                                <p class="text-gray-600">Stok</p>
                                <p class="font-bold text-green-600"><?= esc($product['stock']) ?></p>
                            </div>
                            <div class="bg-yellow-50 rounded-lg p-2">
                                <p class="text-gray-600">Rating</p>
                                <p class="font-bold text-yellow-600">★ <?= esc($product['rating']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <p class="text-gray-500">Belum ada data produk untuk ditampilkan</p>
            </div>
        <?php endif; ?>
    </div>
</div>


<!-- ========================================== -->
<!-- app/Views/merchant/profile.php -->
<!-- ========================================== -->

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-primary-blue to-secondary-purple p-8 text-white">
            <div class="flex items-center space-x-6">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold"><?= esc($merchant['business_name']) ?></h2>
                    <p class="text-blue-100 mt-1"><?= esc($merchant['business_type']) ?></p>
                    <div class="mt-2">
                        <span class="bg-green-400 text-green-900 px-3 py-1 rounded-full text-sm font-semibold">
                            <?= esc($merchant['status']) ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="p-8 space-y-8">
            <!-- Business Information -->
            <div>
                <h3 class="text-xl font-bold text-text-dark mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Informasi Bisnis
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-600 mb-1">Alamat</p>
                        <p class="font-medium text-gray-900"><?= esc($merchant['address']) ?></p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-600 mb-1">Nomor Telepon</p>
                        <p class="font-medium text-gray-900"><?= esc($merchant['phone']) ?></p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-600 mb-1">Email</p>
                        <p class="font-medium text-gray-900"><?= esc($merchant['email']) ?></p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-600 mb-1">Nomor Izin Usaha</p>
                        <p class="font-medium text-gray-900"><?= esc($merchant['license_number']) ?></p>
                    </div>
                </div>
            </div>

            <!-- Account Information -->
            <div class="border-t pt-6">
                <h3 class="text-xl font-bold text-text-dark mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Informasi Akun
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-600 mb-1">Terdaftar Sejak</p>
                        <p class="font-medium text-gray-900"><?= date('d F Y', strtotime($merchant['created_at'])) ?></p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-600 mb-1">Terakhir Diupdate</p>
                        <p class="font-medium text-gray-900"><?= date('d F Y', strtotime($merchant['updated_at'])) ?></p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="border-t pt-6">
                <div class="flex space-x-4">
                    <button onclick="alert('Fitur edit profil akan segera hadir!')" 
                            class="flex-1 bg-primary-blue text-white py-3 rounded-xl font-semibold hover:bg-opacity-90 transition duration-200 flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span>Edit Profil</span>
                    </button>
                    
                    <button onclick="alert('Fitur ganti password akan segera hadir!')" 
                            class="flex-1 bg-secondary-purple text-white py-3 rounded-xl font-semibold hover:bg-opacity-90 transition duration-200 flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                        <span>Ganti Password</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>