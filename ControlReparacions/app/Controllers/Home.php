<?php

namespace App\Controllers;

use App\Models\TiquetModel;
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
       
        /*************** TABLE GENERATOR ********************/
        $table = new \CodeIgniter\View\Table();
        $table->setHeading('ID', 'id_tipus_dispositiu','codi_centre_emissor', 'codi_dispositiu', 'data_alta', 'data_ultima_modificacio', 'id_estat' );

        $template = [
            'table_open'         => "<table class='w-full'>",
            'thead_open'  => "<thead class='bg-terciario-1 text-primario'>",
            'heading_cell_start' => "<th class='p-5'>",


            'cell_start' => "<td class='p-5'>",

        ];        
        $table->setTemplate($template);
        /*************** TABLE GENERATOR ********************/

        $data = [
            'page_title' => 'CI4 Pager & search filter',
            'tickets' => $paginateData,
            'pager' => $model->pager,
            'search' => $search,
            'table' => $table,
        ];


        return view('ticket', $data);
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
