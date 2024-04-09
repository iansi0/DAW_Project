<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Tcikets Routes
$routes->GET('/tickets', 'Home::tickets');
$routes->POST('/tickets', 'Home::tickets');
$routes->GET('/ticketinfo', 'Home::ticketinfo');
$routes->GET('/ticketform', 'Home::ticketForm');



//Intervention Routes
$routes->GET('/intervention', 'Home::intervention');
$routes->GET('/interventionform', 'Home::interventionForm');


//Students Routes
$routes->GET('/students', 'Home::students');
$routes->GET('/studentsform', 'Home::studentsForm');


//Institute Routes
$routes->GET('/institutes', 'Home::institutes');
$routes->GET('/assign', 'Home::assign');
$routes->GET('/instituteform', 'Home::instituteForm');


//Common Routes
$routes->GET('/login', 'Home::login');
$routes->GET('', 'Home::login');
