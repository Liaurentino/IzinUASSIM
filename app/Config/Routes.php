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
$routes->get('register', 'Auth::register');       
$routes->post('register/create', 'Auth::processRegister'); 
$routes->get('logout', 'Auth::logout');

// Marketplace & Reservasi (Sisi Pembeli/Publik)
$routes->get('marketplace', 'Marketplace::index');
$routes->get('marketplace/detail/(:num)', 'Marketplace::detail/$1');

// Reservasi Service - UPDATED
$routes->get('reservation', 'Reservation::index');
$routes->post('reservation/create', 'Reservation::create');
$routes->post('reservation/getMerchants', 'Reservation::getMerchants'); 
$routes->get('reservation/myReservations', 'Reservation::myReservations');
$routes->get('reservation/detail/(:num)', 'Reservation::detail/$1');

// Chatbot
$routes->get('chatbot', 'Chatbot::index');
$routes->post('chatbot/sendMessage', 'Chatbot::sendMessage');

//Find Us
$routes->get('findus', 'FindUs::index');

// Merchant Info & Registration
$routes->get('merchant', 'Merchant::index');          
$routes->get('merchant/register', 'Merchant::register'); 
$routes->post('merchant/create', 'Merchant::create');    
$routes->get('merchant/waiting', 'Merchant::waiting');

// Admin Routes
$routes->group('admin', ['filter' => 'adminAuth'], function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('dashboard', 'Admin::index');
    
    $routes->get('approve/(:num)', 'Admin::approveMerchant/$1');
    $routes->get('reject/(:num)', 'Admin::rejectMerchant/$1');
    
    $routes->get('logout', 'Admin::logout');
});

// Merchant Dashboard 
$routes->group('merchant', ['filter' => 'merchantAuth'], function($routes) {
    $routes->get('/', 'MerchantDashboard::index');
    $routes->get('dashboard', 'MerchantDashboard::index');
    
    $routes->get('products', 'MerchantDashboard::products');
    $routes->get('products/add', 'MerchantDashboard::addProduct');
    $routes->post('products/store', 'MerchantDashboard::storeProduct');
    
    $routes->get('dashboard/reservations', 'MerchantDashboard::reservations');
    $routes->get('dashboard/reservations/detail/(:num)', 'MerchantDashboard::reservationDetail/$1');
    $routes->post('dashboard/reservations/updateStatus/(:num)', 'MerchantDashboard::updateReservationStatus/$1');
    
    $routes->get('reservations', 'MerchantDashboard::reservations');
    $routes->post('reservations/updateStatus/(:num)', 'MerchantDashboard::updateReservationStatus/$1');
});