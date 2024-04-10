<?php

namespace App\Controllers;

use App\Models\TiquetModel;
use App\Controllers\BaseController;
use App\Models\IntervencioModel;
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

        $model = new TiquetModel();

        if ($search == '') {
            $paginateData = $model->getAllPaged(8);
        } else {
            $paginateData = $model->getByTitleOrText($search)->paginate(8);
        }

        /** TABLE GENERATOR **/
        $table = new \CodeIgniter\View\Table();
        $table->setHeading('ID', 'tipus dispositiu', 'centre emissor', 'codi dispositiu', 'fecha creacio', 'ultima modificacio', 'estat', '', '', '');

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

        foreach ($data['tickets'] as $ticket) {
            $buttonDelete = base_url("deleteticket/" . $ticket['id']); // Reemplazar con tu ruta real
            $buttonUpdate = base_url("tu/controlador/accion/" . $ticket['id']); // Reemplazar con tu ruta real
            $buttonView = base_url("ticketinfo/" . $ticket['id']); // Reemplazar con tu ruta real
            $table->addRow(
                $ticket['id'],
                $ticket['id_tipus_dispositiu'],
                $ticket['codi_centre_emissor'],
                $ticket['codi_dispositiu'],
                $ticket['created_at'],
                $ticket['updated_at'],
                $ticket['id_estat'],
                "<a href='$buttonView' class='btn btn-primary'>View</a>",
                "<a href='$buttonDelete' class='btn btn-primary bg-primario'>Delete</a>",
                "<a href='$buttonUpdate' class='btn btn-primary'>Modify</a>"
            );
        }

        return view('tickets/tickets', $data);
    }

    public function ticketInfo($id = null)
    {

        if ($id == null) {
            return redirect()->to(base_url('/tickets'));
        }

        $modelTickets = new TiquetModel();
        $modelInterventions = new IntervencioModel();

        /** TABLE GENERATOR **/
        $table = new \CodeIgniter\View\Table();
        $table->setHeading('fecha', 'alumne', 'material', 'descripcio');

        $template = [
            'table_open'         => "<table class='w-full'>",
            'thead_open'  => "<thead class='bg-primario text-segundario'>",
            'heading_cell_start' => "<th class='p-5'>",
            'cell_start' => "<td class='p-5'>",

        ];
        $table->setTemplate($template);

        $data = [
            'ticket' => $modelTickets->viewTicket($id),
            'interventions' => $modelInterventions->getInterventions($id),
            'pager' => $modelInterventions->pager,
            // 'search' => $search,
            'table' => $table,
        ];

        foreach ($data['interventions'] as $intervencio) {
            $buttonView = base_url("ticketinfo/" . $intervencio['id']); // Reemplazar con tu ruta real

            $table->addRow(
                $intervencio['data'],
                $intervencio['correu_alumne'],
                $intervencio['id_tipus'],
               
                ['data' => $intervencio['descripcio'], 'class' => $intervencio['id_tipus'] == 2 ? 'bg-red-500' : 'bg-segundario']
                // "<span class=' " . ($intervencio['id_tipus'] == 2 ? 'bg-primario' : 'bg-segundario') . "'> " . $intervencio['descripcio'] . "</span>"
            );
        }
        return view('tickets/ticketInfo', $data);
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

    public function deleteTicket($id)
    {

        $model = new TiquetModel();

        $model->deleteTicket($id);

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
