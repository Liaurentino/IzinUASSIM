<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard Merchant') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="<?= base_url('css/merchant.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
<body class="min-h-screen bg-gray-50">
<nav class="w-full bg-white shadow-md sticky top-0 z-50 border-b-4 border-secondary-purple">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
        
            <div class="flex items-center space-x-4">
                <a href="<?= base_url('merchant/dashboard') ?>" class="flex items-center space-x-2">
                    <div>
                        <span class="text-xl font-bold text-text-dark">Servify</span>
                        <span class="block text-xs text-secondary-purple font-semibold">Merchant Panel</span>
                    </div>
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-1">
                <a href="<?= base_url('merchant/dashboard') ?>" 
                   class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-soft-blue hover:text-primary-blue transition duration-200">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
                
                <a href="<?= base_url('merchant/products') ?>" 
                   class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-soft-blue hover:text-primary-blue transition duration-200">
                    <i class="fas fa-box mr-2"></i>Produk
                </a>
                
                    <a href="<?= base_url('merchant/reservations') ?>" 
                   class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-soft-blue hover:text-primary-blue transition duration-200">
                    <i class="fas fa-calendar-check mr-2"></i>Reservasi
                </a>
                
                
                <a href="<?= base_url('marketplace') ?>" 
                   target="_blank"
                   class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-soft-blue hover:text-primary-blue transition duration-200">
                    <i class="fas fa-external-link-alt mr-2"></i>Marketplace
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <div class="hidden sm:flex items-center space-x-3 px-4 py-2 bg-soft-blue rounded-lg">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-text-dark"><?= esc($session->get('merchant_name')) ?></p>
                        <p class="text-xs text-gray-500">
                            <i class="fas fa-store mr-1"></i>Merchant Verified
                        </p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-blue to-secondary-purple flex items-center justify-center text-white font-bold text-lg">
                        <?= strtoupper(substr($session->get('user_name'), 0, 1)) ?>
                    </div>
                </div>
                <a href="<?= base_url('logout') ?>" 
                   class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-semibold hover:bg-red-600 transition duration-200 flex items-center space-x-2">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<main class="flex-grow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php if ($session->getFlashdata('success')): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-xl"></i>
                    <span><?= esc($session->getFlashdata('success')) ?></span>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if ($session->getFlashdata('error')): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                    <span><?= esc($session->getFlashdata('error')) ?></span>
                </div>
            </div>
        <?php endif; ?>