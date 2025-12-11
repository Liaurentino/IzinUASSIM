<!-- Halaman Login Akun -->
<div class="flex justify-center items-center h-full">
    <div class="main-card p-8 rounded-2xl shadow-xl w-full max-w-md transition duration-300 space-y-6">
        <h2 class="text-3xl font-bold text-center text-primary-blue mb-6">Login Akun</h2>

        <?= form_open(base_url('login/process'), ['class' => 'space-y-4']) ?>
        
            <div>
                <label for="email" class="block text-sm font-medium text-text-dark">Email</label>
                <input type="email" id="email" name="email" value="<?= old('email') ?>" placeholder="Email Anda" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
                <?php if ($session->getFlashdata('error')): ?>
                <?php endif; ?>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-text-dark">Password</label>
                <input type="password" id="password" name="password" placeholder="Password Anda" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-inner focus:ring-primary-blue focus:border-primary-blue">
            </div>
            <div class="pt-6">
                <button type="submit" class="w-full bg-secondary-purple text-white py-3 rounded-xl font-bold text-lg shadow-lg hover:bg-opacity-90 transition duration-300 transform hover:scale-105">
                    Login
                </button>
            </div>
            
            <p class="text-center text-sm text-gray-600">Belum punya akun? <a href="<?= base_url('register') ?>" class="text-primary-blue font-semibold hover:underline">Daftar sekarang</a></p>

        <?= form_close() ?>
    </div>
</div>