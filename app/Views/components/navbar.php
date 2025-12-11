<?php $session = session(); ?>
<link rel="stylesheet" href="css/style.css">
<link href="/css/style.css" rel="stylesheet">

<nav class="navbar">
    <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
        <div class="navbar-brand">
            <a href="<?= base_url('/') ?>" style="font-size: 1.5rem; font-weight: bold; text-decoration: none; text-color: #697CDC;">UASSIM</a>
        </div>
        <div class="navbar-menu" style="display: flex; gap: 15px; align-items: center;">
            <a href="<?= base_url('/') ?>">Home</a>
            <a href="<?= base_url('marketplace') ?>">Marketplace</a>
            <a href="<?= base_url('findus') ?>">Find Us</a>
            <a href="<?= base_url('chatbot') ?>">Chatbot</a>

            <?php if ($session->get('isLoggedIn')): ?>
                
                <?php $userRole = $session->get('role'); ?>

                <?php if ($userRole === 'admin'): ?>
                    <!-- Tautan untuk Admin: Langsung ke Dashboard Admin -->
                    <a href="<?= base_url('admin') ?>" 
                       style="background-color: #e67e22; padding: 8px 12px; font-weight: bold; text-decoration: none; border-radius: 4px;">
                        Dashboard Admin
                    </a>
                    
                    </a>
                <?php else: ?>
                    <!-- Pengguna biasa: Tampilkan tautan untuk mendaftar sebagai Merchant -->
                    <a href="<?= base_url('merchant/register') ?>">Daftar Merchant</a>
                <?php endif; ?>

                <!-- Tautan Logout selalu ada jika sudah login -->
                <a href="<?= base_url('auth/logout') ?>" 
                   style="background-color: #c0392b; padding: 8px 12px; font-weight: bold; text-decoration: none; border-radius: 4px;">
                    Logout
                </a>

            <?php else: ?>
                <!-- Tautan untuk pengguna yang belum login -->
                <a href="<?= base_url('auth/login') ?>">Login</a>
                <a href="<?= base_url('auth/register') ?>">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>