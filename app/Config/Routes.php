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
$routes->get('adminDashboard', 'adminController::dashboard');
$routes->get('adminLihatPsikolog', 'adminController::lihatPsikolog');
$routes->get('adminLihatMhs', 'adminController::lihatMhs');
$routes->get('forumKlien', 'homeController::forum');
$routes->get('/adminVerifikasi', 'adminController::verifikasi', ['as' => 'admin.verifikasi']);
$routes->get('adminDashboard', 'adminController::dashboard', ['as' => 'admin.dashboard']);
$routes->get('adminLihatPsikolog', 'adminController::lihatPsikolog', ['as' => 'admin.lihatPsikolog']);
$routes->get('adminLihatMhs', 'adminController::lihatMhs', ['as' => 'admin.lihatMhs']);
$routes->get('forumKlien', 'homeController::forum');
$routes->get('/forum', 'ForumController::index');
$routes->post('/forum/add', 'ForumController::addForum');
$routes->post('/forum/delete/(:num)', 'ForumController::deleteForum/$1');
$routes->get('/forum/removeAnggota/(:num)/(:num)', 'ForumController::removeAnggota/$1/$2');
$routes->get('dashboardpsikolog', 'PsikologController::dashboard');


$routes->get('/adminLihatDetailMhs/(:any)', 'adminController::lihatDetailMhs/$1', ['as' => 'admin.detailMhs']);
$routes->get('/adminLihatDetailPsikolog/(:any)', 'adminController::lihatDetailPsikolog/$1', ['as' => 'admin.detailPsikolog']);


