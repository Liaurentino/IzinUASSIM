<div class="flex justify-center items-center h-full">
    <div class="main-card p-8 rounded-2xl shadow-xl w-full max-w-lg transition duration-300 space-y-6">
        <h2 class="text-3xl font-bold text-center text-primary-blue mb-6">Registrasi Akun</h2>

        <?= form_open(base_url('register/create'), ['class' => 'space-y-4']) ?>
        
            <div>
                <label for="name" class="block text-sm font-medium text-text-dark">Nama</label>
                <input type="text" id="name" name="name" value="<?= old('name') ?>" placeholder="Contoh: Budi Santoso" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                <?php if ($validation->getError('name')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('name')) ?></p>
                <?php endif; ?>
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-text-dark">Email</label>
                <input type="email" id="email" name="email" value="<?= old('email') ?>" placeholder="Contoh: budi@example.com" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                <?php if ($validation->getError('email')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('email')) ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-text-dark">Nomor Telpon</label>
                <input type="text" id="phone" name="phone" value="<?= old('phone') ?>" placeholder="Contoh: 0812xxxxxxxx" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                <?php if ($validation->getError('phone')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('phone')) ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-text-dark">Password</label>
                <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                <?php if ($validation->getError('password')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('password')) ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label for="confirm_password" class="block text-sm font-medium text-text-dark">Ketik Ulang password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                <?php if ($validation->getError('confirm_password')): ?>
                    <p class="text-red-500 text-xs mt-1"><?= esc($validation->getError('confirm_password')) ?></p>
                <?php endif; ?>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full bg-secondary-purple text-white py-3 rounded-xl font-bold text-lg shadow-lg hover:bg-opacity-90 transition duration-300 transform hover:scale-105">
                    Buat Akun
                </button>
            </div>
            
            <p class="text-center text-sm text-gray-600">Sudah punya akun? <a href="<?= base_url('login') ?>" class="text-primary-blue font-semibold hover:underline">Login di sini</a></p>

        <?= form_close() ?>
    </div>
</div>
