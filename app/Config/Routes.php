<?php

namespace Config;

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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::indexHome');
$routes->get('/register', 'Home::indexRegister');
$routes->get('/profil', 'Home::indexProfil');
$routes->get('/detailforum/', 'Home::indexDetailforum');

$routes->get('/test', 'Home::test');
$routes->get('/forum', 'Home::indexForum');
$routes->get('/checkuser', 'Home::checkUser');
$routes->get('/loadonline', 'Home::loadOnline');
$routes->get('/loadprofil', 'Home::loadProfil');
$routes->get('/searchcatagori', 'Home::searchCatagori');
$routes->get('/sendcatagori', 'Home::sendCatagori');
$routes->get('/loadtempfile', 'Home::loadtempFile');
$routes->get('/loadchatpost', 'Home::loadchatPost');
$routes->get('/loadproteksi', 'Home::loadProteksi');
$routes->get('/loadlike', 'Home::loadLike');
$routes->get('/sendkontakpost', 'Home::sendkontakPost');
$routes->get('/sendchatpost', 'Home::sendchatPost');
$routes->get('/sendlike', 'Home::sendLike');
$routes->get('/sendproteksi', 'Home::sendProteksi');

$routes->get('/logout/(:any)', 'Home::logout/$1');
$routes->get('/deletetempfileall/(:any)', 'Home::deletetempFileall/$1');
$routes->get('/loadpost/(:any)', 'Home::loadPost/$1');
$routes->get('/loadkontakpost/(:any)', 'Home::loadkontakPost/$1');

//delete
$routes->get('/deletetempfile', 'Home::deletetempFile');

// post
$routes->post('/postuser', 'Home::insertUser');
$routes->post('/postgambar', 'Home::insertGambar');
$routes->post('/postpost', 'Home::insertPost');

// api


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
