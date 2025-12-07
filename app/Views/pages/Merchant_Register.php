<!-- Halaman Pendaftaran Merchant (Mengambil dari mockup 140455 & 140516) -->
<div class="flex justify-center items-center h-full">
    <div class="main-card p-8 rounded-2xl shadow-xl w-full max-w-lg transition duration-300 space-y-6">
        <h2 class="text-3xl font-bold text-center text-secondary-purple mb-6">Mendaftar Sebagai Mitra</h2>
        
        <?php if (! $session->get('isLoggedIn')): ?>
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">Anda harus <a href="<?= base_url('login') ?>" class="font-semibold underline">Login</a> terlebih dahulu untuk mendaftar Mitra.</span>
            </div>
        <?php endif; ?>

        <?= form_open(base_url('merchant/create'), ['class' => 'space-y-4']) ?>
        
            <!-- Input Nama Usaha -->
            <div>
                <label for="business_name" class="block text-sm font-medium text-text-dark">Nama Usaha</label>
                <input type="text" id="business_name" name="business_name" value="<?= old('business_name') ?>" placeholder="Contoh: Anwar Servis" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                <?php if ($validation->getError('business_name')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('business_name')) ?></p>
                <?php endif; ?>
            </div>
            
            <!-- Input Alamat Lengkap Usaha -->
            <div>
                <label for="address" class="block text-sm font-medium text-text-dark">Alamat Lengkap Usaha</label>
                <input type="text" id="address" name="address" value="<?= old('address') ?>" placeholder="Contoh: Jl. Jend. Sudirman No. 10" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                <?php if ($validation->getError('address')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('address')) ?></p>
                <?php endif; ?>
            </div>

            <!-- Input Nomor Telpon Usaha -->
            <div>
                <label for="phone" class="block text-sm font-medium text-text-dark">Nomor Telpon Usaha</label>
                <input type="text" id="phone" name="phone" value="<?= old('phone') ?>" placeholder="Contoh: 0812xxxxxxxx" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                <?php if ($validation->getError('phone')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('phone')) ?></p>
                <?php endif; ?>
            </div>

            <!-- Input Email Bisnis -->
            <div>
                <label for="email" class="block text-sm font-medium text-text-dark">Email Bisnis</label>
                <input type="email" id="email" name="email" value="<?= old('email') ?>" placeholder="Contoh: business@example.com" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                <?php if ($validation->getError('email')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('email')) ?></p>
                <?php endif; ?>
            </div>
            
            <!-- Input Jenis Badan Usaha -->
            <div>
                <label for="business_type" class="block text-sm font-medium text-text-dark">Jenis Badan Usaha</label>
                <select id="business_type" name="business_type" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                    <option value="">Pilih Jenis Badan Usaha</option>
                    <option value="PT" <?= old('business_type') == 'PT' ? 'selected' : '' ?>>PT (Perseroan Terbatas)</option>
                    <option value="CV" <?= old('business_type') == 'CV' ? 'selected' : '' ?>>CV (Commanditaire Vennootschap)</option>
                    <option value="Perorangan" <?= old('business_type') == 'Perorangan' ? 'selected' : '' ?>>Usaha Perorangan</option>
                    <option value="Lainnya" <?= old('business_type') == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                </select>
                <?php if ($validation->getError('business_type')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('business_type')) ?></p>
                <?php endif; ?>
            </div>

            <!-- Input Nomor Izin Usaha (NIB) -->
            <div>
                <label for="license_number" class="block text-sm font-medium text-text-dark">Nomor Izin Usaha</label>
                <input type="text" id="license_number" name="license_number" value="<?= old('license_number') ?>" placeholder="Contoh: NIB1234567890" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                <?php if ($validation->getError('license_number')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('license_number')) ?></p>
                <?php endif; ?>
            </div>

            <!-- Tombol Lanjut -->
            <div class="pt-6 flex justify-center">
                <button type="submit" class="w-full bg-secondary-purple text-white py-3 rounded-xl font-bold text-lg shadow-lg hover:bg-opacity-90 transition duration-300 transform hover:scale-105">
                    Lanjut
                </button>
            </div>

        <?= form_close() ?>
    </div>
</div>