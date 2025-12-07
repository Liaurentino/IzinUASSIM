<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#4c70ff',
                        'secondary-purple': '#845EFD',
                        'soft-blue': '#f0f4ff',
                        'text-dark': '#1e293b',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-primary-blue to-secondary-purple text-white fixed h-full shadow-2xl z-50">
        <div class="p-6 border-b border-white/20">
            <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 2a8 8 0 100 16A8 8 0 0010 2zm-1 12H7V8h2v6zm4-6h-2v6h2V8z" clip-rule="evenodd" />
                </svg>
                <div>
                    <h1 class="text-xl font-bold">Servify</h1>
                    <p class="text-xs text-blue-100">Merchant Dashboard</p>
                </div>
            </div>
        </div>

        <!-- Merchant Info -->
        <div class="p-6 border-b border-white/20 bg-white/10">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold truncate"><?= esc($session->get('business_name')) ?></p>
                    <span class="text-xs bg-green-400 text-green-900 px-2 py-0.5 rounded-full">Verified</span>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="p-4 space-y-2">
            <a href="<?= base_url('merchant/dashboard') ?>" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Dashboard</span>
            </a>
            
            <a href="<?= base_url('merchant/dashboard/products') ?>" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span>Produk</span>
            </a>
            
            <a href="<?= base_url('merchant/dashboard/reservations') ?>" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Reservasi</span>
            </a>
            
            <a href="<?= base_url('merchant/dashboard/statistics') ?>" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span>Statistik</span>
            </a>
            
            <a href="<?= base_url('merchant/dashboard/profile') ?>" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profil</span>
            </a>
        </nav>

        <!-- Logout -->
        <div class="absolute bottom-0 w-64 p-4 border-t border-white/20">
            <a href="<?= base_url('logout') ?>" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-red-500/20 transition duration-200 text-red-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64">
        <!-- Top Bar -->
        <header class="bg-white shadow-sm sticky top-0 z-40">
            <div class="px-8 py-4 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-text-dark"><?= esc($title) ?></h2>
                <div class="flex items-center space-x-4">
                    <a href="<?= base_url('/') ?>" class="text-sm text-gray-600 hover:text-primary-blue transition duration-200">
                        Kembali ke Website
                    </a>
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-blue to-secondary-purple rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm"><?= strtoupper(substr($session->get('user_name'), 0, 1)) ?></span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="p-8">
            <!-- Flash Messages -->
            <?php if ($session->getFlashdata('success')): ?>
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 shadow-sm">
                    <p class="font-medium"><?= esc($session->getFlashdata('success')) ?></p>
                </div>
            <?php endif; ?>
            
            <?php if ($session->getFlashdata('error')): ?>
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 shadow-sm">
                    <p class="font-medium"><?= esc($session->getFlashdata('error')) ?></p>
                </div>
            <?php endif; ?>

            <!-- Page Content -->