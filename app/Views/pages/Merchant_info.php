<div class="flex justify-center items-center h-full">
    <div class="main-card p-8 rounded-2xl shadow-xl w-full max-w-4xl transition duration-300 space-y-6">
        <h2 class="text-4xl font-extrabold text-center text-primary-blue mb-8">Program Kemitraan Servify</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Kiri: Benefit -->
            <div class="space-y-6 text-text-dark">
                <h3 class="text-3xl font-bold text-secondary-purple">
                    Kenapa Bergabung Dengan Kami?
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start space-x-3">
                        <span class="text-2xl text-green-500">✓</span>
                        <p class="text-lg">Kelola Bisnis Lebih Mudah Dengan Sistem Digital.</p>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="text-2xl text-green-500">✓</span>
                        <p class="text-lg">Dapatkan Ribuan Pelanggan Baru Setiap Bulan.</p>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="text-2xl text-green-500">✓</span>
                        <p class="text-lg">Jalin Hubungan dengan Ratusan Mitra Sukses.</p>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="text-2xl text-green-500">✓</span>
                        <p class="text-lg">Sistem Reservasi & Manajemen Service Terintegrasi.</p>
                    </li>
                </ul>
            </div>
            
            <!-- Kanan: Gambar & CTA Card (Efek Hover sesuai permintaan) -->
            <div class="flex flex-col items-center justify-center space-y-4">
                <!-- Placeholder Image -->
                <img src="https://placehold.co/400x300/4c70ff/ffffff?text=Join+Mitra" alt="Join Mitra" class="rounded-2xl shadow-2xl object-cover w-full max-w-sm">
                
                <!-- Hover CTA Card -->
                <a href="<?= base_url('merchant/register') ?>" id="merchant-cta-card" class="w-full max-w-sm bg-secondary-purple text-white py-4 px-8 rounded-xl font-bold text-xl shadow-lg hover:bg-opacity-90 transition duration-300 transform hover:scale-105 hover:shadow-2xl text-center">
                    Gabung Sekarang
                </a>
                
                <p class="text-sm text-gray-500 mt-2">Daftar sekarang dan mulai tingkatkan bisnis Anda!</p>
            </div>
        </div>
    </div>
</div>