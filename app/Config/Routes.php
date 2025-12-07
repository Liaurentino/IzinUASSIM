<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --------------------------------------------------------------------
// Halaman Utama & Publik
// --------------------------------------------------------------------
$routes->get('/', 'Home::index');
$routes->get('findus', 'Home::findus');

// Chatbot
$routes->get('chatbot', 'Chatbot::index');
$routes->post('chatbot/sendMessage', 'Chatbot::sendMessage');

// Marketplace (Sisi Pembeli)
$routes->get('marketplace', 'Marketplace::index');
$routes->get('marketplace/detail/(:num)', 'Marketplace::detail/$1');

// Reservasi (Sisi Pembeli)
$routes->get('reservation', 'Reservation::index');
$routes->post('reservation/create', 'Reservation::create');

// --------------------------------------------------------------------
// Authentication (Login/Register/Logout)
// --------------------------------------------------------------------
$routes->get('register', 'Auth::register');
$routes->post('register/create', 'Auth::processRegister');
$routes->get('auth/login', 'Auth::login'); // Saya seragamkan pakai auth/login sesuai filter
$routes->get('login', 'Auth::login');      // Alias
$routes->post('login/process', 'Auth::processLogin');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('logout', 'Auth::logout');    // Alias

// --------------------------------------------------------------------
// Pendaftaran Merchant (Publik)
// --------------------------------------------------------------------
$routes->get('merchant', 'Merchant::index');         // Halaman landing merchant
$routes->get('merchant/register', 'Merchant::register'); 
$routes->post('merchant/create', 'Merchant::create');

// --------------------------------------------------------------------
// GROUP ADMIN (Dilindungi Filter Admin)
// --------------------------------------------------------------------
$routes->group('admin', ['filter' => 'adminAuth'], function ($routes) {
    $routes->get('/', 'Admin::index'); 
    $routes->get('dashboard', 'Admin::index');
    
    // Verifikasi Merchant
    $routes->get('approve/(:num)', 'Admin::approveMerchant/$1'); 
    $routes->get('reject/(:num)', 'Admin::rejectMerchant/$1');   
    
    $routes->get('logout', 'Admin::logout');
});

// --------------------------------------------------------------------
// GROUP MERCHANT (Dilindungi Filter Merchant)
// Semua URL di sini otomatis berawalan /merchant/...
// --------------------------------------------------------------------
$routes->group('merchant', ['filter' => 'merchantAuth'], function ($routes) {
    
    // Dashboard Utama
    $routes->get('dashboard', 'MerchantDashboard::index'); 
    
    // Manajemen Produk (CRUD)
    $routes->get('products', 'MerchantDashboard::products');
    $routes->get('products/add', 'MerchantDashboard::addProduct');
    $routes->post('products/store', 'MerchantDashboard::storeProduct');
    $routes->get('products/edit/(:num)', 'MerchantDashboard::editProduct/$1');
    $routes->post('products/update/(:num)', 'MerchantDashboard::updateProduct/$1');
    $routes->post('products/delete/(:num)', 'MerchantDashboard::deleteProduct/$1');

    // Manajemen Pesanan & Reservasi
    $routes->get('orders', 'MerchantDashboard::orders');
    $routes->get('reservation', 'MerchantDashboard::reservation'); // Alias 1
    $routes->get('reservations', 'MerchantDashboard::reservations'); // Alias 2 (sesuaikan nama fungsi di controller)
    $routes->post('reservations/updateStatus/(:num)', 'MerchantDashboard::updateReservationStatus/$1');

    // Statistik
    $routes->get('statistic', 'MerchantDashboard::statistic');   // Alias 1
    $routes->get('statistics', 'MerchantDashboard::statistics'); // Alias 2

    $routes->get('logout', 'Auth::logout');
});

// Route alternatif untuk dashboard (jika user mengakses tanpa prefix /merchant)
$routes->get('merchantdashboard', 'MerchantDashboard::index', ['filter' => 'merchantAuth']);