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
$routes->setDefaultController('Pelanggan\Home');
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

// routes raja ongkir
$routes->group('rajaongkir', function ($routes) {
    $routes->get('getCity', 'RajaOngkirC::getCity');
    $routes->get('getCost', 'RajaOngkirC::getCost');
});

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->get('getJumlahPesanan', 'ApiPelanggan::getCountPesanan');
    $routes->post('autocomplete_servis', 'ApiAdmin::autocomplete_servis');
});

// routes group pelanggan
$routes->group('/', ['namespace' => 'App\Controllers\Pelanggan'], function ($routes) {
    $routes->get('', 'Home');
    $routes->get('cekservis', 'Home::cekservis');
    $routes->get('biaya_servis', 'Home::biaya_servis');
    $routes->add('pembelian/(:segment)', 'Pembelian::detail_pembelian/$1');
    $routes->get('pesanan', 'Pembelian::pembelian');

    $routes->group('produk', function ($routes) {
        $routes->get('/', 'Produk');
        $routes->get('(:segment)', 'Produk::detail_produk/$1');
    });

    $routes->group('keranjang', function ($routes) {
        $routes->get('/', 'Produk::keranjang');
        $routes->post('', 'Produk::tambah_keranjang');
        $routes->put('', 'Produk::update_keranjang');
        $routes->get('hapus/(:any)', 'Produk::hapus_keranjang/$1');
    });

    $routes->group('checkout', function ($routes) {
        $routes->get('/', 'Produk::checkout_info');
        $routes->post('/', 'Produk::checkout_proses');
    });

    $routes->group('pembayaran', function ($routes) {
        $routes->get('(:segment)', 'Pembelian::pembayaran_view/$1');
        $routes->post('(:segment)', 'Pembelian::pembayaran_proses/$1');
        // $routes->put('', 'Pembelian::update_keranjang');
    });

    $routes->group('profile', function ($routes) {
        $routes->get('/', 'Home::profile');
        $routes->put('/', 'Home::edit_profile');
    });

    $routes->group('auth', function ($routes) {
        $routes->addRedirect('', 'auth/login');

        $routes->get('login', 'Auth::login');
        $routes->post('proseslogin', 'Auth::proses_login');

        $routes->get('register', 'Auth::register');
        $routes->post('prosesregister', 'Auth::proses_register');

        $routes->get('logout', 'Auth::logout');
    });
});


// route group admin

$routes->add('admin/auth/login', 'Admin\Auth::login');
$routes->get('admin/auth/logout', 'Admin\Auth::logout');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'isLoggedInAdmin'], function ($routes) {


    $routes->get('dashboard', 'Admin::dashboard');

    $routes->group('produk', function ($routes) {
        $routes->get('/', 'Produk');
        $routes->match(['get', 'put'], '(:num)', 'Produk::form_edit/$1');

        $routes->delete('(:num)', 'Produk::delete_produk/$1');

        $routes->add('tambah', 'Produk::form_tambah');
    });

    $routes->group('barang_masuk', function ($routes) {
        $routes->get('/', 'BarangMasuk');
        $routes->match(['get', 'put'], '(:num)', 'BarangMasuk::form_edit/$1');

        $routes->delete('(:num)', 'BarangMasuk::delete_barang_masuk/$1');

        $routes->add('tambah', 'BarangMasuk::form_tambah');
    });

    $routes->group('penjualan', function ($routes) {
        $routes->get('/', 'Penjualan');
        $routes->add('(:segment)', 'Penjualan::detail_penjualan/$1');
        // $routes->get('', '');
    });

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

        $routes->group('(:any)/part', function ($routes) {
            $routes->get('/', 'DataServis::data_part_servis/$1');
            $routes->post('/', 'DataServis::tambah_part_servis/$1');
            $routes->put('/', 'DataServis::update_part_servis');
        });

        $routes->group('(:segment)', function ($routes) {
            $routes->get('/', 'DataServis::data_servis/$1');
            $routes->post('/', 'DataServis::tambah_servis_barang/$1');
            // $routes->put('/', 'DataServis::update_barang_servis');
            $routes->delete('(:segment)/(:num)', 'DataServis::delete_servis_barang/$2/$3');
            $routes->delete('(:segment)/(:num)/part', 'DataServis::delete_part_servis/$2/$3');
        });

        $routes->get('(:any)/send', 'DataServis::send/$1');
        $routes->get('(:any)/proses', 'DataServis::proses_konfirmasi/$1');
        $routes->get('(:any)/batalkan', 'DataServis::batal_proses/$1');
        $routes->post('(:any)/bayar', 'DataServis::bayar_proses/$1');
    });

    // Jasa Servis
    $routes->group('jasa_servis', function ($routes) {

        $routes->get('/', 'JasaServis::jasa_servis');
        $routes->post('/', 'JasaServis::tambah_jasa_servis');
        $routes->put('/', 'JasaServis::update_jasa_servis');
        $routes->delete('(:num)', 'JasaServis::delete_jasa_servis/$1');
    });

    $routes->group('part_produk', function ($routes) {

        $routes->get('/', 'PartProduk');
        $routes->post('/', 'PartProduk::tambah_part_produk');
        $routes->put('/', 'PartProduk::update_part_produk');
        $routes->delete('(:num)', 'PartProduk::delete_part_produk/$1');
    });

    $routes->group('info_badge', function ($routes) {
        $routes->get('data_servis', 'InfoBadge::badgeDataServis');
        $routes->get('data_penjualan', 'InfoBadge::badgeDataPenjualan');
    });

    $routes->group('setting', function ($routes) {

        $routes->add('/', 'Admin::setting_view');
    });

    $routes->group('promosi', function ($routes) {
        $routes->get('/', 'Admin::data_promosi');

        $routes->delete('(:num)', 'Admin::delete_promosi/$1');

        $routes->add('tambah', 'Admin::proses_tambah_promosi');
    });

    $routes->group('pengguna', function ($routes) {
        $routes->get('status/(:num)', 'Pengguna::set_status/$1', ['filter' => 'isNotAdmin']);

        $routes->add('tambah', 'Pengguna::tambah_pengguna', ['filter' => 'isNotAdmin']);

        $routes->get('/', 'Pengguna::index', ['filter' => 'isNotAdmin']);
        $routes->get('(:num)', 'Pengguna::profile/$1', ['filter' => 'isNotAdmin']);
        $routes->put('(:num)', 'Pengguna::edit_profile', ['filter' => 'isNotAdmin']);

        $routes->group('profile', function ($routes) {
            $routes->get('/', 'Pengguna::profile');
            $routes->put('/', 'Pengguna::edit_profile');
        });

        $routes->delete('(:num)', 'Pengguna::delete_pengguna_admin/$1');

        // $routes->group('profile', function ($routes) {
        //     $routes->get('(:num)', 'Pengguna::profile/$1');
        // });
    });

    $routes->group('laporan', function ($routes) {
        $routes->add('penjualan', 'Laporan::penjualan');
        $routes->add('servis', 'Laporan::servis');
    });


    // handle route not found
    $routes->addRedirect('/', 'admin/dashboard');
    $routes->addRedirect('(:any)', 'admin/dashboard');
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
