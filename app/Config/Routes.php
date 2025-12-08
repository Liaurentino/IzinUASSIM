<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman Utama & Statis
$routes->get('/', 'Home::index');
$routes->get('findus', 'Home::findus');

// Authentication (User Biasa)
$routes->get('login', 'Auth::login');
$routes->post('login/process', 'Auth::processLogin');
$routes->get('register', 'Auth::register');       // Menampilkan form register user
$routes->post('register/create', 'Auth::processRegister'); // Proses simpan data user
$routes->get('logout', 'Auth::logout');

// Marketplace & Reservasi (Sisi Pembeli/Publik)
$routes->get('marketplace', 'Marketplace::index');
$routes->get('marketplace/detail/(:num)', 'Marketplace::detail/$1');
$routes->get('reservation', 'Reservation::index');
$routes->post('reservation/create', 'Reservation::create');

// Chatbot
$routes->get('chatbot', 'Chatbot::index');
$routes->post('chatbot/sendMessage', 'Chatbot::sendMessage');


$routes->get('merchant', 'Merchant::index');           // Halaman Info / Landing Page Merchant
$routes->get('merchant/register', 'Merchant::register'); // Form Pendaftaran Merchant
$routes->post('merchant/create', 'Merchant::create');    // Proses Submit Data Merchant
$routes->get('merchant/waiting', 'MerchantDashboard::waiting');



$routes->group('admin', ['filter' => 'adminAuth'], function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('dashboard', 'Admin::index');
    
    // Approval Workflow
    $routes->get('approve/(:num)', 'Admin::approveMerchant/$1');
    $routes->get('reject/(:num)', 'Admin::rejectMerchant/$1');
    
    $routes->get('logout', 'Admin::logout');
});


$routes->group('merchant', ['filter' => 'merchantAuth'], function($routes) {
    $routes->get('dashboard', 'MerchantDashboard::index');
    $routes->get('products', 'MerchantDashboard::products');
    $routes->get('products/add', 'MerchantDashboard::addProduct');
    $routes->post('products/store', 'MerchantDashboard::storeProduct');
    $routes->get('reservations', 'MerchantDashboard::reservations');
    $routes->post('reservations/updateStatus/(:num)', 'MerchantDashboard::updateReservationStatus/$1');
});