<?php

namespace App\Controllers;

use SIENSIS\KpaCrud\Libraries\KpaCrud;

class Home extends BaseController
{
    //Tikcets functions
    public function tickets(): string
    {
        //CODIGO KPACRUD

        //Crear el objeto kpaCrud
        $crud = new KpaCrud();

        //La tabla que mostrara el kpaCrud sera solo de vista, no tendra funciones(add, modify, delete...)
        $crud->setConfig('default');

        //Le decimos a que tabla hace referencia
        $crud->setTable('tiquet');

        $crud->setPrimaryKey('id');

        //Decimos que columnas nos interesa mostrar
        $crud->setColumns([
            'id',
            'codi_dispositiu', 'id_tipus_dispositiu', 'codi_centre_emissor', 'data_alta', 'data_ultima_modificacio', 'id_estat'
        ]);

        $data['table_tickets'] = $crud->render();

        return view('tickets/tickets', $data);
    }

    public function ticketInfo(): string
    {
        return view('tickets/ticketInfo');
    }

    public function ticketForm(): string
    {
        return view('tickets/ticketForm.php');
    }


    //Intervention Functions
    public function intervention(): string
    {
        return view('intervention/intervention');
    }

    public function interventionForm(): string
    {
        return view('intervention/interventionForm');
    }


    //Students Functions
    public function students(): string
    {
        //CODIGO KPACRUD
        /*
        //Crear el objeto kpaCrud
        $crud = new KpaCrud();
 
        //La tabla que mostrara el kpaCrud sera solo de vista, no tendra funciones(add, modify, delete...)
        $crud->setConfig('default');
 
        //Le decimos a que tabla hace referencia
        $crud->setTable('Alumne');
 
        //Decimos que columnas nos interesa mostrar
        $crud->setColumns(['correu_alumne', 'codi_centre']);
 
        $data['table_alumnes'] = $crud;
        */
        return view('students/students', /* $data*/);
    }

    public function studentsForm(): string
    {
        return view('students/studentsForm');
    }


    //Institute Functions
    public function institutes(): string
    {
        return view('institutes/institute');
    }

    public function instituteForm(): string
    {
        return view('institutes/instituteForm');
    }

    public function assign(): string
    {
        return view('institutes/assign');
    }


    //Common Functions
    public function login(): string
    {
        return view('login');
    }
}
