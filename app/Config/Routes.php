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

/* Edit Mahasiswa */
$routes->get('/mahasiswa/profile', 'MahasiswaController::editProfile');
$routes->post('mahasiswa/updateProfile', 'MahasiswaController::updateProfile');
$routes->post('mahasiswa/uploadProfilePicture', 'MahasiswaController::uploadProfilePicture');

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

/* CRUD FORUM */
$routes->get('/forum', 'ForumController::index');
$routes->post('/forum/create', 'ForumController::addForum');
$routes->post('/forum/delete/(:segment)', 'ForumController::deleteForum/$1');

$routes->post('/simpan-catatan', 'catatanController::addCatatan');

$routes->get('dashboardpsikolog', 'PsikologController::dashboard');
$routes->post('/psikolog/updateProfilePhoto', 'PsikologController::updateProfilePhoto');
$routes->post('/psikolog/simpanLayanan', 'PsikologController::simpanLayanan');
$routes->post('/psikolog/simpanJadwal', 'PsikologController::simpanJadwal');
$routes->post('/psikolog/update-status', 'PsikologController::updateStatusSelesai');
$routes->get('api/chat/(:segment)', 'ChatController::getChatMessages/$1');


$routes->get('/adminLihatDetailPsikolog/(:any)', 'adminController::lihatDetailPsikolog/$1');
$routes->get('/adminLihatDetailMhs/(:any)', 'adminController::lihatDetailMhs/$1');
$routes->get('verifikasi/approve/(:segment)', 'adminController::approve/$1');
$routes->get('verifikasi/reject/(:segment)', 'adminController::reject/$1');
$routes->get('/adminLihatDetailMhsPsikologi/(:any)', 'adminController::lihatDetailMhs/$1', ['as' => 'admin.detailMhsPsikologi']);
$routes->get('kelolaMading', 'adminController::kelolaMading');
$routes->delete('mading/deleteMading/(:segment)', 'adminController::deleteMading/$1');

$routes->get('/adminLihatDetailPsiko/(:any)', 'AdminController::cekVerifikasiPsikolog/$1');
$routes->get('/adminLihatDetailMahasiswa/(:any)', 'adminController::cekVerifikasiMhsPsikologi/$1');

$routes->get('pemesanan', 'transaksiController::pemesananPage');
$routes->get('/psikolog/(:segment)', 'homeController::detailPsikolog/$1');

$routes->get('/chat', 'ChatController::index');
$routes->get('/chatT', 'ChatController::train');
$routes->post('/forum/join', 'ForumController::joinForum');

$routes->post('/chat/save', 'ChatController::saveMessage');
$routes->get('chat/getMessages/(:segment)', 'ChatController::getMessages/$1');

$routes->get('/chat', 'ChatMController::index');
$routes->get('/test-save-message', 'ChatMController::testSaveMessage');
