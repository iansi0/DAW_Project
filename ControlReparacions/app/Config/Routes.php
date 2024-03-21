<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('{locale}/tickets', 'Home::tickets');
$routes->get('{locale}/assignar', 'Home::assignar');
$routes->get('alumnos', 'Home::alumnos');
$routes->get('intervencion','Home::intervencion');
$routes->get('ticketinfo','Home::ticketinfo');
$routes->get('formestudiantes','Home::formestudiantes');
$routes->get('institutoform','Home::institutoform');
$routes->get('ticketform','Home::ticketform');
$routes->get('formañadirticketinfo', 'Home::formañadirticketinfo');
$routes->get('/{locale}', 'Home::index');