<?php

namespace App\Controllers;

use App\Models\TiquetModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;

class Home extends BaseController
{
    //Tikcets functions
    public function tickets(): string
    {
        //Crear una tabla con todos los tickets

        $searchData = $this->request->getGet();

        if (isset($searchData) && isset($searchData['q'])) {
            $search = $searchData["q"];
        } else
            $search = "";

        // Get News Data

        $model= new TiquetModel();

        if ($search==''){
            $paginateData=$model->getAllPaged(8);
        } else {
            $paginateData=$model->getByTitleOrText($search)->paginate(8);
        }

        /** TABLE GENERATOR **/
        $table = new \CodeIgniter\View\Table();
        $table->setHeading('ID', 'id_tipus_dispositiu','codi_centre_emissor', 'codi_dispositiu', 'created_at', 'updated_at', 'id_estat' );

        $template = [
            'table_open'         => "<table class='w-full'>",
            'thead_open'  => "<thead class='bg-terciario-1 text-primario'>",
            'heading_cell_start' => "<th class='p-5'>",


            'cell_start' => "<td class='p-5'>",

        ];
        $table->setTemplate($template);
        /** TABLE GENERATOR **/

        $data = [
            'page_title' => 'CI4 Pager & search filter',
            'tickets' => $paginateData,
            'pager' => $model->pager,
            'search' => $search,
            'table' => $table,
        ];


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
