<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('', ['filter' => 'isLogged'], function($routes){

    // LOGOUT
    $routes->GET('logout', 'Home::logout');
    
    // LOGIN
    $routes->GET('login', 'Home::login');
        $routes->addRedirect('', 'login');
        $routes->addRedirect('/', 'login');
    $routes->POST('login', 'Home::login_post');

    // TICKETS
    $routes->group('tickets', function($routes){
        $routes->GET('', 'TicketsController::tickets');
        $routes->POST('', 'TicketsController::tickets');

        $routes->GET('add', 'TicketsController::ticketForm');
        $routes->POST('add', 'TicketsController::addTicket');
        
        $routes->GET('(:segment)', 'TicketsController::ticketInfo/$1');

        $routes->GET('delete/(:segment)', 'TicketsController::deleteTicket/$1');
        $routes->GET('modify/(:segment)', 'Home::empty');
    });

    // EXPORT
    $routes->group('export', function($routes){
        //CSV
        $routes->GET('csv', 'TicketsController::exportCSV');
        $routes->GET('csv/(:segment)', 'TicketsController::exportCSV/$1');
        // XLS
        $routes->GET('xls', 'TicketsController::exportXLS');
        $routes->GET('xls/(:segment)', 'TicketsController::exportXLS/$1');
    });

    // INTERVENTIONS
    $routes->group('intervention', function($routes){
        $routes->GET('', 'Home::empty');
        $routes->GET('form', 'Home::empty');
    });

    // STUDENTS
    $routes->group('students', function($routes){
        $routes->GET('', 'Home::empty');
        $routes->GET('form', 'Home::empty');
    });

    // INSTITUTES
    $routes->group('institutes', function($routes){
        $routes->GET('', 'Home::empty');
        $routes->GET('form', 'Home::empty');
    });

    // ASSIGN
    $routes->group('assign', function($routes){
        $routes->GET('', 'Home::empty');
    });

    // INVENTARY
    $routes->group('inventary', function($routes){
        $routes->GET('', 'Home::empty');
    });

    // CONFIG
    $routes->group('config', function($routes){
        $routes->GET('', 'UserController::config');
        $routes->POST('', 'UserController::config_post');
    });

    // PROFILE
    $routes->group('profile', function($routes){
        $routes->GET('', 'Home::empty');
    });

    // WORKING
    $routes->GET('work', 'Home::empty');

    // ERRORS
    $routes->group('error', function($routes){
        $routes->GET('404', 'Home::error404');
    });


    // change de lang 
    $routes->get('change_lang/(:segment)', 'Home::change_lang/$1');

});
