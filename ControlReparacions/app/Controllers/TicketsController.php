<?php

namespace App\Controllers;

use App\Models\TiquetModel;
use App\Models\TipusDispositiuModel;
use App\Controllers\BaseController;
use App\Database\Migrations\ESTATS;
use App\Models\CentreModel;
use App\Models\EstatModel;
use App\Models\IntervencioModel;
use Faker\Factory;
use Google\Service\Walletobjects\Pagination;

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
            $paginateData = $model->getAllPaged()->paginate(8);
        } else {
            $paginateData = $model->getByTitleOrText($search)->paginate(8);
        }

        $count = 0;


        /** TABLE GENERATOR **/
        $table = new \CodeIgniter\View\Table();

        // HEADER
        $table->setHeading(
            mb_strtoupper(lang('titles.id'), 'utf-8'),
            mb_strtoupper(lang('titles.device'), 'utf-8'),
            mb_strtoupper(lang('titles.description'), 'utf-8'),
            mb_strtoupper(lang('titles.sender'), 'utf-8'),
            mb_strtoupper(lang('titles.receiver'), 'utf-8'),
            mb_strtoupper(lang('titles.date'), 'utf-8'),
            mb_strtoupper(lang('titles.hour'), 'utf-8'),
            mb_strtoupper(lang('titles.status'), 'utf-8'),
            mb_strtoupper(lang('titles.actions'), 'utf-8'),
        );

        // TEMPLATE
        $template = [
            'table_open'  => "<table class='w-full rounded-t-2xl overflow-hidden '>",

            'thead_open'  => "<thead class='bg-primario text-secundario '>",

            'heading_cell_start' => "<th class='py-3 text-base'>",

            'row_start' => "<tr class='border-b-[0.01px] '>",
            'row_alt_start' => "<tr class='border-b-[0.01px]  bg-[#F7F4EF]'>",
        ];
        $table->setTemplate($template);

        $data = [
            'tickets' => $paginateData,
            'pager' => $model->pager,
            'search' => $search,
            'table' => $table,
        ];
        $role = session()->get('user')['role'];
        $institute = session()->get('user')['code'];
        
        // dd(session()->get('user'));
        // ROWS
        foreach ($data['tickets'] as $ticket) {
            
            $buttonDelete = base_url("tickets/delete/" . $ticket['id']);
            $buttonUpdate = base_url("tickets/modify/" . $ticket['id']);
            $buttonView = base_url("tickets/" . $ticket['id']);

            if (($role == "admin" ) || ($role== "sstt") || (($role=="prof") && ($ticket['id_estat']==1)) || (($role=="ins") && ($ticket['id_estat']==1)) ) {
                $table->addRow(
                    // ["data" => $ticket['id'],"class"=>'p-5'],
                    explode("-", $ticket['id'])[4],
                    $ticket['tipus'],
                    ["data" =>  $ticket['descripcio'], "class" => " max-w-10 min-w-auto whitespace-nowrap overflow-hidden text-ellipsis"],
                    ($ticket['emissor'] != lang('titles.toassign')) ? $ticket['emissor'] : lang('titles.toassign').' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',
                    ($ticket['receptor'] != lang('titles.toassign')) ? $ticket['receptor'] : lang('titles.toassign').' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',
    
                    date("d/m/Y", strtotime($ticket['created'])),
                    date("H:i", strtotime($ticket['created'])),
                    
                    ["data" => "<a class='flex p-3 justify-center  whitespace-nowrap w-full estat_" . $ticket['id_estat'] . "'>" . $ticket['estat'] . "</a>", "class" => "p-2 "],
                    
                    [
                        "data" =>
                        "<a href='$buttonView' style='view-transition-name: info" . $ticket['id'] . ";' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-primario hover:text-secundario rounded-xl hover:rounded-xl transition-all ease-out duration-250 hover:transition hover:ease-in hover:duration-250 fa-eye'></i></a>
                         <a href='$buttonUpdate' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-orange-600 hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-pencil'></i></a>
                         <a href='$buttonDelete' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-red-800 hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-trash'></i></a>",
    
                        "class" => " p-5 flex h-16 justify-between items-center"
                    ],
    
                );
            }elseif (("ins"==$role) && ($ticket['id_estat']!=1)) {
                $table->addRow(
                    // ["data" => $ticket['id'],"class"=>'p-5'],
                    explode("-", $ticket['id'])[4],
                    $ticket['tipus'],
                    ["data" =>  $ticket['descripcio'], "class" => " max-w-10 min-w-auto whitespace-nowrap overflow-hidden text-ellipsis"],
                    ($ticket['emissor'] != lang('titles.toassign')) ? $ticket['emissor'] : lang('titles.toassign').' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',
                    ($ticket['receptor'] != lang('titles.toassign')) ? $ticket['receptor'] : lang('titles.toassign').' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',
    
                    date("d/m/Y", strtotime($ticket['created'])),
                    date("H:i", strtotime($ticket['created'])),
                    
                    ["data" => "<a class='flex p-3 justify-center  whitespace-nowrap w-full estat_" . $ticket['id_estat'] . "'>" . $ticket['estat'] . "</a>", "class" => "p-2 "],
                    
                    [
                        "data" =>
                        "<a href='$buttonView' style='view-transition-name: info" . $ticket['id'] . ";' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-primario hover:text-secundario rounded-xl hover:rounded-xl transition-all ease-out duration-250 hover:transition hover:ease-in hover:duration-250 fa-eye'></i></a>
                         <a href='$buttonUpdate' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-orange-600 hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-pencil'></i></a>",
    
                        "class" => " p-5 flex h-16 justify-between items-center"
                    ],
    
                );            
            }else{
                $table->addRow(
                    // ["data" => $ticket['id'],"class"=>'p-5'],
                    explode("-", $ticket['id'])[4],
                    $ticket['tipus'],
                    ["data" =>  $ticket['descripcio'], "class" => " max-w-10 min-w-auto whitespace-nowrap overflow-hidden text-ellipsis"],
                    ($ticket['emissor'] != lang('titles.toassign')) ? $ticket['emissor'] : lang('titles.toassign').' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',
                    ($ticket['receptor'] != lang('titles.toassign')) ? $ticket['receptor'] : lang('titles.toassign').' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',
    
                    date("d/m/Y", strtotime($ticket['created'])),
                    date("H:i", strtotime($ticket['created'])),
                    
                    ["data" => "<a class='flex p-3 justify-center  whitespace-nowrap w-full estat_" . $ticket['id_estat'] . "'>" . $ticket['estat'] . "</a>", "class" => "p-2 "],
                    
                    [
                        "data" =>
                        "<a href='$buttonView' style='view-transition-name: info" . $ticket['id'] . ";' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-primario hover:text-secundario rounded-xl hover:rounded-xl transition-all ease-out duration-250 hover:transition hover:ease-in hover:duration-250 fa-eye'></i></a>",
    
                        "class" => " p-5 flex h-16 justify-between items-center"
                    ],
    
                );   
            }

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
        $estat = new EstatModel();

        /** TABLE GENERATOR **/
        $table = new \CodeIgniter\View\Table();
        $table->setHeading(
            mb_strtoupper(lang('forms.date'), 'utf-8'),
            mb_strtoupper(lang('titles.students'), 'utf-8'),
            mb_strtoupper(lang('titles.material_2'), 'utf-8'),
            mb_strtoupper(lang('forms.description'), 'utf-8')
        );

        $template = [
            'table_open'  => "<table class='w-full'>",

            'thead_open'  => "<thead class='bg-primario text-secundario'>",

            'heading_cell_start' => "<th class='py-3 text-base'>",

            'row_start' => "<tr class='border-b-[0.01px] '>",
            'row_alt_start' => "<tr class='border-b-[0.01px]  bg-terciario-2'>",


        ];
        $table->setTemplate($template);

        $data = [
            'ticket' => $modelTickets->viewTicket($id),
            'interventions' => $modelInterventions->getInterventions($id),
            'pager' => $modelInterventions->pager,
            'table' => $table,
            'estats' => $estat->getAllStates(),
        ];

   

        foreach ($data['interventions'] as $intervencio) {
            $buttonView = base_url("tickets/" . $intervencio['id']); // Reemplazar con tu ruta real

            $table->addRow(
                $intervencio['created_at'],
                $intervencio['correu_alumne'],
                $intervencio['id_tipus'],

                ['data' => $intervencio['descripcio'], 'class' => $intervencio['id_tipus'] == 1 ? 'bg-red-500 text-segundario' : 'bg-segundario']
            );
        }

        session()->setFlashdata('ticket_id', $id);

        return view('tickets/ticketInfo', $data);
    }

    public function ticketForm()
    {
        helper('form');

        $type = new TipusDispositiuModel();
        $center = new CentreModel();
        $data = [
            "types" => $type->getAllTypes(),
            "centers" => $center->getAllCenter(),
            "repairs" => $center->getAllRepairCenters(),
        ];
        return view('tickets/ticketForm', $data);
    }

    public function addTicket()
    {
        helper('form');

        $validationRules =
            [
                'description' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error Descripcio',
                    ],
                ],
                'nameContact' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error nameContact',
                    ],
                ],
                'emailContact' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error emailContact',
                    ],
                ],
                'id_type' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error id_type',
                    ],
                ],


            ];
        $model = new TiquetModel();

        $fake = Factory::create("es_ES");
        // $arrCentres = ['25002799', '17010700', '17010499', '17008249', '8000013', '8001509', '8002198', '8015399', '8017104', '8019401'];


        $id_tiquet =  $fake->uuid();
        $codi_equip = $fake->uuid();
        $descripcio_avaria =  $this->request->getPost("description");
        $nom_persona_contacte_centre = $this->request->getPost("nameContact");
        $correu_persona_contacte_centre =  $this->request->getPost("emailContact");
        $id_tipus_dispositiu = $this->request->getPost("id_type");

        if ($this->validate($validationRules)) {
            if ($this->request->getPost("repair") || $this->request->getPost("sender")) {
                $id_estat = 2;
                if ($this->request->getPost("repair") && $this->request->getPost("sender")) {
                    $codi_centre_reparador = $this->request->getPost("repair");
                    $codi_centre_emissor = $this->request->getPost("sender");
                } else if ($this->request->getPost("repair")) {
                    $codi_centre_reparador = $this->request->getPost("repair");
                    $codi_centre_emissor = 0;
                } else {
                    // TODO: Poner aqui el error porque n hay centro reparador en esta opcion
                    $codi_centre_emissor = $this->request->getPost("sender");
                    $codi_centre_reparador = 0;
                }
            } else {
                $id_estat = 1;
                $codi_centre_emissor = 0;
                $codi_centre_reparador = 0;
            }


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
        } else {
            return redirect()->back()->withInput();
        }
        return redirect()->to(base_url('/tickets'));
    }

    public function modifyTicket($id)
    {
        helper('form');

        $type = new TipusDispositiuModel();
        $center = new CentreModel();
        $ticket = new TiquetModel();
        $state = new EstatModel();
        $data = [
            "types" => $type->getAllTypes(),
            "centers" => $center->getAllCenter(),
            "repairs" => $center->getAllRepairCenters(),
            "states" => $state->getAllStates(),
            "ticket" => $ticket->getTicketById($id),
        ];
        return view('tickets/modifyTicket', $data);
    }

    public function modifyTicket_post($id)
    {

        $model = new TiquetModel();
        helper('form');
        $validationRules =
            [
                'description' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error Descripcio',
                    ],
                ],
                'nameContact' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error nameContact',
                    ],
                ],
                'emailContact' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error emailContact',
                    ],
                ],
                'id_type' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error id_type',
                    ],
                ],


            ];
        if ($this->validate($validationRules)) {

            $data = [
                "id_tiquet" =>  $id,
                "descripcio_avaria" =>  $this->request->getPost("description"),
                "nom_persona_contacte_centre" => $this->request->getPost("nameContact"),
                "correu_persona_contacte_centre" =>  $this->request->getPost("emailContact"),
                "id_tipus_dispositiu" => $this->request->getPost("id_type"),
                "id_estat" => $this->request->getPost("id_state"),
                "codi_centre_emissor" => $this->request->getPost("sender"),
                "codi_centre_reparador" => $this->request->getPost("repair"),

            ];
        } else {
            return redirect()->back()->withInput();
        }

        $model->modifyTicket($id, $data);

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

        // if ($search == '') {
        //     $paginateData = $model->getAllPaged(8);
        // } else {
        //     $paginateData = $model->getByTitleOrText($search)->paginate(8);
        // }

        // Get News Data

        $model = new TiquetModel();

        if ($search == '') {
            $paginateData = $model->getAllPaged()->findAll();
        } else {
            $paginateData = $model->getByTitleOrText($search)->findAll();
        }

        $csv_string = "";

        foreach ($paginateData as $ticket) {
            $csv_string .= implode(",", $ticket) . "\n";
        }
        // dd($csv_string);
        if ($search != '') {
            header('Content-Disposition: attachment; filename="' . date("d-m-Y") . '_filter-' . $search . '.csv"');
        } else {
            header('Content-Disposition: attachment; filename="' . date("d-m-Y") . '.csv"');
        }


        echo $csv_string;
    }
    public function exportXLS($search = '')
    {
        $searchData = $this->request->getGet();



        // Get News Data

        $model = new TiquetModel();

        if ($search == '') {
            $paginateData = $model->getAllPaged()->findAll();
            // dd($paginateData);


        } else {
            $paginateData = $model->getByTitleOrText($search)->findAll();
        }

        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        $xls_string = "";

        foreach ($paginateData as $ticket) {
            $xls_string .= implode("\t", $ticket) . "\n";
            // d($xls_string);
        }
        // dd('fin');

        if ($search != '') {
            header('Content-Disposition: attachment; filename="' . date("d-m-Y") . '_filter-' . $search . '.xls"');
        } else {
            header('Content-Disposition: attachment; filename="' . date("d-m-Y") . '.xls"');
        }

        echo $xls_string;
    }
}
