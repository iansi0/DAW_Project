<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Tcikets Routes
$routes->get('/tickets', 'Home::tickets');
$routes->post('/tickets', 'Home::tickets');
$routes->get('/ticketinfo', 'Home::ticketinfo');
$routes->get('/ticketform', 'Home::ticketForm');

$routes->POST('/addticket', 'Home::addTicket');



//Intervention Routes
$routes->get('/intervention', 'Home::intervention');
$routes->get('/interventionForm', 'Home::interventionForm');


//Students Routes
$routes->get('/students', 'Home::students');
$routes->get('/studentsform', 'Home::studentsForm');


//Institute Routes
$routes->get('/institutes', 'Home::institutes');
$routes->get('/assign', 'Home::assign');
$routes->get('/instituteform', 'Home::instituteForm');


//Common Routes
$routes->get('/login', 'Home::login');
$routes->get('', 'Home::login');
