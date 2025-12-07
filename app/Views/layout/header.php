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
            background-color: #F8F8F8;
            font-family: 'Inter', sans-serif;
        }
        .nav-link:hover {
            color: #4c70ff;
        }
        .main-card {
            background-color: #f0f4ff;
            border: 2px solid #D1D5DB;
        }
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
    <img src="https://scontent.fcgk33-1.fna.fbcdn.net/v/t39.30808-6/583928529_122099849571120016_3728179850395384540_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=T_yKGn2uSFAQ7kNvwHTY6j5&_nc_oc=AdlCSwQfHRKqZ_0vaWoOY-nDlErSsvpQiJztbSRLdfgVy-Nd9Hz2f2ItPtmUqOwKqo1J5fQQ_Ddsz58Nlh6CknRG&_nc_zt=23&_nc_ht=scontent.fcgk33-1.fna&_nc_gid=t0O1wWRKMQ1geQ8QoyAXxQ&oh=00_AfkFCk1RjrokeSk5UtKdcyo1gcEM7_6OoJ2cxvdlwlB3Ew&oe=693B0C46" 
         alt="Servify Logo" 
         class="h-10 w-10 object-cover rounded-full shadow-sm"> <span class="text-xl font-bold text-text-dark">Servify</span>
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
                <?php if ($session->get('merchant_id') && $session->get('merchant_status') === 'Verified'): ?>
                    <a href="<?= base_url('merchant/dashboard') ?>" class="nav-link text-secondary-purple font-bold flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                <?php endif; ?>
                
                <a href="<?= base_url('logout') ?>" class="text-red-500 font-semibold hover:text-red-700">
                    Logout (<?= esc($session->get('user_name')) ?>)
                </a>
            <?php else: ?>
                <a href="<?= base_url('login') ?>" class="nav-link text-primary-blue font-semibold">Login</a>
            <?php endif; ?>
        </div>
        

        <button class="md:hidden text-text-dark focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
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