<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('University');
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
$routes->get('/', 'University::index');
$routes->get('register', 'University::register');
$routes->post('register', 'University::register');
$routes->get('activate/(:any)', 'University::activate/$1');
$routes->get('login', 'University::login');
$routes->post('login', 'University::login');
$routes->get('dashboard', 'Dashboard::index',['filter'=>'LimitAccessFilter']);
$routes->get('logout', 'Dashboard::logOut',['filter'=>'LimitAccessFilter']);
$routes->get('loginactivity', 'Dashboard::login_activity',['filter'=>'LimitAccessFilter']);
$routes->get('avatar', 'Dashboard::avatarUpload',['filter'=>'LimitAccessFilter']);
$routes->post('avatar', 'Dashboard::avatarUpload');
$routes->get('changepassword', 'Dashboard::changePassword',['filter'=>'LimitAccessFilter']);
$routes->post('changepassword', 'Dashboard::changePassword');

$routes->get("auto", "AutoController::index");
$routes->get("employee", "EmployeeController::addEmp");
$routes->post("employee", "EmployeeController::addEmp");
$routes->get("view", "EmployeeController::viewEmp");
$routes->get("edit/(:num)", "EmployeeController::editEmp/$1");
$routes->post("edit/(:num)", "EmployeeController::editEmp/$1");
$routes->get("delete/(:num)", "EmployeeController::deleteEmp/$1");
$routes->get("test", "TestController::index");
$routes->get("migrate", "TestController::migration");


//fiter routes
// $routes->group('',['filter'=>'LimitAccessFilter'], function ($routes) {
//     $routes->get('dashboard', 'Dashboard::index');
//     $routes->get('changepassword', 'Dashboard::changePassword');
//     $routes->get('avatar', 'Dashboard::avatarUpload');
// });


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
