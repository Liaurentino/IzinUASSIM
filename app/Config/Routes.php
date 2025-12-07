<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman Utama & Publik
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

// Authentication (Login/Register/Logout)
$routes->get('register', 'Auth::register');
$routes->post('register/create', 'Auth::processRegister');
$routes->get('login', 'Auth::login');
$routes->post('login/process', 'Auth::processLogin');
$routes->get('logout', 'Auth::logout');

// Pendaftaran Merchant (Publik)
$routes->get('merchant', 'Merchant::index');
$routes->get('merchant/register', 'Merchant::register');
$routes->post('merchant/create', 'Merchant::create');

// GROUP ADMIN (Dilindungi Filter Admin)
$routes->group('admin', function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('dashboard', 'Admin::index');
    $routes->get('approve/(:num)', 'Admin::approveMerchant/$1');
    $routes->get('reject/(:num)', 'Admin::rejectMerchant/$1');
    $routes->get('logout', 'Admin::logout');
});

// GROUP MERCHANT (Dilindungi - Hanya untuk merchant yang approved)
$routes->group('merchant', function($routes) {
    $routes->get('dashboard', 'MerchantDashboard::index');
    $routes->get('waiting', 'MerchantDashboard::waiting');
    
    // Produk
    $routes->get('products', 'MerchantDashboard::products');
    $routes->get('products/add', 'MerchantDashboard::addProduct');
    $routes->post('products/store', 'MerchantDashboard::storeProduct');
    
    // Reservasi
    $routes->get('reservations', 'MerchantDashboard::reservations');
    $routes->post('reservations/updateStatus/(:num)', 'MerchantDashboard::updateReservationStatus/$1');
});