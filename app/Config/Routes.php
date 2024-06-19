<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// User Routes //
$routes->get('/', 'UserController::home');
$routes->get('/saktitruss', 'UserController::saktitruss');
$routes->get('/saktiglass', 'UserController::saktiglass');
$routes->post('/st-save', 'UserController::st_save');
$routes->post('/sg-save', 'UserController::sg_save');

// Admin Routes //
$routes->get('/admin', 'AdminController::login');
$routes->post('/login/save_login', 'AdminController::save_login');
$routes->get('/dashboard', 'AdminController::dashboard');
$routes->get('/divisi', 'AdminController::divisi');
$routes->get('/instansi', 'AdminController::instansi');
$routes->get('/logout', 'AdminController::logout');
$routes->get('/daftar-tamu', 'AdminController::daftarTamu');
$routes->delete('/daftar-tamu/delete/(:num)', 'AdminController::delete_daftar/$1');
$routes->get('/daftar-tamu/edit/(:segment)', 'AdminController::edit_daftar/$1');
$routes->delete('/instansi/(:num)', 'AdminController::delete_instansi/$1');
$routes->delete('/divisi/(:num)', 'AdminController::delete_divisi/$1');
