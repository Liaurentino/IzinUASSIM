<div class="flex justify-center items-center h-full">
    <div class="card-bg-gray p-8 rounded-2xl shadow-xl w-full max-w-3xl transition duration-300 space-y-6">
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
                <label for="service_location" class="block text-sm font-medium text-text-dark">Pilih Tempat Service</label>
                <select id="service_location" name="service_location" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue bg-white">
                    <option value="" disabled selected>-- Pilih Lokasi --</option>
                    <?php if (!empty($serviceLocations)): ?>
                        <?php foreach ($serviceLocations as $loc): ?>
                            <option value="<?= esc($loc['name']) ?>" <?= old('service_location') == $loc['name'] ? 'selected' : '' ?>>
                                <?= esc($loc['name']) ?> (<?= esc($loc['address']) ?>)
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <?php if ($validation->getError('service_location')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('service_location')) ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label for="laptop_model" class="block text-sm font-medium text-text-dark">Model Laptop</label>
                <input type="text" id="laptop_model" name="laptop_model" value="<?= old('laptop_model') ?>" placeholder="Contoh: Asus VivoBook Pro 15" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                <?php if ($validation->getError('laptop_model')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('laptop_model')) ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label for="complaint" class="block text-sm font-medium text-text-dark">Keluhan</label>
                <textarea id="complaint" name="complaint" rows="4" placeholder="Contoh: layar mati, boot loop" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue"><?= old('complaint') ?></textarea>
                <?php if ($validation->getError('complaint')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('complaint')) ?></p>
                <?php endif; ?>
            </div>
            
            <div>
                <label for="reservation_date" class="block text-sm font-medium text-text-dark">Tanggal Reservasi</label>
                <input type="date" id="reservation_date" name="reservation_date" value="<?= old('reservation_date') ?>" placeholder="dd/mm/yyyy" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                <?php if ($validation->getError('reservation_date')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('reservation_date')) ?></p>
                <?php endif; ?>
            </div>

            <div class="pt-6 flex justify-center">
                <button type="submit" class="bg-secondary-purple text-white py-3 px-12 rounded-xl font-bold text-lg shadow-lg hover:bg-opacity-90 transition duration-300 transform hover:scale-105">
                    Lanjut
                </button>
            </div>

        <?= form_close() ?>
    </div>
</div>