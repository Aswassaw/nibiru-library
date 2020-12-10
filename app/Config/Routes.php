<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// Routes controller LoginController
$routes->add('/', 'LoginController::index', ['filter' => 'noauth']);
$routes->add('logout', 'LoginController::logout', ['filter' => 'auth']);

// Routes controller LibraryController
$routes->add('home', 'LibraryController::index', ['filter' => 'auth']);
$routes->add('library', 'LibraryController::library', ['filter' => 'auth']);
$routes->add('kategoriCepat/(:any)', 'LibraryController::kategoriCepat/$1', ['filter' => 'auth']);
$routes->add('detailBuku/(:num)', 'LibraryController::detailBuku/$1', ['filter' => 'auth']);
$routes->add('pinjamBuku/(:num)', 'LibraryController::pinjamBuku/$1', ['filter' => 'auth']);
$routes->add('kembalikanBuku/(:num)', 'LibraryController::kembalikanBuku/$1', ['filter' => 'auth']);
$routes->add('likeBuku/(:num)', 'LibraryController::likeBuku/$1', ['filter' => 'auth']);

// Routes controller AdminController
$routes->add('admin', 'AdminController::index', ['filter' => 'auth']);
// User
$routes->add('user', 'AdminController::user', ['filter' => 'auth']);
$routes->add('addUser', 'AdminController::addUser', ['filter' => 'auth']);
$routes->add('saveAddUser', 'AdminController::saveAddUser', ['filter' => 'auth']);
$routes->add('updateUser/(:num)', 'AdminController::updateUser/$1', ['filter' => 'auth']);
$routes->add('saveUpdateUser/(:num)', 'AdminController::saveUpdateUser/$1', ['filter' => 'auth']);
$routes->add('deleteUser/(:num)', 'AdminController::deleteUser/$1', ['filter' => 'auth']);
// Buku
$routes->add('book', 'AdminController::book', ['filter' => 'auth']);
$routes->add('addBuku', 'AdminController::addBuku', ['filter' => 'auth']);
$routes->add('saveAddBuku', 'AdminController::saveAddBuku', ['filter' => 'auth']);
$routes->add('updateBuku/(:num)', 'AdminController::updateBuku/$1', ['filter' => 'auth']);
$routes->add('saveUpdateBuku/(:num)', 'AdminController::saveUpdateBuku/$1', ['filter' => 'auth']);
$routes->add('deleteBuku/(:num)', 'AdminController::deleteBuku/$1', ['filter' => 'auth']);
// Kategori
$routes->add('kategori', 'AdminController::kategori', ['filter' => 'auth']);
$routes->add('addKategori', 'AdminController::addKategori', ['filter' => 'auth']);
$routes->add('saveAddKategori', 'AdminController::saveAddKategori', ['filter' => 'auth']);
$routes->add('updateKategori/(:num)', 'AdminController::updateKategori/$1', ['filter' => 'auth']);
$routes->add('saveUpdateKategori/(:num)', 'AdminController::saveUpdateKategori/$1', ['filter' => 'auth']);
$routes->add('deleteKategori/(:num)', 'AdminController::deleteKategori/$1', ['filter' => 'auth']);
// Peminjaman dan Pengembalian
$routes->add('peminjaman', 'AdminController::peminjaman', ['filter' => 'auth']);
$routes->add('pengembalian', 'AdminController::pengembalian', ['filter' => 'auth']);
// Cetak Laporan
$routes->add('cetakLaporanPeminjaman/(:num)', 'AdminController::cetakLaporanPeminjaman/$1', ['filter' => 'auth']);
$routes->add('cetakLaporanPengembalian/(:num)', 'AdminController::cetakLaporanPengembalian/$1', ['filter' => 'auth']);

// Routes controller UserController
$routes->add('profile', 'UserController::index', ['filter' => 'auth']);
$routes->add('updateFotoUser', 'UserController::updateFotoUser', ['filter' => 'auth']);
$routes->add('updateProfile', 'UserController::updateProfile', ['filter' => 'auth']);
$routes->add('saveUpdateProfile', 'UserController::saveUpdateProfile', ['filter' => 'auth']);
$routes->add('myBook', 'UserController::myBook', ['filter' => 'auth']);

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
