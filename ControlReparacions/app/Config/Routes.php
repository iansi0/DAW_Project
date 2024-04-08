<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Tcikets Routes
$routes->get('{locale}/tickets', 'Home::tickets');
$routes->get('/{locale}/ticketinfo', 'Home::ticketinfo');
$routes->get('/{locale}/ticketform', 'Home::ticketForm');

//Intervention Routes
$routes->get('/{locale}/intervention', 'Home::intervencion');
$routes->get('/{locale}/interventionForm', 'Home::intervencionForm');


//Students Routes
$routes->get('/{locale}/students', 'Home::students');
$routes->get('/{locale}/studentsform', 'Home::studentsForm');


//Institute Routes
$routes->get('/{locale}/institutes', 'Home::institutes');
$routes->get('/{locale}/instituteform', 'Home::instituteForm');
$routes->get('/{locale}/assign', 'Home::assign');


//Common Routes
$routes->get('/{locale}/login', 'Home::login');
$routes->get('/{locale}', 'Home::login');
