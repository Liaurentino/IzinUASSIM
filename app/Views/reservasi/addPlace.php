<div class="flex justify-center items-center min-h-screen py-12">
    <div class="main-card p-8 rounded-2xl shadow-xl w-full max-width: 800px; transition duration-300 space-y-6" style="max-width: 800px;">
        <h2 class="text-3xl font-bold text-center text-primary-blue mb-6">Formulir Reservasi Service</h2>

        <?= form_open(base_url('reservation/create'), ['class' => 'space-y-6']) ?>
        
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-text-dark">Nama</label>
                    <input type="text" id="name" name="name" value="<?= old('name') ?>" placeholder="Nama Lengkap Anda" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                    <?php if ($validation->getError('name')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('name')) ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-text-dark">No. Telp</label>
                    <input type="text" id="phone" name="phone" value="<?= old('phone') ?>" placeholder="Nomor Telepon Aktif" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                    <?php if ($validation->getError('phone')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('phone')) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div>
                <label for="laptop_model" class="block text-sm font-medium text-text-dark">Model Laptop</label>
                <input type="text" id="laptop_model" name="laptop_model" value="<?= old('laptop_model') ?>" placeholder="Contoh: Asus VivoBook Pro 15" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                <?php if ($validation->getError('laptop_model')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('laptop_model')) ?></p>
                <?php endif; ?>
            </div>

            <!-- Input Keluhan -->
            <div>
                <label for="complaint" class="block text-sm font-medium text-text-dark">Keluhan</label>
                <textarea id="complaint" name="complaint" rows="4" placeholder="Contoh: layar mati, boot loop, keyboard rusak" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue"><?= old('complaint') ?></textarea>
                <?php if ($validation->getError('complaint')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('complaint')) ?></p>
                <?php endif; ?>
            </div>
            
            <div>
                <label for="reservation_date" class="block text-sm font-medium text-text-dark">Tanggal Reservasi</label>
                <input type="date" id="reservation_date" name="reservation_date" value="<?= old('reservation_date') ?>" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                <?php if ($validation->getError('reservation_date')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('reservation_date')) ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label for="service_location" class="block text-sm font-medium text-text-dark">Pilih Tempat Service</label>
                <select id="service_location" name="service_location" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                    <option value="">-- Pilih Lokasi Service --</option>
                    <option value="Servify Jakarta Pusat" <?= old('service_location') == 'Servify Jakarta Pusat' ? 'selected' : '' ?>>Servify Jakarta Pusat</option>
                    <option value="Servify Jakarta Selatan" <?= old('service_location') == 'Servify Jakarta Selatan' ? 'selected' : '' ?>>Servify Jakarta Selatan</option>
                    <option value="Servify Bandung" <?= old('service_location') == 'Servify Bandung' ? 'selected' : '' ?>>Servify Bandung</option>
                    <option value="Servify Surabaya" <?= old('service_location') == 'Servify Surabaya' ? 'selected' : '' ?>>Servify Surabaya</option>
                    <option value="Servify Medan" <?= old('service_location') == 'Servify Medan' ? 'selected' : '' ?>>Servify Medan</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">Pilih lokasi service center terdekat Anda</p>
            </div>

            <!-- Tombol Submit -->
            <div class="pt-6 flex justify-center">
                <button type="submit" class="bg-secondary-purple text-white py-3 px-12 rounded-xl font-bold text-lg shadow-lg hover:bg-opacity-90 transition duration-300 transform hover:scale-105">
                    Buat Reservasi
                </button>
            </div>

        <?= form_close() ?>
    </div>
</div>