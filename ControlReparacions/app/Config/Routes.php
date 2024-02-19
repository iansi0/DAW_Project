<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('tickets', 'Home::tickets');
$routes->get('assignar', 'Home::assignar');
$routes->get('alumnos', 'Home::alumnos');
$routes->get('intervencion','Home::intervencion');