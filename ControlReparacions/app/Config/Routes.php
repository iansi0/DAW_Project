<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// LOGIN
$routes->GET('login', 'Home::login');
$routes->GET('', 'Home::login');
$routes->GET('/', 'Home::login');
$routes->POST('login', 'Home::login_post');

$routes->group('', ['filter' => 'isLogged'], function ($routes) {

    // TICKETS
    $routes->group('tickets', function ($routes) {
        $routes->GET('', 'TicketsController::tickets');
        $routes->POST('', 'TicketsController::tickets');

        $routes->GET('add', 'TicketsController::ticketForm', ['filter' => 'addTicket']);
        $routes->POST('add', 'TicketsController::addTicket', ['filter' => 'addTicket']);
        
        $routes->GET('(:segment)', 'TicketsController::ticketInfo/$1');

        $routes->GET('delete/(:segment)', 'TicketsController::deleteTicket/$1', ['filter' => 'deleteTicket']);
        $routes->GET('modify/(:segment)', 'TicketsController::modifyTicket/$1', ['filter' => 'modifyTicket']);
        $routes->POST('modify/(:segment)', 'TicketsController::modifyTicket_post/$1', ['filter' => 'modifyTicket']);
    });

    // EXPORT
    $routes->group('export', ['filter' => 'exportTicket'], function($routes){
        //CSV
        $routes->GET('csv', 'TicketsController::exportCSV');
        $routes->GET('csv/(:segment)', 'TicketsController::exportCSV/$1');
        // XLS
        $routes->GET('xls', 'TicketsController::exportXLS');
        $routes->GET('xls/(:segment)', 'TicketsController::exportXLS/$1');
        //PDF
        
    });
    $routes->GET('pdf/(:segment)', 'PdfController::index/$1');

    // INTERVENTIONS
    $routes->group('intervention', function ($routes) {
        $routes->GET('', 'InterventionController::intervention');
        $routes->GET('form', 'InterventionController::interventionForm');
        $routes->POST('add', 'InterventionController::addIntervention');
    });

    // STUDENTS
    $routes->group('students', function ($routes) {
        $routes->GET('', 'StudentsController::students');
        $routes->GET('form', 'Home::empty');
    });

    // INSTITUTES
    $routes->group('institutes', function ($routes) {
        $routes->GET('', 'InstitutesController::institutes');

        $routes->GET('add', 'InstitutesController::InstituteForm');
        $routes->POST('add', 'InstitutesController::addInstitutes');


        $routes->GET('modify/(:segment)', 'InstitutesController::modifyInstitute/$1');
        $routes->POST('modify/(:segment)', 'InstitutesController::modifyInstitute_post/$1');

        $routes->GET('(:segment)', 'InstitutesController::instituteInfo/$1');
        $routes->GET('(:segment)/filterSender', 'InstitutesController::instituteInfo/$1/sender');
        $routes->GET('(:segment)/filterReceiver', 'InstitutesController::instituteInfo/$1/receiver');

    });

    // ASSIGN
    $routes->group('assign', function ($routes) {
        $routes->GET('', 'Home::empty');
    });

    // INVENTARY
    $routes->group('inventary', function ($routes) {
        $routes->GET('', 'InventaryController::index');
        $routes->GET('add', 'InventaryController::inventaryForm');
        $routes->POST('add', 'InventaryController::addInventary');

        $routes->GET('delete/(:segment)', 'InventaryController::deleteInventary/$1');
        $routes->GET('modify/(:segment)', 'InventaryController::modifyInventary/$1');
        $routes->POST('modify/(:segment)', 'InventaryController::modifyInventary_post/$1');
    });

    // CONFIG
    $routes->group('config', function ($routes) {
        $routes->GET('', 'UserController::config');
        $routes->POST('', 'UserController::config_post');
    });


    // WORKING
    $routes->GET('work', 'Home::empty');

    // ERRORS
    $routes->group('error', function ($routes) {
        $routes->GET('404', 'Home::error404');
    });
    
    //STATISTICS
    $routes->GET('statistics', 'StatisticsController::index');
    
    $routes->POST('savestate/(:segment)', 'TicketsController::saveState/$1');
    // LANGUAGE CHANGE
    $routes->GET('change_lang/(:segment)', 'Home::change_lang/$1');

    // LOGOUT
    $routes->GET('logout', 'Home::logout');
});
