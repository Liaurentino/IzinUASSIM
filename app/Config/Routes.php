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

// Merchant Dashboard (Protected Routes)
$routes->group('merchant/dashboard', ['filter' => 'merchantAuth'], function($routes) {
    $routes->get('/', 'MerchantDashboard::index');
    $routes->get('profile', 'MerchantDashboard::profile');
    $routes->post('profile/update', 'MerchantDashboard::updateProfile');
    
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
});

// Admin Routes
$routes->get('admin/login', 'Admin::login');
$routes->post('admin/processLogin', 'Admin::processLogin');
$routes->get('admin/logout', 'Admin::logout');

// Admin Dashboard (Protected Routes)
$routes->get('admin/dashboard', 'Admin::dashboard');
$routes->get('admin/merchants', 'Admin::merchants');
$routes->post('admin/updateMerchantStatus/(:num)', 'Admin::updateMerchantStatus/$1');
$routes->get('admin/users', 'Admin::users');
$routes->post('admin/deleteUser/(:num)', 'Admin::deleteUser/$1');
$routes->get('admin/products', 'Admin::products');
$routes->post('admin/deleteProduct/(:num)', 'Admin::deleteProduct/$1');
$routes->get('admin/reservations', 'Admin::reservations');