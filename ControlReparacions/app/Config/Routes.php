<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('login', 'Home::login');

$routes->get('tickets', 'Home::tickets');
$routes->get('assignar', 'Home::assignar');