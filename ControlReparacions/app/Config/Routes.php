<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/{locale}/ticket', 'Home::ticket');



$routes->get('{locale}/tickets', 'Home::tickets');
$routes->get('/{locale}', 'Home::index');
$routes->get('/{locale}/ticketinfo', 'Home::ticketinfo');
$routes->get('/{locale}/intervention', 'Home::intervention');
$routes->get('/{locale}/formstudents', 'Home::formstudents');
$routes->get('/{locale}/instituteform', 'Home::instituteform');
$routes->get('/{locale}/login', 'Home::login');

$routes->get('/{locale}/assign', 'Home::assign');
$routes->get('/{locale}/student', 'Home::student');
$routes->get('/{locale}', 'Home::index');
$routes->get('/', 'Home::index');