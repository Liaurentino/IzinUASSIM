<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Merchant - Servify</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #F8FAFC;
        }

        /* Top Navigation */
        .top-nav {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 0 40px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-logo img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
        }

        .nav-logo span {
            font-size: 24px;
            font-weight: 700;
            color: #687bdb;
        }

        .nav-menu {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-link {
            color: #666;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            padding: 8px 16px;
            border-radius: 8px;
        }

        .nav-link:hover, .nav-link.active {
            color: #687bdb;
            background: rgba(104, 123, 219, 0.1);
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #687bdb, #5568c3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .logout-link {
            color: #e74c3c;
            text-decoration: none;
            font-weight: 500;
        }

        /* Main Container */
        .container {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 40px;
        }

        .page-title {
            font-size: 32px;
            color: #687bdb;
            margin-bottom: 30px;
            font-weight: 700;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-left: 4px solid #687bdb;
        }

        .stat-card h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .stat-card .value {
            font-size: 36px;
            font-weight: 700;
            color: #687bdb;
        }

        /* Action Cards */
        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .action-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .action-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #687bdb, #5568c3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-icon svg {
            width: 40px;
            height: 40px;
            stroke: white;
        }

        .action-card h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        .action-card p {
            color: #666;
            margin-bottom: 20px;
        }

        .btn-action {
            background: #687bdb;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-action:hover {
            background: #5568c3;
        }

        /* Recent Section */
        .recent-section {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .section-title {
            font-size: 20px;
            color: #687bdb;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #666;
            font-size: 13px;
        }

        td {
            padding: 15px 12px;
            border-bottom: 1px solid #f0f0f0;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
    </style>
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
                <a href="<?= base_url('merchant/dashboard') ?>" class="nav-link active">Dashboard</a>
                <a href="<?= base_url('marketplace') ?>" class="nav-link">Marketplace</a>
                <a href="<?= base_url('findus') ?>" class="nav-link">Find Us</a>
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