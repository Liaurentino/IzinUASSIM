<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tailwind Config for custom colors/fonts -->
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
    <!-- Custom Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body {
            background-color: #F8F8F8; /* Background abu-abu muda */
            font-family: 'Inter', sans-serif;
        }
        .nav-link:hover {
            color: #4c70ff;
        }
        .main-card {
            background-color: #f0f4ff; /* soft-blue */
            border: 2px solid #D1D5DB;
        }
        /* Style untuk hover form pendaftaran merchant */
        #merchant-cta-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(76, 112, 255, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

<!-- Navbar -->
<nav class="w-full bg-white shadow-md p-4 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="<?= base_url('/') ?>" class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-secondary-purple" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 2a8 8 0 100 16A8 8 0 0010 2zm-1 12H7V8h2v6zm4-6h-2v6h2V8z" clip-rule="evenodd" />
                <path d="M10 0C4.477 0 0 4.477 0 10s4.477 10 10 10 10-4.477 10-10S15.523 0 10 0zM7 14h2V8H7v6zm4 0h2V8h-2v6z" fill="#845EFD"/>
            </svg>
            <span class="text-xl font-bold text-text-dark">Servify</span>
        </a>

        <!-- Menu Navigasi -->
        <div class="space-x-8 hidden md:flex text-text-dark font-medium">
            <a href="<?= base_url('/') ?>" class="nav-link">Home</a>
            <a href="<?= base_url('marketplace') ?>" class="nav-link">Marketplace</a>
            <a href="<?= base_url('reservation') ?>" class="nav-link">Reservation</a>
            <a href="<?= base_url('chatbot') ?>" class="nav-link">Chatbot</a>
            <a href="<?= base_url('findus') ?>" class="nav-link">Find Us</a>
            <a href="<?= base_url('merchant') ?>" class="nav-link">Merchant</a>
            <?php if ($session->get('isLoggedIn')): ?>
                <a href="<?= base_url('logout') ?>" class="text-red-500 font-semibold hover:text-red-700">Logout (<?= esc($session->get('user_name')) ?>)</a>
            <?php else: ?>
                <a href="<?= base_url('login') ?>" class="nav-link text-primary-blue font-semibold">Login</a>
            <?php endif; ?>
        </div>
        
        <!-- Mobile Menu Button (Optional, not implemented fully but good practice) -->
        <button class="md:hidden text-text-dark focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>
</nav>

<!-- Content Area -->
<main class="flex-grow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Notifikasi Flashdata -->
        <?php if ($session->getFlashdata('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= esc($session->getFlashdata('success')) ?></span>
            </div>
        <?php endif; ?>
        <?php if ($session->getFlashdata('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= esc($session->getFlashdata('error')) ?></span>
            </div>
        <?php endif; ?>

<!-- Konten Halaman dimulai di sini -->