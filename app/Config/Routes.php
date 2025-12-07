<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Halaman Utama
$routes->get('/', 'Home::index');
$routes->get('chatbot', 'Chatbot::index');
$routes->post('chatbot/sendMessage', 'Chatbot::sendMessage');
$routes->get('findus', 'Home::findus');

// Authentication
$routes->get('register', 'Auth::register');
$routes->post('register/create', 'Auth::processRegister');
$routes->get('login', 'Auth::login');
$routes->post('login/process', 'Auth::processLogin');
$routes->get('logout', 'Auth::logout');

// Reservation
$routes->get('reservation', 'Reservation::index');
$routes->post('reservation/create', 'Reservation::create');

// Marketplace
$routes->get('marketplace', 'Marketplace::index');
$routes->get('marketplace/detail/(:num)', 'Marketplace::detail/$1');

// Merchant Registration
$routes->get('merchant', 'Merchant::index'); // Halaman info/ajakan
$routes->get('merchant/register', 'Merchant::register'); // Form pendaftaran
$routes->post('merchant/create', 'Merchant::create');

    
    // Product Management
    $routes->get('products', 'MerchantDashboard::products');
    $routes->get('products/add', 'MerchantDashboard::addProduct');
    $routes->post('products/store', 'MerchantDashboard::storeProduct');
    $routes->get('products/edit/(:num)', 'MerchantDashboard::editProduct/$1');
    $routes->post('products/update/(:num)', 'MerchantDashboard::updateProduct/$1');
    $routes->post('products/delete/(:num)', 'MerchantDashboard::deleteProduct/$1');
    
    // Orders & Reservations
    $routes->get('orders', 'MerchantDashboard::orders');
    $routes->get('reservations', 'MerchantDashboard::reservations');
    $routes->post('reservations/updateStatus/(:num)', 'MerchantDashboard::updateReservationStatus/$1');
    
    // Statistics
    $routes->get('statistics', 'MerchantDashboard::statistics');



// Routes Admin (Gunakan AdminAuthFilter untuk semua rute di dalamnya)
$routes->get('admin/login', 'Admin::login');
$routes->post('admin/loginProcess', 'Admin::loginProcess');

$routes->group('admin', ['filter' => 'adminAuth'], function ($routes) {
    $routes->get('/', 'Admin::index'); // Dashboard Admin
    $routes->get('approve/(:num)', 'Admin::approveMerchant/$1'); // Setujui merchant
    $routes->get('reject/(:num)', 'Admin::rejectMerchant/$1');   // Tolak merchant
    $routes->get('logout', 'Admin::logout');
    // Tambahkan rute admin lainnya di sini jika ada
});

// Routes Merchant (Gunakan MerchantAuthFilter untuk semua rute di dalamnya)
$routes->group('merchant', ['filter' => 'merchantAuth'], function ($routes) {
    $routes->get('dashboard', 'MerchantDashboard::index'); 
    $routes->get('products', 'MerchantDashboard::products'); 
    $routes->get('reservation', 'MerchantDashboard::reservation'); 
    $routes->get('statistic', 'MerchantDashboard::statistic'); 
    $routes->get('logout', 'Auth::logout');
});

$routes->get('merchantdashboard', 'MerchantDashboard::index', ['filter' => 'merchantAuth']);

