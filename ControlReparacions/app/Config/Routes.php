<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Tcikets Routes
$routes->GET('/tickets', 'TicketsController::tickets');
$routes->POST('/tickets', 'TicketsController::tickets');
$routes->GET('/ticketinfo/(:segment)', 'TicketsController::ticketInfo/$1');
$routes->GET('/ticketform', 'TicketsController::ticketForm');

$routes->POST('/addticket', 'TicketsController::addTicket');
$routes->GET('/deleteticket/(:segment)', 'TicketsController::deleteTicket/$1');
// $routes->GET('/modifyticket/(:segment)', 'TicketsController::deleteTicket/$1');
$routes->GET('/modifyticket/(:segment)', 'Home::empty');

$routes->GET('/export/xls/(:segment)', 'TicketsController::exportXLS/$1');
$routes->GET('/export/xls', 'TicketsController::exportXLS');

$routes->GET('/export/csv/(:segment)', 'TicketsController::exportCSV/$1');
$routes->GET('/export/csv', 'TicketsController::exportCSV');

//Intervention Routes
$routes->GET('/intervention', 'Home::empty');
$routes->GET('/interventionform', 'Home::empty');


//Students Routes
$routes->GET('/students', 'Home::empty');
$routes->GET('/studentsform', 'Home::empty');


//Institute Routes
$routes->GET('/institutes', 'Home::empty');
$routes->GET('/assign', 'Home::empty');
$routes->GET('/instituteform', 'Home::empty');
$routes->GET('/inventary', 'Home::empty');


//Common Routes
$routes->GET('/logout', 'Home::logout'); // como no funcionaba el logout lo puse el de estamos trabjando en ellox
$routes->GET('/login', 'Home::login');
$routes->POST('/login', 'Home::login_post');
$routes->GET('', 'Home::login');
$routes->GET('/', 'Home::login');

// User Routes
$routes->GET('/config', 'UserController::config');
$routes->POST('/config', 'UserController::config_post');
