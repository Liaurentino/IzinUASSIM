<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Halaman Utama
$routes->get('/', 'Home::index');
$routes->get('chatbot', 'Home::chatbot');
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

// Merchant
$routes->get('merchant', 'Merchant::index'); // Halaman info/ajakan
$routes->get('merchant/register', 'Merchant::register'); // Form pendaftaran
$routes->post('merchant/create', 'Merchant::create');