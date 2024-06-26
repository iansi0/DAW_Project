<?php

namespace App\Controllers;

use App\Models\TiquetModel;
use App\Models\TipusDispositiuModel;
use App\Controllers\BaseController;
use App\Database\Migrations\ESTATS;
use App\Models\CentreModel;
use App\Models\EstatModel;
use App\Models\IntervencioModel;
use App\Models\InventariModel;
use Faker\Factory;
use Google\Service\Walletobjects\Pagination;

use App\Libraries\UUID as LibrariesUUID;

class TicketsController extends BaseController
{
    public function tickets()
    {
        // Crear una tabla con todos los tickets

        $searchData = $this->request->getGet();

        if (isset($searchData) && isset($searchData['q'])) {
            $search = $searchData["q"];
        } else {
            $search = "";
        }

        // OBTENCIÓN Y ASIGNACIÓN DE FILTROS
        if (isset($searchData)) {

            //  Obtener filtro de dispositivo (?d=)
            if (isset($searchData['d']) && !empty($searchData['d'])) {
                $filters['device'] = $searchData['d'];
            } else {
                $filters['device'] = '';
            }

            // Obtener filtro de centro (?c=)
            if (isset($searchData['c']) && !empty($searchData['c'])) {
                $filters['center'] = $searchData['c'];
            } else {
                $filters['center'] = '';
            }

            // Obtener filtro de fecha-inicio (?dt_1=)
            if (isset($searchData['dt_1']) && !empty($searchData['dt_1'])) {
                $filters['date_ini'] = $searchData['dt_1'];
            } else {
                $filters['date_ini'] = '1970-01-01';
            }

            // Obtener filtro de fecha-fin (?dt_2=)
            if (isset($searchData['dt_2']) && !empty($searchData['dt_2'])) {
                $filters['date_end'] = $searchData['dt_2'];
            } else {
                $filters['date_end'] = date('Y-m-d');
            }

            // Obtener filtro de tiempo-inicio (?tm_1=)
            if (isset($searchData['tm_1']) && !empty($searchData['tm_1'])) {
                $filters['time_ini'] = $searchData['tm_1'];
            } else {
                $filters['time_ini'] = '00:00';
            }

            // Obtener filtro de tiempo-inicio (?tm_2=)
            if (isset($searchData['tm_2']) && !empty($searchData['tm_2'])) {
                $filters['time_end'] = $searchData['tm_2'];
            } else {
                $filters['time_end'] = '23:59';
            }

            // Obtener filtro de estado (?e=)
            if (isset($searchData['e']) && !empty($searchData['e'])) {
                $filters['state'] = $searchData['e'];
            } else {
                $filters['state'] = '';
            }
        }

        // Get Tiquet Data
        $model = new TiquetModel();

        if (is_array($filters) && !empty($filters)) {
            $paginateData = $model->getByTitleOrText($search, $filters)->paginate(8);
        } else if ($search != '') {
            $paginateData = $model->getByTitleOrText($search, [])->paginate(8);
        } else {
            $paginateData = $model->getAllPaged()->paginate(8);
        }


        ($filters['date_ini'] == '1970-01-01') ? '' : $filters['date_ini'];
        ($filters['time_ini'] == '00:00') ? '' : $filters['time_ini'];
        ($filters['time_end'] == '23:59') ? '' : $filters['time_end'];

        // Get Filter Data
        $centresModel = new CentreModel();
        $arrCentres = $centresModel->getAllCenter();
        $estatModel = new EstatModel();
        $arrEstat = $estatModel->getAllStates();
        $dispModel = new TipusDispositiuModel();
        $arrDisp = $dispModel->getAllTypes();
        $arrFilters['centers'] = $arrCentres;
        $arrFilters['states'] = $arrEstat;
        $arrFilters['devices'] = $arrDisp;

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
            'filters' => $filters,
            'arrFilters' => $arrFilters,
            'table' => $table,
        ];
        $role = session()->get('user')['role'];
        // ROWS
        $count = 0;
        foreach ($data['tickets'] as $ticket) {

            $buttonDelete = base_url("tickets/delete/" . $ticket['id']);
            $buttonUpdate = base_url("tickets/modify/" . $ticket['id']);
            $buttonView = base_url("tickets/" . $ticket['id']);

            if (($role == "admin") || ($role == "sstt") || (($role == "prof") && ($ticket['id_estat'] == 1)) || (($role == "ins") && ($ticket['id_estat'] == 1))) {
                $table->addRow(
                    // ["data" => $ticket['id'],"class"=>'p-5'],
                    explode("-", $ticket['id'])[4],
                    $ticket['tipus'],
                    ["data" =>  $ticket['descripcio'], "class" => " max-w-10 min-w-auto whitespace-nowrap overflow-hidden text-ellipsis"],
                    ($ticket['emissor'] != lang('titles.toassign')) ? $ticket['emissor'] : lang('titles.toassign') . ' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',
                    ($ticket['receptor'] != lang('titles.toassign')) ? $ticket['receptor'] : lang('titles.toassign') . ' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',

                    date("d/m/Y", strtotime($ticket['created'])),
                    date("H:i", strtotime($ticket['created'])),

                    ["data" => "<a class='flex p-3 justify-center  whitespace-nowrap w-full estat_" . $ticket['id_estat'] . "'>" . $ticket['estat'] . "</a>", "class" => "p-2 "],

                    [
                        "data" =>
                        "<a href='$buttonView' style='view-transition-name: info" . $ticket['id'] . ";' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-primario hover:text-secundario rounded-xl hover:rounded-xl transition-all ease-out duration-250 hover:transition hover:ease-in hover:duration-250 fa-eye'></i></a>
                         <a href='$buttonUpdate' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-orange-600 hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-pencil'></i></a>
                         <a onclick='(function() { Swal.fire({
                            customClass:{htmlContainer: ``,},
                            title: `" . lang('alerts.sure') . "`,
                            text: `" . lang('alerts.sure_sub') . "`,
                            icon: `warning`,
                            showCancelButton: true,
                            confirmButtonColor: `#3085d6`,
                            cancelButtonColor: `#d33`,
                            confirmButtonText: `" . lang('alerts.yes_del') . "`,
                            cancelButtonText: `" . lang('alerts.cancel') . "`,
                          }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = `" . $buttonDelete . "`;

                                Swal.fire({
                                    title: `" . lang('alerts.deleted') . "`,
                                    text: `" . lang('alerts.deleted_sub') . "`,
                                    icon: `success`,
                                });
                            }
                          }); })()' class='p-2 btn btn-primary'><i class='fa-solid p-3 cursor-pointer text-xl text-terciario-1 hover:bg-red-800 hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-trash'></i></a>",

                        "class" => " p-5 flex h-16 justify-between items-center"
                    ],

                );
            } elseif (("ins" == $role) && ($ticket['id_estat'] != 1)) {
                $table->addRow(
                    // ["data" => $ticket['id'],"class"=>'p-5'],
                    explode("-", $ticket['id'])[4],
                    $ticket['tipus'],
                    ["data" =>  $ticket['descripcio'], "class" => " max-w-10 min-w-auto whitespace-nowrap overflow-hidden text-ellipsis"],
                    ($ticket['emissor'] != lang('titles.toassign')) ? $ticket['emissor'] : lang('titles.toassign') . ' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',
                    ($ticket['receptor'] != lang('titles.toassign')) ? $ticket['receptor'] : lang('titles.toassign') . ' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',

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
            } else {
                $table->addRow(
                    // ["data" => $ticket['id'],"class"=>'p-5'],
                    explode("-", $ticket['id'])[4],
                    $ticket['tipus'],
                    ["data" =>  $ticket['descripcio'], "class" => " max-w-10 min-w-auto whitespace-nowrap overflow-hidden text-ellipsis"],
                    ($ticket['emissor'] != lang('titles.toassign')) ? $ticket['emissor'] : lang('titles.toassign') . ' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',
                    ($ticket['receptor'] != lang('titles.toassign')) ? $ticket['receptor'] : lang('titles.toassign') . ' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',

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
        $modelInventari = new InventariModel();
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
            'estatsFiltrats' => $estat->getFilteredStates(),
        ];

        $totalPrice = 0;

        foreach ($data['interventions'] as $intervencio) {

            $totalPrice += $intervencio['preu'];

            $buttonView = base_url("tickets/" . $intervencio['id']); // Reemplazar con tu ruta real

            $table->addRow(
                $intervencio['created_at'],
                $intervencio['correu_alumne'],
                $intervencio['material'],

                ['data' => $intervencio['descripcio'], 'class' => $intervencio['id_tipus'] == 1 ? 'bg-red-500 text-segundario' : 'bg-segundario']
            );
        }

        $data += ['totalPrice' => $totalPrice,];

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

        $arrTickets = $this->request->getPost('arrTickets');

        // Forzamos el json_decode
        $arrTickets = json_decode((string) $arrTickets);

        // dd($arrTickets);

        // Creamos un array que irá almacenando los inputs erróneos
        $arrErrors = [];

        // Hacemos un primer recorrido comprobando que los inputs están correctos
        foreach ($arrTickets as $ticket) {

            $id_ticket = $ticket[0]->id;
            $id_tipus_dispositiu = $ticket[1]->id_type;
            $descripcio_avaria =  $ticket[4]->description;
            $nom_persona_contacte_centre = $ticket[5]->nameContact;
            $correu_persona_contacte_centre =  $ticket[6]->emailContact;

            if ($id_tipus_dispositiu == null || $id_tipus_dispositiu == '') {
                $arrErrors[$id_ticket]["id_type"] = lang('error.id_type');
            }
            if ($descripcio_avaria == null || $descripcio_avaria == '') {
                $arrErrors[$id_ticket]["description"] = lang('error.description');
            }
            if ($nom_persona_contacte_centre == null || $nom_persona_contacte_centre == '') {
                $arrErrors[$id_ticket]["nameContact"] = lang('error.nameContact');
            }
            if ($correu_persona_contacte_centre == null || $correu_persona_contacte_centre == '') {
                $arrErrors[$id_ticket]["emailContact"] = lang('error.emailContact');
            }
        }

        // Si detectamos errores, los mandamos de vuelta al front para ser corregidos
        // PD: el flash data no sera ejecutado y no solo eso, se le va a recargar la pagina al cliente borrándole todos los tiquets
        // PDD: Un cliente normal se quedaria en las validaciones de javascript
        if (count($arrErrors) > 0) {
            session()->setFlashdata('error', $arrErrors);
            return redirect()->back();
        }

        // Si todo esta bien, añadimos los tickets
        foreach ($arrTickets as $ticket) {

            $model = new TiquetModel();

            $id_tiquet = LibrariesUUID::v4();
            $codi_equip = null;
            $id_tipus_dispositiu = $ticket[1]->id_type;
            $ins_emissor = $ticket[2]->sender??0;
            $ins_receptor = $ticket[3]->repair??0;
            $descripcio_avaria =  $ticket[4]->description;
            $nom_persona_contacte_centre = $ticket[5]->nameContact;
            $correu_persona_contacte_centre =  $ticket[6]->emailContact;
            $id_estat = 1;

            if (session()->get('user')['role'] == "prof" || session()->get('user')['role'] == "ins") {
                $ins_emissor = session()->get('user')['code'];
                $ins_receptor = 0;
            }

            $model->addTiquet(
                $id_tiquet,
                $codi_equip,
                $descripcio_avaria,
                $nom_persona_contacte_centre,
                $correu_persona_contacte_centre,
                $id_tipus_dispositiu,
                $id_estat,
                $ins_emissor,
                $ins_receptor
            );
            
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


    public function saveState($id)
    {
        $model = new TiquetModel();

        $estat = $this->request->getPost("selectType");
        $model->saveState($id, $estat);

        return redirect()->to(base_url('/tickets/' . $id));
    }

    public function exportCSV()
    {
        $searchData = $this->request->getGet();

        if (isset($searchData['q'])) {
            $search = $searchData["q"];
        } else {
            $search = "";
        }

        //  Obtener filtro de dispositivo (?d=)
        if (isset($searchData['d']) && !empty($searchData['d'])) {
            $filters['device'] = $searchData['d'];
        } else {
            $filters['device'] = '';
        }


        // Obtener filtro de centro (?c=)
        if (isset($searchData['c']) && !empty($searchData['c'])) {
            $filters['center'] = $searchData['c'];
        } else {
            $filters['center'] = '';
        }

        // Obtener filtro de fecha-inicio (?dt_1=)
        if (isset($searchData['dt_1']) && !empty($searchData['dt_1'])) {
            $filters['date_ini'] = $searchData['dt_1'];
        } else {
            $filters['date_ini'] = '1970-01-01';
        }

        // Obtener filtro de fecha-fin (?dt_2=)
        if (isset($searchData['dt_2']) && !empty($searchData['dt_2'])) {
            $filters['date_end'] = $searchData['dt_2'];
        } else {
            $filters['date_end'] = date('Y-m-d');
        }

        // Obtener filtro de tiempo-inicio (?tm_1=)
        if (isset($searchData['tm_1']) && !empty($searchData['tm_1'])) {
            $filters['time_ini'] = $searchData['tm_1'];
        } else {
            $filters['time_ini'] = '00:00';
        }

        // Obtener filtro de tiempo-inicio (?tm_2=)
        if (isset($searchData['tm_2']) && !empty($searchData['tm_2'])) {
            $filters['time_end'] = $searchData['tm_2'];
        } else {
            $filters['time_end'] = '23:59';
        }

        // Obtener filtro de estado (?e=)
        if (isset($searchData['e']) && !empty($searchData['e'])) {
            $filters['state'] = $searchData['e'];
        } else {
            $filters['state'] = '';
        }

        // dd($filters);

        $model = new TiquetModel();

        if (is_array($filters) && !empty($filters)) {
            $paginateData = $model->getByTitleOrText($search, $filters)->findAll();
        } else if ($search != '') {
            $paginateData = $model->getByTitleOrText($search, [])->findAll();
        } else {
            $paginateData = $model->getAllPaged()->findAll();
        }

        // dd($paginateData);
        $csv_string = "";

        foreach ($paginateData as $ticket) {
            $csv_string .= implode(",", $ticket) . "\n";
        }

        header('Content-Disposition: attachment; filename="ticket_export_' . date("d-m-Y") . '.csv"');

        echo $csv_string;
    }

    public function exportXLS()
    {
        $searchData = $this->request->getGet();

        if (isset($searchData['q'])) {
            $search = $searchData["q"];
        } else {
            $search = "";
        }

        // OBTENCIÓN Y ASIGNACIÓN DE FILTROS


        //  Obtener filtro de dispositivo (?d=)
        if (isset($searchData['d']) && !empty($searchData['d'])) {
            $filters['device'] = $searchData['d'];
        } else {
            $filters['device'] = '';
        }

        // Obtener filtro de centro (?c=)
        if (isset($searchData['c']) && !empty($searchData['c'])) {
            $filters['center'] = $searchData['c'];
        } else {
            $filters['center'] = '';
        }

        // Obtener filtro de fecha-inicio (?dt_1=)
        if (isset($searchData['dt_1']) && !empty($searchData['dt_1'])) {
            $filters['date_ini'] = $searchData['dt_1'];
        } else {
            $filters['date_ini'] = '1970-01-01';
        }

        // Obtener filtro de fecha-fin (?dt_2=)
        if (isset($searchData['dt_2']) && !empty($searchData['dt_2'])) {
            $filters['date_end'] = $searchData['dt_2'];
        } else {
            $filters['date_end'] = date('Y-m-d');
        }

        // Obtener filtro de tiempo-inicio (?tm_1=)
        if (isset($searchData['tm_1']) && !empty($searchData['tm_1'])) {
            $filters['time_ini'] = $searchData['tm_1'];
        } else {
            $filters['time_ini'] = '00:00';
        }

        // Obtener filtro de tiempo-inicio (?tm_2=)
        if (isset($searchData['tm_2']) && !empty($searchData['tm_2'])) {
            $filters['time_end'] = $searchData['tm_2'];
        } else {
            $filters['time_end'] = '23:59';
        }

        // Obtener filtro de estado (?e=)
        if (isset($searchData['e']) && !empty($searchData['e'])) {
            $filters['state'] = $searchData['e'];
        } else {
            $filters['state'] = '';
        }


        $model = new TiquetModel();

        if (is_array($filters) && !empty($filters)) {
            $paginateData = $model->getByTitleOrText($search, $filters)->findAll();
        } else if ($search != '') {
            $paginateData = $model->getByTitleOrText($search, [])->findAll();
        } else {
            $paginateData = $model->getAllPaged()->findAll();
        }

        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="ticket_export_' . date("d-m-Y") . '.xls"');

        echo "\xEF\xBB\xBF"; // UTF-8 BOM

        // Encabezados de las columnas
        echo "Identificador\tDescripcion\tFecha\ttipo\testat\temissor\treceptor\n";
        $xls_string = "";

        foreach ($paginateData as $ticket) {
            echo implode("\t", $ticket) . "\n";
            // d($xls_string);
        }
        // dd('fin');


    }
}
