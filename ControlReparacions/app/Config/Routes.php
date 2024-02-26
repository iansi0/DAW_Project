<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/ticketinfo', 'Home::ticketinfo');
$routes->get('/intervencion', 'Home::intervencion');
$routes->get('/formestudiantes', 'Home::formestudiantes');
$routes->get('/', 'Home::index');
$routes->get('{locale}/tickets', 'Home::tickets');
$routes->get('{locale}/assignar', 'Home::assignar');