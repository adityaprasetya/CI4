<?php

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// $routes->get('/', 'Home::index');
$routes->get('/', 'Pages::index');

// Product -> Page
$routes->get('/pages/product', 'Pages::product');
$routes->get('/pages/kode_pj', 'Pages::kode_pj');
$routes->get('/pages/product/(:segment)', 'Pages::detail/$1');
// Product -> Input
$routes->get('/pages/create', 'Pages::create');
$routes->post('/pages/save', 'Pages::save');
// Product -> Update
$routes->get('/pages/edit/(:segment)', 'Pages::edit/$1');

// Product -> Delete
$routes->delete('/pages/(:num)', 'Pages::delete/$1');
$routes->delete('/pages/pelanggan/(:num)', 'Pages::delete_pl/$1');
$routes->delete('/pages/supplier/(:num)', 'Pages::delete_sl/$1');
$routes->delete('/pages/penjualan/(:num)', 'Pages::delete_pj/$1');
// Contact -> Page
$routes->get('/pages/contact', 'Pages::contact');
// About -> Page
$routes->get('/pages/about', 'Pages::about');
