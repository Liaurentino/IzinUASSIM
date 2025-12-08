<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servify</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body class="bg-gray-50">

<nav class="w-full bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex-shrink-0">
                <a href="<?= base_url('/') ?>" class="text-2xl font-bold text-primary-blue">Servify</a>
            </div>

            <div class="space-x-8 hidden md:flex text-text-dark font-medium items-center">
                <a href="<?= base_url('/') ?>" class="nav-link hover:text-blue-600">Home</a>
                <a href="<?= base_url('marketplace') ?>" class="nav-link hover:text-blue-600">Marketplace</a>
                <a href="<?= base_url('reservation') ?>" class="nav-link hover:text-blue-600">Reservation</a>
                <a href="<?= base_url('chatbot') ?>" class="nav-link hover:text-blue-600">Chatbot</a>
                <a href="<?= base_url('findus') ?>" class="nav-link hover:text-blue-600">Find Us</a>
                
                <?php if ($session->get('isLoggedIn')): ?>
                    <?php if ($session->get('role') === 'merchant' && strtolower($session->get('merchant_status')) === 'approved'): ?>
                        <a href="<?= base_url('merchant/dashboard') ?>" class="nav-link text-purple-600 font-bold">
                            <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                        </a>
                    <?php elseif (strtolower($session->get('merchant_status')) === 'pending'): ?>
                        <a href="<?= base_url('merchant/waiting') ?>" class="nav-link text-yellow-600 font-bold">
                            <i class="fas fa-clock mr-1"></i> Status Pengajuan
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('merchant/register') ?>" class="nav-link">Jadi Mitra</a>
                    <?php endif; ?>
                    
                    <a href="<?= base_url('logout') ?>" class="text-red-500 font-semibold hover:text-red-700 ml-4">
                        Logout (<?= esc($session->get('user_name')) ?>)
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('merchant') ?>" class="nav-link">Merchant</a>
                    <a href="<?= base_url('login') ?>" class="ml-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>