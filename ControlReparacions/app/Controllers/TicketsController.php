<?php

namespace App\Controllers;

use App\Models\TiquetModel;
use App\Controllers\BaseController;
use App\Models\IntervencioModel;
use Faker\Factory;

class TicketsController extends BaseController
{
    public function tickets()
    {
        //Crear una tabla con todos los tickets

        $searchData = $this->request->getGet();

        if (isset($searchData) && isset($searchData['q'])) {
            $search = $searchData["q"];
        } else {
            $search = "";
        }

        // Get News Data


        $model = new TiquetModel();

        if ($search == '') {
            $paginateData = $model->getAllPaged(8);
        } else {
            $paginateData = $model->getByTitleOrText($search)->paginate(8);
        }

        $count = 0;


        /** TABLE GENERATOR **/
        $table = new \CodeIgniter\View\Table();
        $table->setHeading(lang('titles.id'), lang('titles.device'), lang('titles.description'), lang('titles.sender'), lang('titles.receiver'), lang('titles.date'), lang('titles.status'), 'Actions');

        $template = [
            'table_open'  => "<table class='w-full rounded-t-2xl overflow-hidden '>",

            'thead_open'  => "<thead class='bg-primario text-secundario '>",

            'heading_cell_start' => "<th class='py-3 text-base'>",

            'tbody_open'  => "<tbody class=''>",

            'row_start' => "<tr class=''>",
            'row_alt_start' => "<tr class='bg-[#f7f7f9]'>",
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

            $buttonDelete = base_url("deleteticket/" . $ticket['id']);
            $buttonUpdate = base_url("tu/controlador/accion/" . $ticket['id']);
            $buttonView = base_url("ticketinfo/" . $ticket['id']);
            $table->addRow(
                // ["data" => $ticket['id'],"class"=>'p-5'],
                explode("-",$ticket['id'])[4],
                $ticket['tipus'],
                $ticket['descripcio'],
                $ticket['emissor'],
                ($ticket['receptor'] != null) ? $ticket['receptor'] : lang('titles.ticket'),
                $ticket['created'],
                ["data" => $ticket['estat'], "class" => "py-3 px-1 m-1 estat_" . $ticket['id_estat']],

                ["data" => 
                    "<a href='$buttonView' class='btn btn-primary'><i class='fa-solid fa-eye'></i></a>
                     <a href='$buttonUpdate' class='btn btn-primary'><i class='fa-solid fa-pencil'></i></a>
                     <a href='$buttonDelete' class='btn btn-primary'><i class='fa-solid fa-trash'></i></a>", 

                "class" => " px-10 flex h-12 justify-between  items-center"],


             



            );


            $count++;
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
        $table->setHeading(lang('forms.date'), lang('titles.students'), lang('titles.material_2'), lang('forms.description'));

        $template = [
            'table_open'         => "<table class='w-full'>",
            'thead_open'  => "<thead class='bg-primario text-white'>",
            'heading_cell_start' => "<th class='p-5 text-lg'>",
            'cell_start' => "<td>",

        ];
        $table->setTemplate($template);

        $data = [
            'ticket' => $modelTickets->viewTicket($id),
            'interventions' => $modelInterventions->getInterventions($id),
            'pager' => $modelInterventions->pager,
            'table' => $table,
        ];

        foreach ($data['interventions'] as $intervencio) {
            $buttonView = base_url("ticketinfo/" . $intervencio['id']); // Reemplazar con tu ruta real

            $table->addRow(
                $intervencio['created_at'],
                $intervencio['correu_alumne'],
                $intervencio['id_tipus'],

                ['data' => $intervencio['descripcio'], 'class' => $intervencio['id_tipus'] == 2 ? 'bg-red-500 text-segundario' : 'bg-segundario']
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
