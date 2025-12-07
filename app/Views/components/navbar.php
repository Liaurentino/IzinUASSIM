<?php $session = session(); ?>

<style>
    /* Variabel Warna */
    :root {
        --primary-purple: #687bdb;
        --light-bg: #ddeafc;
        --text-dark: #333;
        --white: #ffffff;
    }

    .servify-navbar {
        background-color: var(--white);
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 15px 0;
        font-family: 'Poppins', sans-serif; /* Pastikan font ini ada */
    }

    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
    }

    /* Logo Styling */
    .nav-brand {
        display: flex;
        align-items: center;
        text-decoration: none;
        gap: 10px;
    }

    .nav-logo-img {
        height: 40px; 
        width: 40px; 
        object-fit: cover; 
        border-radius: 50%;
    }

    .nav-brand-text {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    /* Menu Links */
    .nav-menu {
        display: flex;
        gap: 25px;
        align-items: center;
    }

    .nav-link {
        text-decoration: none;
        color: #777;
        font-weight: 500;
        transition: color 0.3s;
    }

    .nav-link:hover {
        color: var(--primary-purple);
    }

    /* Buttons */
    .btn {
        padding: 8px 20px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    /* Tombol Utama (Ungu) */
    .btn-primary {
        background-color: var(--primary-purple);
        color: white;
        border: 1px solid var(--primary-purple);
    }

    .btn-primary:hover {
        background-color: #5666b3;
    }

    /* Tombol Outline (Login) */
    .btn-outline {
        background-color: transparent;
        color: var(--primary-purple);
        border: 1px solid var(--primary-purple);
    }

    .btn-outline:hover {
        background-color: var(--primary-purple);
        color: white;
    }

    /* Tombol Logout (Merah soft) */
    .btn-logout {
        color: #e74c3c;
        margin-left: 10px;
        font-weight: 500;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .btn-logout:hover {
        text-decoration: underline;
    }
    
    /* Tombol Khusus Admin (Orange) */
    .btn-admin {
        background-color: #e67e22;
        color: white;
    }
</style>

<nav class="servify-navbar">
    <div class="nav-container">
        
        <a href="<?= base_url('/') ?>" class="nav-brand">
            <img src="https://scontent.fcgk33-1.fna.fbcdn.net/v/t39.30808-6/583928529_122099849571120016_3728179850395384540_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=T_yKGn2uSFAQ7kNvwHTY6j5&_nc_oc=AdlCSwQfHRKqZ_0vaWoOY-nDlErSsvpQiJztbSRLdfgVy-Nd9Hz2f2ItPtmUqOwKqo1J5fQQ_Ddsz58Nlh6CknRG&_nc_zt=23&_nc_ht=scontent.fcgk33-1.fna&_nc_gid=t0O1wWRKMQ1geQ8QoyAXxQ&oh=00_AfkFCk1RjrokeSk5UtKdcyo1gcEM7_6OoJ2cxvdlwlB3Ew&oe=693B0C46" 
                 alt="Logo" 
                 class="nav-logo-img">
            <span class="nav-brand-text">Servify</span>
        </a>

        <div class="nav-menu">
            <a href="<?= base_url('/') ?>" class="nav-link">Home</a>
            <a href="<?= base_url('marketplace') ?>" class="nav-link">Marketplace</a>
            <a href="<?= base_url('findus') ?>" class="nav-link">Find Us</a>
            <a href="<?= base_url('chatbot') ?>" class="nav-link">Chatbot</a>
        </div>

        <div class="nav-auth" style="display: flex; align-items: center;">
            
            <?php if ($session->get('logged_in')): ?>
                
                <?php $userRole = $session->get('role'); ?>

                <?php if ($userRole === 'admin'): ?>
                    <a href="<?= base_url('admin') ?>" class="btn btn-admin">
                        <i class="fas fa-user-shield"></i> Panel Admin
                    </a>

                <?php elseif ($userRole === 'merchant'): ?>
                    <a href="<?= base_url('merchant/dashboard') ?>" class="btn btn-primary">
                        <i class="fas fa-store"></i> Dashboard Toko
                    </a>

                <?php else: ?>
                    <a href="<?= base_url('merchant/register') ?>" class="btn btn-outline">
                        Gabung Mitra
                    </a>
                <?php endif; ?>

                <a href="<?= base_url('logout') ?>" class="btn-logout">
                    Logout
                </a>

            <?php else: ?>
                <div style="display: flex; gap: 10px;">
                    <a href="<?= base_url('login') ?>" class="nav-link" style="padding: 8px 15px;">Login</a>
                    <a href="<?= base_url('register') ?>" class="btn btn-primary">Register</a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</nav>