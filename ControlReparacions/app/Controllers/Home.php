<?php

namespace App\Controllers;

use SIENSIS\KpaCrud\Libraries\KpaCrud;

class Home extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        return view('login');
    }

    public function ticket()
    {
        //CODIGO KPACRUD
        /*
        //Crear el objeto kpaCrud
        $crud = new KpaCrud();

        //La tabla que mostrara el kpaCrud sera solo de vista, no tendra funciones(add, modify, delete...)
        $crud->setConfig('onlyView');

        //Le decimos a que tabla hace referencia
        $crud->setTable('Tiquet');

        //Decimos que columnas nos interesa mostrar
        $crud->setColumns(['id_tiquet', 'codi_dispositiu', 'id_tipus_dispositiu', 'codi_centre_emissor', 'data_alta', 'data_ultima_modificacio', 'id_estat']);

        $data['table_tickets'] = $crud;
        */
        // return view('ticket', /*$data*/);
        return view('ticket');
    }

    public function assign()
    {
        return view('assign');
    }

    public function student()
    {
        //CODIGO KPACRUD
        /*
        //Crear el objeto kpaCrud
        $crud = new KpaCrud();

        //La tabla que mostrara el kpaCrud sera solo de vista, no tendra funciones(add, modify, delete...)
        $crud->setConfig('onlyview');

        //Le decimos a que tabla hace referencia
        $crud->setTable('Alumne');

        //Decimos que columnas nos interesa mostrar
        $crud->setColumns(['correu_alumne', 'codi_centre']);

        $data['table_alumnes'] = $crud;
        */
        return view('student', /* $data*/);
    }

    public function intervention()
    {
        return view('intervention');
    }

    public function formstudents()
    {
        return view('formstudents');
    }

    
    public function ticketinfo() 
    {
        return view('ticketinfo');
    }
    
    public function instituteform() 
    {
        return view('instituteform');
    }

    public function ticketform() 
    {
        return view('ticketform');
    }

}
