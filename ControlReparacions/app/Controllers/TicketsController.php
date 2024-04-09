<?php

namespace App\Controllers;

use App\Models\TiquetModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TicketsController extends BaseController
{
    public function tickets()
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

    public function ticketInfo()
    {
        return view('tickets/ticketInfo');
    }

    public function ticketForm()
    {
        return view('tickets/ticketForm.php');
    }

}
