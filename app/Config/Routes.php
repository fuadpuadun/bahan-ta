<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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
$routes->get('/', 'Home::index');

$routes->get('/masuk', 'c_auth::login');
$routes->post('/masuk/auth', 'c_auth::login_auth');
$routes->get('/keluar', 'c_auth::logout');

$routes->get('/beranda', 'c_product::display');
$routes->get('/keranjang', 'c_cart::cart');
$routes->get('/addtocart/(:num)', 'c_cart::addToCart/$1');
$routes->post('/updatecart/(:num)', 'c_cart::updateItemCart/$1');
$routes->get('/removeitemcart/(:num)', 'c_cart::removeItemCart/$1');
$routes->get('/clearcart', 'c_cart::clearCart');
$routes->get('/checkout', 'c_purchase::display_form_checkout');
$routes->post('/checkout/proses', 'c_purchase::checkout');
$routes->get('/invoice', 'c_purchase::display_invoice');
//$routes->get('/konfirm', 'c_purchase::display_invoice');
$routes->get('/invoice/(:num)', 'c_purchase::invoice_detail/$1');

$routes->get('/mahasiswa/formulir', 'c_mahasiswa::formulir');
$routes->post('/mahasiswa/validasi', 'c_mahasiswa::validasi');

$routes->group('', ['filter' => 'auth'], function($routes){
	$routes->get('/mahasiswa', 'c_mahasiswa::display');
	$routes->get('/mahasiswa/tambah', 'c_mahasiswa::add');
	$routes->post('/mahasiswa/simpan', 'c_mahasiswa::store');
	$routes->get('/mahasiswa/(:num)', 'c_mahasiswa::detail/$1');
});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
