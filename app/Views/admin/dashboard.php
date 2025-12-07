<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - UASSIM</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="admin-body">

<div class="d-flex-admin">
    <nav class="admin-sidebar">
        <a href="#" class="sidebar-brand">
            <i class="fas fa-store-alt" style="margin-right: 10px;"></i> UASSIM Admin
        </a>
        <ul class="nav">
            <li>
                <a href="<?= base_url('admin/dashboard') ?>" class="active">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-users"></i> Kelola User
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-box"></i> Kelola Merchant
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-chart-bar"></i> Laporan
                </a>
            </li>
        </ul>
    </nav>

    <div class="admin-content">
        <header class="admin-header">
            <h1>Dashboard Overview</h1>
            <div class="user-profile">
                <span>Halo, <?= session()->get('username') ?? 'Admin'; ?></span>
                <a href="<?= base_url('logout'); ?>" class="btn-logout">Logout</a>
            </div>
        </header>

        <div class="container-fluid-admin">
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-text">
                        <h5>Total Merchant</h5>
                        <div class="value">120</div> </div>
                    <div class="stat-icon">
                        <i class="fas fa-store"></i>
                    </div>
                </div>

                <div class="stat-card success">
                    <div class="stat-text success">
                        <h5>Pendapatan</h5>
                        <div class="value">Rp 5.000.000</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>

                <div class="stat-card warning">
                    <div class="stat-text warning">
                        <h5>Pending Approval</h5>
                        <div class="value">15</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                </div>
            </div>

            <div class="content-card">
                <h3>Aktivitas Terbaru</h3>
                <p>Selamat datang di panel Admin. Di sini Anda bisa mengelola seluruh data merchant dan pengguna.</p>
                <div style="padding: 20px; background: #f8f9fc; border-radius: 5px; border: 1px dashed #ccc; text-align: center; color: #888;">
                    Area Grafik atau Tabel Data akan muncul di sini.
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>