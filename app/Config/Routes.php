<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');

$routes->group('auth', function ($routes) {
    $routes->get('/', 'Auth::index');
    $routes->post('login_validation', 'Auth::login_validation');
    $routes->get('logout', 'Auth::logout');

    // $routes->get('addUser/(:any)/(:any)', 'Auth::addUser/$1/$2');
});

$routes->group('dashboard', ["filter" => "authfilter"], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->post('/', 'Dashboard::index');

    // untuk SkW
    $routes->get('skw', 'Dashboard::dahsboard_skw');
    $routes->post('skw', 'Dashboard::dahsboard_skw');
});

$routes->group('data_master', ["filter" => "authfilter"], function ($routes) {
    $routes->get('user', 'Data_master::user');
    $routes->post('user/create', 'Data_master::userCreate_proccess');
    $routes->post('user/edit', 'Data_master::userEdit_proccess');
    $routes->post('user/delete', 'Data_master::userDelete_proccess');

    $routes->get('pelaksana', 'Data_master::pelaksana');
    $routes->post('pelaksana/edit', 'Data_master::pelaksanaEdit_proccess');

    $routes->get('mitra', 'Data_master::mitra');
    $routes->post('mitra/create', 'Data_master::mitraCreate_proccess');
    $routes->post('mitra/edit', 'Data_master::mitraEdit_proccess');
    $routes->post('mitra/delete', 'Data_master::mitraDelete_proccess');
});

$routes->group('kerja_sama', ["filter" => "authfilter"], function ($routes) {
    $routes->get('penguatan_fungsi', 'Kerja_sama::penguatan_fungsi');
    $routes->get('penguatan_fungsi/add', 'Kerja_sama::penguatan_fungsi_add');
    $routes->post('penguatan_fungsi/process/add', 'Kerja_sama::penguatan_fungsi_process_add');
    $routes->get('penguatan_fungsi/edit/(:num)', 'Kerja_sama::penguatan_fungsi_edit/$1');
    $routes->post('penguatan_fungsi/process/edit', 'Kerja_sama::penguatan_fungsi_process_edit');
    $routes->post('penguatan_fungsi/process/delete', 'Kerja_sama::penguatan_fungsi_process_delete');

    $routes->get('pembangunan_strategis', 'Kerja_sama::pembangunan_strategis');
    $routes->get('pembangunan_strategis/add', 'Kerja_sama::pembangunan_strategis_add');
    $routes->post('pembangunan_strategis/process/add', 'Kerja_sama::pembangunan_strategis_process_add');
    $routes->get('pembangunan_strategis/edit/(:num)', 'Kerja_sama::pembangunan_strategis_edit/$1');
    $routes->post('pembangunan_strategis/process/edit', 'Kerja_sama::pembangunan_strategis_process_edit');
    $routes->post('pembangunan_strategis/process/delete', 'Kerja_sama::pembangunan_strategis_process_delete');

    // Petugas SKW
    $routes->get('penguatan_fungsi_skw', 'Kerja_sama::penguatan_fungsi_skw');
    $routes->get('penguatan_fungsi_skw/add', 'Kerja_sama::penguatan_fungsi_skw_add');
    $routes->post('penguatan_fungsi_skw/process/add', 'Kerja_sama::penguatan_fungsi_skw_process_add');
    $routes->get('penguatan_fungsi_skw/edit/(:num)', 'Kerja_sama::penguatan_fungsi_skw_edit/$1');
    $routes->post('penguatan_fungsi_skw/process/edit', 'Kerja_sama::penguatan_fungsi_skw_process_edit');
    $routes->post('penguatan_fungsi_skw/process/delete', 'Kerja_sama::penguatan_fungsi_skw_process_delete');

    $routes->get('pembangunan_strategis_skw', 'Kerja_sama::pembangunan_strategis_skw');
    $routes->get('pembangunan_strategis_skw/add', 'Kerja_sama::pembangunan_strategis_skw_add');
    $routes->post('pembangunan_strategis_skw/process/add', 'Kerja_sama::pembangunan_strategis_skw_process_add');
    $routes->get('pembangunan_strategis_skw/edit/(:num)', 'Kerja_sama::pembangunan_strategis_skw_edit/$1');
    $routes->post('pembangunan_strategis_skw/process/edit', 'Kerja_sama::pembangunan_strategis_skw_process_edit');
    $routes->post('pembangunan_strategis_skw/process/delete', 'Kerja_sama::pembangunan_strategis_skw_process_delete');
});

$routes->group('galeri', ["filter" => "authfilter"], function ($routes) {
    $routes->get('penguatan_fungsi/dashboard', 'Galeri::penguatan_fungsi');
    $routes->get('pembangunan_strategis/dashboard', 'Galeri::pembangunan_strategis');
    $routes->get('penguatan_fungsi/info/(:num)', 'Galeri::penguatan_fungsi_info/$1');
    $routes->get('pembangunan_strategis/info/(:num)', 'Galeri::pembangunan_strategis_info/$1');
    $routes->post('penguatan_fungsi/filter', 'Galeri::penguatan_fungsi');
    $routes->post('pembangunan_strategis/filter', 'Galeri::pembangunan_strategis');
});

$routes->group('auth_mitra', function ($routes) {
    $routes->get('/', 'Auth_mitra::index');
    $routes->post('login_validation', 'Auth_mitra::login_validation');
    $routes->get('logout', 'Auth_mitra::logout');
});

$routes->group('mitra', ["filter" => "authfilter"], function ($routes) {
    $routes->get('galeri/penguatan_fungsi', 'Mitra::penguatan_fungsi');
    $routes->get('galeri/pembangunan_strategis', 'Mitra::pembangunan_strategis');
    $routes->post('galeri/penguatan_fungsi/filter', 'Mitra::penguatan_fungsi');
    $routes->post('galeri/pembangunan_strategis/filter', 'Mitra::pembangunan_strategis');
    $routes->get('galeri/penguatan_fungsi/info/(:num)', 'Mitra::penguatan_fungsi_info/$1');
    $routes->get('galeri/pembangunan_strategis/info/(:num)', 'Mitra::pembangunan_strategis_info/$1');
});

/*
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
