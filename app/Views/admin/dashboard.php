<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Servify</title>
    <link rel="stylesheet" href="<?= base_url('css/admin.css'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="admin-container">
        
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>🛡️ Admin Panel</h2>
                <p>Servify Management</p>
            </div>
            
            <nav class="sidebar-menu">
                <a href="<?= base_url('admin') ?>" class="menu-item active">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                
                <a href="#" class="menu-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Verifikasi Merchant
                </a>
                
                <a href="#" class="menu-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Kelola Users
                </a>
                
                <a href="#" class="menu-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Statistik
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">Verifikasi Merchant</h1>
                <a href="<?= base_url('admin/logout') ?>" class="logout-btn">Logout</a>
            </div>

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    ✓ <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    ✗ <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>Merchant Pending</h3>
                        <div class="value"><?= count($pending_merchants ?? []) ?></div>
                    </div>
                    <div class="stat-icon pending">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="table-card">
                <div class="table-header">
                    <h2>Daftar Merchant Menunggu Verifikasi</h2>
                </div>

                <?php if (!empty($pending_merchants)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Usaha</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Jenis Usaha</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pending_merchants as $merchant): ?>
                                <tr>
                                    <td><strong><?= esc($merchant['merchant_name'] ?? $merchant['business_name']) ?></strong></td>
                                    <td><?= esc($merchant['email']) ?></td>
                                    <td><?= esc($merchant['phone_number'] ?? $merchant['phone']) ?></td>
                                    <td><?= esc(substr($merchant['address'], 0, 30)) ?>...</td>
                                    <td><?= esc($merchant['business_type'] ?? '-') ?></td>
                                    <td><span class="badge pending">Pending</span></td>
                                    <td>
                                        <a href="<?= base_url('admin/approve/' . $merchant['id']) ?>" 
                                           class="btn btn-approve"
                                           onclick="return confirm('Setujui merchant ini?')">
                                           Setujui
                                        </a>
                                        <a href="<?= base_url('admin/reject/' . $merchant['id']) ?>" 
                                           class="btn btn-reject"
                                           onclick="return confirm('Tolak merchant ini?')">
                                           Tolak
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <svg width="60" height="60" fill="none" stroke="#ddd" viewBox="0 0 24 24" style="margin: 0 auto 10px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p>Tidak ada merchant yang menunggu verifikasi saat ini.</p>
                    </div>
                <?php endif; ?>
            </div>

        </main>
    </div>

</body>
</html>