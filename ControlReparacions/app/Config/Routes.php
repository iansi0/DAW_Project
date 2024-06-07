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
$routes->POST('login/asigninstitute', 'Home::assign_institute');
$routes->POST('addprof', 'Home::add_prof_or_code');

$routes->group('', ['filter' => 'isLogged'], function ($routes) {

    // TICKETS
    $routes->group('tickets', function ($routes) {
        $routes->GET('', 'TicketsController::tickets');
        $routes->POST('', 'TicketsController::tickets');

        $routes->GET('add', 'TicketsController::ticketForm', ['filter' => 'addTicket']);
        $routes->POST('add', 'TicketsController::addTicket', ['filter' => 'addTicket']);

       

        $routes->GET('delete/(:segment)', 'TicketsController::deleteTicket/$1', ['filter' => 'deleteTicket']);
        $routes->GET('modify/(:segment)', 'TicketsController::modifyTicket/$1', ['filter' => 'modifyTicket']);
        $routes->POST('modify/(:segment)', 'TicketsController::modifyTicket_post/$1', ['filter' => 'modifyTicket']);

        // EXPORTS
        $routes->group('export', ['filter' => 'exportTicket'], function ($routes) {
            //CSV
            $routes->GET('csv', 'TicketsController::exportCSV');
            // XLS
            $routes->GET('xls', 'TicketsController::exportXLS');
        });

        // IMPORTS
        $routes->group('import', ['filter' => 'exportTicket'], function ($routes) {
            //CSV
            $routes->POST('csv', 'TicketsController::importCSV');
            // XLS
            $routes->POST('xls', 'TicketsController::importXLS');
        });

        //Downloads
        $routes->GET('dowloadCSV', 'TicketsController::downloadCSV');

        $routes->GET('dowloadXLS', 'TicketsController::downloadXLS');

        //Ruta para acceder a ticketInfo
        $routes->GET('(:segment)', 'TicketsController::ticketInfo/$1');
    });

    // INTERVENTIONS
    $routes->group('intervention', function ($routes) {
        $routes->GET('', 'InterventionController::intervention');
        $routes->POST('form/add', 'InterventionController::addIntervention');
        $routes->GET('form/(:segment)', 'InterventionController::interventionForm/$1');
    });

    // STUDENTS
    $routes->group('students', function ($routes) {
        $routes->GET('', 'StudentsController::students');
        $routes->GET('add', 'StudentsController::studentForm');
        $routes->POST('add', 'StudentsController::addStudent');

        $routes->GET('delete/(:segment)', 'StudentsController::deleteStudent/$1');
        $routes->GET('modify/(:segment)', 'StudentsController::modifyStudent/$1');
        $routes->POST('modify/(:segment)', 'StudentsController::modifyStudent_post/$1');


        // EXPORTS
        $routes->group('export', ['filter' => 'exportTicket'], function ($routes) {
            //CSV
            $routes->GET('csv', 'StudentsController::exportCSV');
            // XLS
            $routes->GET('xls', 'StudentsController::exportXLS');
        });

        // IMPORTS
        $routes->group('import', ['filter' => 'exportTicket'], function ($routes) {
            //CSV
            $routes->POST('csv', 'StudentsController::importCSV');
            // XLS
            $routes->POST('xls', 'StudentsController::importXLS');
        });

        //Downloads
        $routes->GET('dowloadCSV', 'StudentsController::downloadCSV');

        $routes->GET('dowloadXLS', 'StudentsController::downloadXLS');
    });

    // INSTITUTES
    $routes->group('institutes', function ($routes) {
        $routes->GET('', 'InstitutesController::institutes');

        $routes->GET('add', 'InstitutesController::InstituteForm');
        $routes->POST('add', 'InstitutesController::addInstitutes');


        $routes->GET('modify/(:segment)', 'InstitutesController::modifyInstitute/$1');
        $routes->POST('modify/(:segment)', 'InstitutesController::modifyInstitute_post/$1');

        // EXPORTS
        $routes->group('export', ['filter' => 'exportTicket'], function ($routes) {
            //CSV
            $routes->GET('csv', 'InstitutesController::exportCSV');
            // XLS
            $routes->GET('xls', 'InstitutesController::exportXLS');
        });

        // IMPORTS
        $routes->group('import', ['filter' => 'exportTicket'], function ($routes) {
            //CSV
            $routes->POST('csv', 'InstitutesController::importCSV');
            // XLS
            $routes->POST('xls', 'InstitutesController::importXLS');
        });

        //Downloads
        $routes->GET('dowloadCSV', 'InstitutesController::downloadCSV');
        $routes->GET('dowloadXLS', 'InstitutesController::downloadXLS');

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


        // EXPORTS
        $routes->group('export', ['filter' => 'exportTicket'], function ($routes) {
            //CSV
            $routes->GET('csv', 'InventaryController::exportCSV');
            // XLS
            $routes->GET('xls', 'InventaryController::exportXLS');
        });

        // IMPORTS
        $routes->group('import', ['filter' => 'exportTicket'], function ($routes) {
            //CSV
            $routes->POST('csv', 'InventaryController::importCSV');
            // XLS
            $routes->POST('xls', 'InventaryController::importXLS');
        });

        //Downloads
        $routes->GET('dowloadCSV', 'InventaryController::downloadCSV');

        $routes->GET('dowloadXLS', 'InventaryController::downloadXLS');
    });

    // CONFIG
    $routes->group('config', function ($routes) {
        $routes->GET('', 'UserController::config');
        $routes->POST('passwd', 'UserController::change_passwd');
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

    $routes->GET('(:segment)', 'Home::empty');
});
