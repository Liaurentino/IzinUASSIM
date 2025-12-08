<!-- Halaman Home -->

<div class="space-y-8">
    <section class="main-card p-8 rounded-2xl shadow-xl flex flex-col md:flex-row items-center justify-between transition duration-300">
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
            <img src="https://i.pinimg.com/1200x/7c/4f/fa/7c4ffad4589003aa0b0cb49cd19c0e53.jpg" alt="Laptop Repair" class="rounded-2xl shadow-2xl object-cover w-full max-w-sm md:max-w-md">
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
            <img src="data:image/jpeg;base64,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" alt="Merchant Join" class="rounded-2xl shadow-2xl object-cover w-full max-w-sm md:max-w-md">
            
            <a href="<?= base_url('merchant') ?>" class="w-full sm:w-auto bg-secondary-purple text-white py-3 px-8 rounded-xl font-bold text-lg shadow-lg hover:bg-opacity-90 transition duration-300 transform hover:scale-105 mt-4">
                Gabung Sekarang
            </a>
        </div>
    </section>
    
            
            </div>
        </div>
    </section>
</div>