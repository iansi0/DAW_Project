<?php

namespace App\Controllers;

use App\Models\TiquetModel;
use App\Models\TipusDispositiuModel;
use App\Controllers\BaseController;
use App\Models\CentreModel;
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

        // HEADER
        $table->setHeading(
            lang('titles.id'),
            lang('titles.device'),
            lang('titles.description'),
            lang('titles.sender'),
            lang('titles.receiver'),
            lang('titles.date'),
            lang('titles.hour'),
            lang('titles.status'),
            lang('titles.actions')
        );

        // TEMPLATE
        $template = [
            'table_open'  => "<table class='w-full rounded-t-2xl overflow-hidden '>",

            'thead_open'  => "<thead class='bg-primario text-secundario '>",

            'heading_cell_start' => "<th class='py-3 text-base'>",

            'tbody_open'  => "<tbody class=''>",

            'row_start' => "<tr class='border-b-[0.01px] '>",
            'row_alt_start' => "<tr class='border-b-[0.01px]  bg-terciario-2'>",
        ];
        $table->setTemplate($template);

        $data = [
            'page_title' => 'CI4 Pager & search filter',
            'tickets' => $paginateData,
            'pager' => $model->pager,
            'search' => $search,
            'table' => $table,
        ];

        // ROWS
        foreach ($data['tickets'] as $ticket) {

            $buttonDelete = base_url("tickets/delete/" . $ticket['id']);
            $buttonUpdate = base_url("tickets/modify/" . $ticket['id']);
            $buttonView = base_url("tickets/" . $ticket['id']);
            $table->addRow(
                // ["data" => $ticket['id'],"class"=>'p-5'],
                explode("-", $ticket['id'])[4],
                $ticket['tipus'],
                $ticket['descripcio'],
                $ticket['emissor'],
                ($ticket['receptor'] != null) ? $ticket['receptor'] : lang('titles.ticket'),
                date("d/m/Y", strtotime($ticket['created'])),
                date("H:i", strtotime($ticket['created'])),

                ["data" => "<a class='w-full p-3 estat_" . $ticket['id_estat']."'>".$ticket['estat']."</a>" , "class" => " p-1 "],

                [
                    "data" =>
                    "<a href='$buttonView' style='view-transition-name: info" . $ticket['id'] . ";' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-primario hover:text-secundario rounded-xl hover:rounded-xl transition-all ease-out duration-250 hover:transition hover:ease-in hover:duration-250 fa-eye'></i></a>
                     <a href='$buttonUpdate' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-primario hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-pencil'></i></a>
                     <a href='$buttonDelete' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-primario hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-trash'></i></a>",

                    "class" => " p-5 flex h-16 justify-between items-center"
                ],

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
            $buttonView = base_url("tickets/" . $intervencio['id']); // Reemplazar con tu ruta real

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
        $type=new TipusDispositiuModel();
        $center=new CentreModel();
        $data=[
            "types" => $type->getAllTypes(),
            "centers" => $center->getAllCenter(),
            "repairs" => $center->getAllRepairCenters(),
        ];
        return view('tickets/ticketForm.php', $data);
    }

    public function addTicket()
    {

        $model = new TiquetModel();

        $fake = Factory::create("es_ES");
        // $arrCentres = ['25002799', '17010700', '17010499', '17008249', '8000013', '8001509', '8002198', '8015399', '8017104', '8019401'];


        $id_tiquet =  $fake->uuid();
        $codi_equip = $fake->uuid();
        $descripcio_avaria =  $this->request->getPost("description");
        $nom_persona_contacte_centre = $this->request->getPost("nameContact");
        $correu_persona_contacte_centre =  $this->request->getPost("emailContact");
        $id_tipus_dispositiu = $this->request->getPost("id_type");
        if ($this->request->getPost("repair")) {
            $id_estat = 2;
            $codi_centre_reparador = $this->request->getPost("repair");
        }else{
            $id_estat = 1;
            $codi_centre_reparador = 0;
        }
        $codi_centre_emissor = $this->request->getPost("sender");


        $model->addTiquet(
            $id_tiquet,
            $codi_equip,
            $descripcio_avaria,
            $nom_persona_contacte_centre,
            $correu_persona_contacte_centre,
            $id_tipus_dispositiu,
            $id_estat,
            $codi_centre_emissor,
            $codi_centre_reparador
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
        if ($search!='') {
            header('Content-Disposition: attachment; filename="'.date("d-m-Y").'_filter-'.$search.'.csv"');
        }else{
            header('Content-Disposition: attachment; filename="'.date("d-m-Y").'.csv"');
        }


        echo $csv_string;
    }
    public function exportXLS($search = '')
    {
        $searchData = $this->request->getGet();



        // Get News Data

        $model = new TiquetModel();

        if ($search == '') {
            $paginateData = $model->findAll();
        } else {
            $paginateData = $model->orLike('codi_dispositiu', $search, 'both', true)->orLike('descripcio_avaria', $search, 'both', true)->findAll($search);
        }

        $xls_string = "";

        foreach ($paginateData as $ticket) {
            $xls_string .= implode(",", $ticket) . "\n";
        }
        if ($search!='') {
            header('Content-Disposition: attachment; filename="'.date("d-m-Y").'_filter-'.$search.'.xls"');
        }else{
            header('Content-Disposition: attachment; filename="'.date("d-m-Y").'.xls"');
        }

        echo $xls_string;
    }
}
