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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
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
$routes->get('/', 'Home::index');

// route group admin

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {

    $routes->get('dashboard', 'Admin::dashboard');

    // Servis
    $routes->group('servis', function ($routes) {
        $routes->get('/', 'DataServis::data_servis');
        $routes->post('/', 'DataServis::tambah_data_servis');
        $routes->delete('(:segment)', 'DataServis::delete_data_servis/$1');

        $routes->group('(:any)/detail', function ($routes) {
            $routes->get('/', 'DataServis::detail_servis/$1');
            // $routes->post('/', 'DataServis::tambah_barang_servis/$1');
            // $routes->put('/', 'DataServis::update_barang_servis');
            // $routes->delete('(:segment)', 'DataServis::delete_barang_servis/$2');
        });

        $routes->group('(:any)/barang', function ($routes) {
            $routes->get('/', 'DataServis::barang_data_servis/$1');
            $routes->post('/', 'DataServis::tambah_barang_servis/$1');
            $routes->put('/', 'DataServis::update_barang_servis');
            $routes->delete('(:segment)', 'DataServis::delete_barang_servis/$2');
        });

        $routes->group('(:segment)', function ($routes) {
            $routes->get('/', 'DataServis::data_servis/$1');
            $routes->post('/', 'DataServis::tambah_servis_barang/$1');
            // $routes->put('/', 'DataServis::update_barang_servis');
            $routes->delete('(:segment)/(:num)', 'DataServis::delete_servis_barang/$2/$3');
        });

        $routes->get('(:any)/send', 'DataServis::send/$1');
        $routes->get('(:any)/proses', 'DataServis::proses_konfirmasi/$1');
        $routes->get('(:any)/batalkan', 'DataServis::batal_proses/$1');
        $routes->get('(:any)/bayar', 'DataServis::bayar_proses/$1');
    });

    // Jasa Servis
    $routes->group('jasa_servis', function ($routes) {

        $routes->get('/', 'JasaServis::jasa_servis');
        $routes->post('/', 'JasaServis::tambah_jasa_servis');
        $routes->put('/', 'JasaServis::update_jasa_servis');
        $routes->delete('(:num)', 'JasaServis::delete_jasa_servis/$1');
    });


    // handle route not found
    // $routes->addRedirect('/', 'admin/dashboard');
    // $routes->addRedirect('(:any)', 'admin/dashboard');
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
