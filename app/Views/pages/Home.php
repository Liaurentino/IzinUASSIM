<!-- Halaman Home -->

<div class="space-y-8">
    <!-- Section 1: Hero Banner (Mengambil dari mockup 140328) -->
    <section class="main-card p-8 rounded-2xl shadow-xl flex flex-col md:flex-row items-center justify-between transition duration-300">
        <!-- Kiri: Teks & CTA -->
        <div class="md:w-1/2 space-y-6 text-text-dark">
            <h1 class="text-5xl font-extrabold text-secondary-purple leading-tight">
                Laptop Rusak? <br> <span class="text-primary-blue">Servify solusinya</span>
            </h1>
            <p class="text-lg">
                Temukan solusi untuk laptop kamu di toko yang menyediakan layanan service laptop di sekitarmu.
            </p>
            
            <!-- Tombol CTA -->
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 items-center">
                <a href="<?= base_url('reservation') ?>" class="w-full sm:w-auto bg-primary-blue text-white py-3 px-8 rounded-xl font-bold text-lg shadow-lg hover:bg-opacity-90 transition duration-300 transform hover:scale-105">
                    Reservasi
                </a>
                <a href="<?= base_url('marketplace') ?>" class="w-full sm:w-auto bg-white border-2 border-primary-blue text-primary-blue py-3 px-8 rounded-xl font-bold text-lg shadow-md hover:shadow-lg transition duration-300 transform hover:scale-105">
                    Beli Produk
                </a>
            </div>

            <!-- Fitur Utama -->
            <div class="flex flex-wrap pt-6 space-y-4 sm:space-y-0 sm:space-x-8 text-sm font-medium">
                <div class="flex items-center space-x-2">
                    <span class="text-green-500 font-bold text-xl">✓</span>
                    <p>Proses cepat <br><span class="text-gray-600">± 3 Hari Kerja</span></p>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-green-500 font-bold text-xl">✓</span>
                    <p>Garansi 180 hari <br><span class="text-gray-600">Kerusakan kembali</span></p>
                </div>
            </div>
        </div>

        <div class="md:w-1/2 mt-8 md:mt-0 flex justify-center">
            <!-- Placeholder Image: Ganti dengan URL gambar Anda jika ada -->
            <img src="https://placehold.co/400x300/845EFD/ffffff?text=Laptop+Service+Image" alt="Laptop Repair" class="rounded-2xl shadow-2xl object-cover w-full max-w-sm md:max-w-md">
        </div>
    </section>

    <section class="main-card p-8 rounded-2xl shadow-xl flex flex-col md:flex-row items-center justify-between transition duration-300">
        <!-- Kiri: Teks & Benefit -->
        <div class="md:w-1/2 space-y-6 text-text-dark">
            <h2 class="text-3xl font-bold text-primary-blue">
                Kenapa Bergabung Dengan Kami?
            </h2>
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
            </ul>
        </div>
        
        <!-- Kanan: Gambar & CTA -->
        <div class="md:w-1/2 mt-8 md:mt-0 flex flex-col items-center space-y-4">
            <!-- Placeholder Image -->
            <img src="https://placehold.co/400x300/4c70ff/ffffff?text=Merchant+Image" alt="Merchant Join" class="rounded-2xl shadow-2xl object-cover w-full max-w-sm md:max-w-md">
            
            <a href="<?= base_url('merchant') ?>" class="w-full sm:w-auto bg-secondary-purple text-white py-3 px-8 rounded-xl font-bold text-lg shadow-lg hover:bg-opacity-90 transition duration-300 transform hover:scale-105 mt-4">
                Gabung Sekarang
            </a>
        </div>
    </section>
    
            
            </div>
        </div>
    </section>
</div>