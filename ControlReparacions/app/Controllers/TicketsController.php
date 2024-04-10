<?php

namespace App\Controllers;

use App\Models\TiquetModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Faker\Factory;

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

    public function addTicket()
    {

        $model = new TiquetModel();

        $fake = Factory::create("es_ES");
        $arrCentres = ['25002799', '17010700', '17010499', '17008249', '8000013', '8001509', '8002198', '8015399', '8017104', '8019401'];


        $id_tiquet =  $fake->uuid();
        $codi_equip = $fake->uuid();
        $descripcio_avaria =  $fake->text(25);
        $nom_persona_contacte_centre = $fake->name() . " " . $fake->lastName();
        $correu_persona_contacte_centre =  $fake->email();
        $id_tipus_dispositiu = rand(0, 9);
        $id_estat = rand(0, 13);
        $codi_centre_emissor = $arrCentres[rand((count($arrCentres) / 2) - 1, count($arrCentres) - 1)];


        $model->addTiquet(
            $id_tiquet,
            $codi_equip,
            $descripcio_avaria,
            $nom_persona_contacte_centre,
            $correu_persona_contacte_centre,
            $id_tipus_dispositiu,
            $id_estat,
            $codi_centre_emissor
        );

        return redirect()->to(base_url('/tickets'));

    }

    public function exportCSV($search = '')
    {
        $searchData = $this->request->getGet();



        // Get News Data

        $model = new TiquetModel();

        if ($search == '') {
            $paginateData = $model->findAll();
        } else {
            $paginateData = $model->orLike('codi_dispositiu', $search, 'both', true)->orLike('descripcio_avaria', $search, 'both', true)->findAll($search);
        }

        $csv_string = "";

        foreach ($paginateData as $ticket) {
            $csv_string .= implode(",", $ticket) . "\n";
        }
        // dd($csv_string);

        header('Content-Disposition: attachment; filename="archivo.csv"');

      
        echo $csv_string;
    }

}