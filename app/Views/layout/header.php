<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Servify') ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/pages.css') ?>">
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#687bdb',
                        'secondary-purple': '#8b5cf6',
                        'soft-blue': '#eff4ff',
                        'text-dark': '#3f426e'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">

<!-- Navbar -->
<nav class="w-full bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="<?= base_url('/') ?>" class="text-2xl font-bold text-primary-blue">
                    Servify
                </a>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden md:flex space-x-8 text-text-dark font-medium items-center">
                <a href="<?= base_url('/') ?>" class="hover:text-primary-blue transition duration-200">Home</a>
                <a href="<?= base_url('marketplace') ?>" class="hover:text-primary-blue transition duration-200">Marketplace</a>
                <a href="<?= base_url('reservation') ?>" class="hover:text-primary-blue transition duration-200">Reservation</a>
                <a href="<?= base_url('chatbot') ?>" class="hover:text-primary-blue transition duration-200">Chatbot</a>
                <a href="<?= base_url('findus') ?>" class="hover:text-primary-blue transition duration-200">Find Us</a>
                
                <?php if ($session->get('isLoggedIn')): ?>
                    <?php if ($session->get('role') === 'merchant' && strtolower($session->get('merchant_status')) === 'approved'): ?>
                        <a href="<?= base_url('merchant/dashboard') ?>" class="text-purple-600 font-bold">
                            <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                        </a>
                    <?php elseif (strtolower($session->get('merchant_status')) === 'pending'): ?>
                        <a href="<?= base_url('merchant/waiting') ?>" class="text-yellow-600 font-bold">
                            <i class="fas fa-clock mr-1"></i> Status
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('merchant/register') ?>" class="hover:text-primary-blue transition duration-200">Jadi Mitra</a>
                    <?php endif; ?>
                    
                    <a href="<?= base_url('logout') ?>" class="text-red-500 font-semibold hover:text-red-700 ml-4">
                        Logout (<?= esc($session->get('user_name')) ?>)
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('merchant') ?>" class="hover:text-primary-blue transition duration-200">Merchant</a>
                    <a href="<?= base_url('login') ?>" class="ml-4 px-4 py-2 bg-primary-blue text-white rounded-lg hover:bg-opacity-90 font-semibold">
                        Login
                    </a>
                <?php endif; ?>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-btn" class="text-gray-700 hover:text-primary-blue">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<main class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">