<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// LOGIN
$routes->GET('logout', 'Home::logout');
$routes->GET('login', 'Home::login');
$routes->POST('login', 'Home::login_post');
$routes->GET('', 'Home::login');
$routes->GET('/', 'Home::login');

$routes->group('', ['filter' => 'isLogged'], function($routes){

    // TICKETS
    $routes->group('tickets', [], function($routes){
        $routes->GET('', 'TicketsController::tickets');
        $routes->POST('', 'TicketsController::tickets');

        $routes->GET('(:segment)', 'TicketsController::ticketInfo/$1');

        $routes->GET('add', 'TicketsController::ticketForm');
        $routes->POST('add', 'TicketsController::addTicket');

        $routes->GET('delete/(:segment)', 'TicketsController::deleteTicket/$1');
        $routes->GET('modify/(:segment)', 'Home::empty');
    });

    // EXPORT
    $routes->group('export', [], function($routes){
        $routes->GET('', 'TicketsController::exportCSV');
        $routes->GET('(:segment)', 'TicketsController::exportCSV/$1');
    });

    // INTERVENTIONS
    $routes->group('intervention', [], function($routes){
        $routes->GET('', 'Home::empty');
        $routes->GET('form', 'Home::empty');
    });

    // STUDENTS
    $routes->group('students', [], function($routes){
        $routes->GET('', 'Home::empty');
        $routes->GET('form', 'Home::empty');
    });

    // INSTITUTES
    $routes->group('institutes', [], function($routes){
        $routes->GET('', 'Home::empty');
        $routes->GET('form', 'Home::empty');
    });

    // ASSIGN
    $routes->group('assign', [], function($routes){
        $routes->GET('', 'Home::empty');
    });

    // INVENTARY
    $routes->group('inventary', [], function($routes){
        $routes->GET('', 'Home::empty');
    });

    // CONFIG
    $routes->group('config', [], function($routes){
        $routes->GET('', 'UserController::config');
        $routes->POST('', 'UserController::config_post');
    });

    // PROFILE
    $routes->group('profile', [], function($routes){
        $routes->GET('', 'Home::empty');
    });

});
