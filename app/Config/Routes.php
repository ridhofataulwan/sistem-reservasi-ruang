<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('/', function ($routes) {
    //Auth Controller
    $routes->get('signup', 'Auth::signup');
    $routes->get('signin', 'Auth::signin');
    $routes->post('select-bidang', 'Auth::showBidang');
    $routes->post('signin', 'Auth::signinAttempt');
    $routes->get('forgot-password', 'Auth::forgotPassword');
    $routes->post('forgot-password', 'Auth::forgotPasswordAttempt');
    $routes->get('reset-password/(:any)', 'Auth::resetPassword/$1');
    $routes->post('reset-password/(:any)', 'Auth::resetPasswordAttempt/$1');
    $routes->get('activate/(:any)', 'Auth::activateAttempt/$1');
    $routes->get('signout', 'Auth::signout');

    //Home controller
    $routes->get('', 'Home::index');
    $routes->get('dashboard', 'Home::dashboard');
    $routes->get('kalender', 'Home::calendar');

    //User Controller
    $routes->get('daftar-user', 'Users::users');
    $routes->get('profile', 'Users::detail');
    $routes->get('profile/(:segment)', 'Users::detail/$1');
    $routes->get('profile/update', 'Users::update');
    $routes->add('profile/update', 'Users::updateAttempt');
    $routes->get('profile/delete/(:any)', 'Users::deleteUser/$1');
    $routes->add('profile/set-to-admin/', 'Users::setToAdmin/');
    $routes->add('profile/set-to-user/', 'Users::setToUser/');
    //Testing only
    $routes->add('profile/sa/(:any)', 'Users::setToSuperAdmin/$1');

    //OPD Controller
    $routes->get('daftar-opd', 'Opd::listOpd');
    $routes->get('opd/(:segment)', 'Opd::detail/$1');
    $routes->get('opd/', 'Opd::detail');
    $routes->get('opd/insert', 'Opd::insert');
    $routes->add('opd/insert', 'Opd::insertAttempt');
    $routes->get('opd/update/(:any)', 'Opd::update/$1');
    $routes->add('opd/update/(:any)', 'Opd::updateAttempt/$1');
    $routes->get('opd/delete/(:any)', 'Opd::deleteOpd/$1');

    //Gedung Controller
    $routes->get('daftar-gedung', 'Gedung::listGedung');
    $routes->get('gedung/(:segment)', 'Gedung::detail/$1');
    $routes->get('gedung/insert', 'Gedung::insert');
    $routes->add('gedung/insert', 'Gedung::insertAttempt');
    $routes->get('gedung/update/(:any)', 'Gedung::update/$1');
    $routes->add('gedung/update/(:any)', 'Gedung::updateAttempt/$1');
    $routes->get('gedung/delete/(:any)', 'Gedung::deleteGedung/$1');

    //Ruang Controller
    $routes->get('daftar-ruang', 'Ruang::listRuang');
    $routes->get('ruang/(:segment)', 'Ruang::detail/$1');
    $routes->get('ruang/insert', 'Ruang::insert');
    $routes->add('ruang/insert', 'Ruang::insertAttempt');
    // ! Saya comment karena sudah tidak digunakan Edit Ruang Menggunakan Modal
    // $routes->get('ruang/update/(:any)', 'Ruang::update/$1');
    $routes->post('ruang/update/(:any)', 'Ruang::updateAttempt/$1');
    $routes->get('ruang/delete/(:any)', 'Ruang::deleteRuang/$1');

    // Acara Controller
    $routes->get('daftar-acara', 'Acara::listAcara');
    $routes->get('acara/(:segment)', 'Acara::detail/$1');
    $routes->get('acara/insert', 'Acara::insert');
    $routes->add('acara/insert', 'Acara::insertAttempt');
    $routes->get('acara/update/(:any)', 'Acara::update/$1');
    $routes->add('acara/update/(:any)', 'Acara::updateAttempt/$1');
    $routes->get('acara/delete/(:any)', 'Acara::deleteAcara/$1');
    $routes->post('acara/(:num)', 'Acara::setStatusAcara/$1');

    // Reservasi Controller
    $routes->get('reservasi', 'Reservasi::listReservasi');
    $routes->get('reservasi/saya', 'Reservasi::listMyReservasi');
    $routes->get('reservasi/opd', 'Reservasi::listValidationReservasi');
    $routes->get('reservasi/setOnGoing', 'Reservasi::setOnGoing');
    $routes->get('reservasi/setFinished', 'Reservasi::setFinished');
    $routes->get('reservasi/setApprove/(:any)', 'Reservasi::setApprove/$1');
    $routes->get('reservasi/(:segment)', 'Reservasi::detail/$1');
    $routes->add('reservasi/insert', 'Reservasi::insertAttempt');
    $routes->get('reservasi/update/(:segment)', 'Reservasi::update/$1');
    $routes->add('reservasi/update/', 'Reservasi::updateAttempt');
    $routes->get('reservasi/terima/(:segment)', 'Reservasi::setApprove/$1');
    $routes->get('reservasi/tolak/(:segment)', 'Reservasi::setDecline/$1');
    $routes->post('reservasi/batal', 'Reservasi::setCancel');

    //Bidang Controller
    $routes->add('bidang/insert', 'Bidang::insertAttempt');
    $routes->add('bidang/update', 'Bidang::updateAttempt');
    $routes->post('edit-bidang', 'Bidang::update');
    $routes->get('bidang/delete/(:segment)', 'Bidang::delete/$1');

    // Routes untuk showGedung select option
    $routes->post('select-gedung', 'Gedung::selectGedung');

    // Routes untuk list ruang  daftar ruang dalam gedung tertentu
    $routes->post('list-ruang', 'Ruang::showRuang');
    $routes->post('list-ruang-opd', 'Ruang::showRuangOpd');
    // Routes untuk menampilkan informasi OPD
    $routes->post('showOpd', 'Opd::showOpd');
    // Routes untuk list gedung  daftar gedung dalam gedung tertentu
    $routes->post('list-gedung', 'Gedung::showGedung');

    // Routes Teambahan untuk Ajax
    $routes->post('detail-ruang', 'Ruang::detailRuang');
    $routes->post('edit-ruang', 'Ruang::editRuang');

    $routes->post('edit-gedung', 'Gedung::editGedung');

    // Realtime Set Status
    $routes->post('set-status-acara', 'Acara::setStatusAcaraAjax');

    // Routes untuk selectRuang pada Reservasi select option
    $routes->post('select-ruang', 'Ruang::selectRuang');

    // Edit Gedung Modal
    $routes->post('edit-opd', 'Opd::editOpd');

    //Routes untuk menampilkan reservasi di calendar
    $routes->get('reservasi-calendar', 'Reservasi::reservasiCalendar');

    // Routes untuk menampilkan respon validasi approve
    $routes->post('approve-reservasi', 'Reservasi::setApprove');

    // Routes untuk menampilkan respon validasi approve final 
    $routes->post('approve-def-reservasi', 'Reservasi::setDefApprove');

    // Routes untuk menampilkan respon validasi decline
    $routes->post('decline-reservasi', 'Reservasi::setDecline');

    // Routes Edit Reservasi Modal with Ajax
    $routes->post('edit-reservasi', 'Reservasi::editReservasi');

    // Routes Detail Reservasi Modal with Ajax
    $routes->post('detail-reservasi', 'Reservasi::detailReservasi');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
