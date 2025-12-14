<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="<?= base_url('css/pages.css'); ?>">

    <style>
        .page-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;   
            padding: 20px;     
        }
    </style>
</head>
<body>

    <div class="page-container">

        <div class="main-content space-y-8">
            
            <!-- CARD 1: HERO SECTION -->
            <section class="card-section">
                <!-- Kiri: Teks -->
                <div class="content-left">
                    <h1 class="home-title text-primary">
                        Laptop Rusak? <br> 
                        <span class="text-primary">Servify solusinya</span>
                    </h1>
                    <p class="home-desc">
                        Temukan solusi untuk laptop kamu di toko yang menyediakan layanan service laptop di sekitarmu.
                    </p>
                    
                    <!-- Tombol CTA -->
                    <div class="cta-group">
                        <a href="<?= base_url('reservation') ?>" class="btn-action btn-primary">
                            Reservasi
                        </a>
                        <a href="<?= base_url('marketplace') ?>" class="btn-action btn-outline">
                            Beli Produk
                        </a>
                    </div>

                    <!-- Fitur Utama -->
                    <div class="feature-list">
                        <div class="feature-item">
                            <span class="check-icon">✓</span>
                            <p class="feature-text">Proses cepat <br><span class="feature-subtext">± 3 Hari Kerja</span></p>
                        </div>
                        <div class="feature-item">
                            <span class="check-icon">✓</span>
                            <p class="feature-text">Garansi 180 hari <br><span class="feature-subtext">Kerusakan kembali</span></p>
                        </div>
                    </div>
                </div>

                <div class="content-right">
                    <img src="https://i.pinimg.com/1200x/7c/4f/fa/7c4ffad4589003aa0b0cb49cd19c0e53.jpg" alt="Laptop Repair" class="home-img">
                </div>
            </section>

            <section class="card-section">
                <div class="content-left">
                    <h2 class="home-title" style="font-size: 2rem;">
                        <span class="text-primary">Kenapa Bergabung <br> Dengan Kami?</span>
                    </h2>
                    
                    <div class="feature-list" style="flex-direction: column; gap: 1rem;">
                        <div class="feature-item">
                            <span class="check-icon" style="font-size: 1.5rem;">✓</span>
                            <p class="feature-text" style="font-size: 1.1rem;">Kelola Bisnis Lebih Mudah Dengan Sistem Digital.</p>
                        </div>
                        <div class="feature-item">
                            <span class="check-icon" style="font-size: 1.5rem;">✓</span>
                            <p class="feature-text" style="font-size: 1.1rem;">Dapatkan Ribuan Pelanggan Baru Setiap Bulan.</p>
                        </div>
                        <div class="feature-item">
                            <span class="check-icon" style="font-size: 1.5rem;">✓</span>
                            <p class="feature-text" style="font-size: 1.1rem;">Jalin Hubungan dengan Ratusan Mitra Sukses.</p>
                        </div>
                    </div>
                </div>
                

                <div class="content-right">
                    <img src="https://img.freepik.com/free-vector/organic-flat-customer-support-illustration_23-2148899174.jpg" alt="Merchant Join" class="home-img" style="max-height: 300px; width: auto;">
                    
                    <a href="<?= base_url('merchant') ?>" class="btn-action btn-primary" style="margin-top: 2rem; width: 100%;">
                        Gabung Sekarang
                    </a>
                </div>
            </section>

        </div>
    </div>

</body>
</html>