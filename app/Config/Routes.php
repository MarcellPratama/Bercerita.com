<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'homeController::viewHomepage');
$routes->get('beranda', 'homeController::index');
$routes->get('login', 'userController::viewLogin');
$routes->post('prosesLogin', 'userController::login');
$routes->get('registrasi', 'userController::viewRegistrasi');
$routes->post('prosesRegistrasi', 'userController::registrasi');
$routes->get('logout', 'userController::logout');
$routes->get('adminVerifikasi', 'adminController::verifikasi');
$routes->get('adminDashboard', 'adminController::dashboard');
$routes->get('adminLihatPsikolog', 'adminController::lihatPsikolog');
$routes->get('adminLihatMhs', 'adminController::lihatMhs');