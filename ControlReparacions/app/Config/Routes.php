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

$routes->GET('/export/(:segment)', 'TicketsController::exportCSV/$1');
$routes->GET('/export', 'TicketsController::exportCSV');

//Intervention Routes
$routes->GET('/intervention', 'InterventionController::intervention');
$routes->GET('/interventionform', 'InterventionController::interventionForm');


//Students Routes
$routes->GET('/students', 'StudentsController::students');
$routes->GET('/studentsform', 'StudentsController::studentsForm');


//Institute Routes
$routes->GET('/institutes', 'InstitutesController::institutes');
$routes->GET('/assign', 'InstitutesController::assign');
$routes->GET('/instituteform', 'InstitutesController::instituteForm');


//Common Routes
$routes->GET('/logout', 'Home::logout');
$routes->GET('/login', 'Home::login');
$routes->POST('/login', 'Home::login_post');
$routes->GET('', 'Home::login');
$routes->GET('/', 'Home::login');

// User Routes
$routes->GET('/config', 'UserController::config');
$routes->POST('/config', 'UserController::config_post');
