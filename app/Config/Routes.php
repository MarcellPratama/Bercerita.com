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

$routes->get('editProfile', 'homeController::EditProfile');
$routes->post('updateProfile', 'userController::update');

$routes->get('adminVerifikasi', 'adminController::verifikasi');
$routes->get('adminDashboard', 'adminController::dashboard');
$routes->get('adminLihatPsikolog', 'adminController::lihatPsikolog');
$routes->get('adminLihatMhs', 'adminController::lihatMhs');

$routes->get('forumKlien', 'homeController::forum');
$routes->get('konsultasi', 'homeController::konsultasiPage');
$routes->get('jejakPerasaan', 'homeController::jejakPerasaan');

$routes->get('adminDashboard', 'adminController::dashboard');
$routes->get('adminLihatPsikolog', 'adminController::lihatPsikolog');
$routes->get('adminLihatMhs', 'adminController::lihatMhs');
$routes->get('/adminVerifikasi', 'adminController::verifikasi', ['as' => 'admin.verifikasi']);
$routes->get('adminDashboard', 'adminController::dashboard', ['as' => 'admin.dashboard']);
$routes->get('adminLihatPsikolog', 'adminController::lihatPsikolog', ['as' => 'admin.lihatPsikolog']);
$routes->get('adminLihatMhs', 'adminController::lihatMhs', ['as' => 'admin.lihatMhs']);

$routes->get('/forum', 'ForumController::index');
$routes->post('/forum/create', 'ForumController::addForum');
$routes->post('/forum/delete/(:segment)', 'ForumController::deleteForum/$1');

$routes->post('/simpan-catatan', 'catatanController::addCatatan');

$routes->get('dashboardpsikolog', 'PsikologController::dashboard');

$routes->get('/adminLihatDetailPsikolog/(:any)', 'adminController::lihatDetailPsikolog/$1');
$routes->get('/adminLihatDetailMhs/(:any)', 'adminController::lihatDetailMhs/$1');
$routes->get('verifikasi/approve/(:segment)', 'adminController::approve/$1');
$routes->get('verifikasi/reject/(:segment)', 'adminController::reject/$1');
$routes->get('/adminLihatDetailMhsPsikologi/(:any)', 'adminController::lihatDetailMhs/$1', ['as' => 'admin.detailMhsPsikologi']);
$routes->get('kelolaMading', 'adminController::kelolaMading');
$routes->delete('mading/deleteMading/(:segment)', 'adminController::deleteMading/$1');