<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Merchant - Servify</title>
    
    <link rel="stylesheet" href="<?= base_url('css/merchant.css') ?>">
</head>
<body>
    <!-- Top Navigation -->
    <nav class="top-nav">
        <div class="nav-container">
            <div class="nav-logo">
                <img src="https://scontent.fcgk33-1.fna.fbcdn.net/v/t39.30808-6/583928529_122099849571120016_3728179850395384540_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=T_yKGn2uSFAQ7kNvwHTY6j5&_nc_oc=AdlCSwQfHRKqZ_0vaWoOY-nDlErSsvpQiJztbSRLdfgVy-Nd9Hz2f2ItPtmUqOwKqo1J5fQQ_Ddsz58Nlh6CknRG&_nc_zt=23&_nc_ht=scontent.fcgk33-1.fna&_nc_gid=t0O1wWRKMQ1geQ8QoyAXxQ&oh=00_AfkFCk1RjrokeSk5UtKdcyo1gcEM7_6OoJ2cxvdlwlB3Ew&oe=693B0C46" alt="Servify">
                <span>Servify</span>
            </div>
            
            <div class="nav-menu">
                <a href="<?= base_url('/') ?>" class="nav-link">Home</a>
                <a href="<?= base_url('marketplace') ?>" class="nav-link">Marketplace</a>
            </div>
            
            <div class="nav-user">
                <div class="user-avatar">M</div>
                <a href="<?= base_url('logout') ?>" class="logout-link">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h1 class="page-title">Dashboard Merchant</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                ✓ <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Produk</h3>
                <div class="value">12</div>
            </div>
            <div class="stat-card" style="border-left-color: #28a745;">
                <h3>Reservasi Baru</h3>
                <div class="value" style="color: #28a745;">5</div>
            </div>
            <div class="stat-card" style="border-left-color: #f1c40f;">
                <h3>Terjual Bulan Ini</h3>
                <div class="value" style="color: #f1c40f;">28</div>
            </div>
        </div>

        <!-- Action Cards -->
        <div class="action-grid">
            <div class="action-card" onclick="window.location.href='<?= base_url('merchant/products/add') ?>'">
                <div class="action-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <h3>Tambah Produk</h3>
                <p>Tambahkan produk baru ke marketplace</p>
                <a href="<?= base_url('merchant/products/add') ?>" class="btn-action">Tambah Produk</a>
            </div>

            <div class="action-card" onclick="window.location.href='<?= base_url('merchant/reservations') ?>'">
                <div class="action-icon" style="background: linear-gradient(135deg, #28a745, #20853b);">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3>Kelola Reservasi</h3>
                <p>Lihat dan kelola reservasi service</p>
                <a href="<?= base_url('merchant/reservations') ?>" class="btn-action" style="background: #28a745;">Lihat Reservasi</a>
            </div>
        </div>

        <!-- Recent Products -->
        <div class="recent-section">
            <div class="section-header">
                <h2 class="section-title">Produk Terbaru</h2>
                <a href="<?= base_url('merchant/products') ?>" style="color: #687bdb; text-decoration: none; font-weight: 500;">Lihat Semua →</a>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Laptop Asus ROG</strong></td>
                        <td>Rp 15.000.000</td>
                        <td>5</td>
                        <td>12</td>
                    </tr>
                    <tr>
                        <td><strong>RAM DDR4 16GB</strong></td>
                        <td>Rp 800.000</td>
                        <td>20</td>
                        <td>8</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>