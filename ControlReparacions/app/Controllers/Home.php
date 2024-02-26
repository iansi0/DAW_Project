<?php

namespace App\Controllers;

use SIENSIS\KpaCrud\Libraries\KpaCrud;

class Home extends BaseController
{
    public function index(): string
    {
        return view('login.php');
    }

    public function tickets(): string
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
        return view('ticket.php', /*$data*/);
    }

    public function assignar(): string
    {
        return view('assignar.php');
    }

    public function alumnes(): string
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
        return view('alumnes.php', /* $data*/);
    }

    public function intervencion() : string
    {
        return view('intervencion.php');
    }
    
    public function ticketinfo() : string
    {
        return view('ticketinfo.php');
    }
    public function formestudiantes() : string
    {
        return view('formestudiantes.php');
    }

    public function alumnos() : string
    {
        return view('alumnos.php');
    }

}
