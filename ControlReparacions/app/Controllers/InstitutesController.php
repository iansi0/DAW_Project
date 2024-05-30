<?php

namespace App\Controllers;

use App\Models\CentreModel;
use App\Models\SSTTModel;
use App\Models\TiquetModel;
use App\Models\PoblacioModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use Faker\Factory;

class InstitutesController extends BaseController
{
    public function institutes()
    {
        //Crear una tabla con todos los tickets

        $searchData = $this->request->getGet();

        if (isset($searchData) && isset($searchData['q'])) {
            $search = $searchData["q"];
        } else {
            $search = "";
        }

        // Get News Data
        $model = new CentreModel();

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
            mb_strtoupper(lang('titles.name'), 'utf-8'),
            mb_strtoupper(lang('titles.name_contact'), 'utf-8'),
            mb_strtoupper(lang('titles.email_contact'), 'utf-8'),
            mb_strtoupper(lang('titles.active'), 'utf-8'),
            mb_strtoupper(lang('titles.workshop'), 'utf-8'),
            mb_strtoupper(lang('titles.population'), 'utf-8'),
            mb_strtoupper(lang('titles.number'), 'utf-8'),
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
            'institutes' => $paginateData,
            'pager' => $model->pager,
            'search' => $search,
            'table' => $table,
        ];

        // ROWS
        foreach ($data['institutes'] as $institute) {

            $buttonUpdate = base_url("institutes/modify/" . $institute['codi']);
            $buttonView = base_url("institutes/" . $institute['codi']);
            $table->addRow(
                $institute['nom'],
                $institute['persona'],
                $institute['correu'],

                $institute['actiu'] == 0
                    ? '<i class="fa-solid fa-check text-xl text-green-600" ></i>'
                    : '<i class="fa-solid fa-xmark text-xl text-red-600" ></i>',
                $institute['taller'] == 0
                    ? '<i class="fa-solid fa-xmark text-xl text-red-600" ></i>'
                    : '<i class="fa-solid fa-check text-xl text-green-600" ></i>',
                $institute['poblacio'],
                $institute['telefon'],
                "
                <a href='$buttonView' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-primario hover:text-secundario rounded-xl hover:rounded-xl transition-all ease-out duration-250 hover:transition hover:ease-in hover:duration-250 fa-eye'></i></a>
                <a href='$buttonUpdate' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-orange-600 hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-pencil'></i></a>
                ",

            );

            $count++;
        }

        return view('institutes/institutes', $data);
    }

    public function instituteInfo($id = null, $filter = "sender")
    {



        if ($id == null) {
            return redirect()->to(base_url('/tickets'));
        }

        $modelInstitute = new CentreModel();
        $modelTickets = new TiquetModel();

        $table = new \CodeIgniter\View\Table();
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
            'table_open'  => "<table class='w-full'>",

            'thead_open'  => "<thead class='bg-primario text-secundario'>",

            'heading_cell_start' => "<th class='py-3 text-base'>",

            'row_start' => "<tr class='border-b-[0.01px] '>",
            'row_alt_start' => "<tr class='border-b-[0.01px]  bg-terciario-2'>",


        ];
        $table->setTemplate($template);

        $data = [
            'institute' => $modelInstitute->viewInstitute($id),
            'tickets' => $modelTickets->getInstituteTickets($id, $filter)->paginate(8),
            'pager' => $modelTickets->pager,
            'table' => $table,
            'filter' => $filter,
        ];


        foreach ($data['tickets'] as $ticket) {

            $buttonDelete = base_url("tickets/delete/" . $ticket['id']);
            $buttonUpdate = base_url("tickets/modify/" . $ticket['id']);
            $buttonView = base_url("tickets/" . $ticket['id']);
            $table->addRow(
                // ["data" => $ticket['id'],"class"=>'p-5'],
                explode("-", $ticket['id'])[4],
                $ticket['tipus'],
                ["data" =>  $ticket['descripcio'], "class" => " max-w-10 min-w-auto whitespace-nowrap overflow-hidden text-ellipsis"],
                $ticket['emissor'],
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
                        title: `".lang('alerts.sure')."`,
                        text: `".lang('alerts.sure_sub')."`,
                        icon: `warning`,
                        showCancelButton: true,
                        confirmButtonColor: `#3085d6`,
                        cancelButtonColor: `#d33`,
                        confirmButtonText: `".lang('alerts.yes_del')."`,
                        cancelButtonText: `".lang('alerts.cancel')."`,
                      }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = `".$buttonDelete."`;

                            Swal.fire({
                                title: `".lang('alerts.deleted')."`,
                                text: `".lang('alerts.deleted_sub')."`,
                                icon: `success`,
                            });
                        }
                      }); })()' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-red-800 hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-trash'></i></a>",

                    "class" => " p-5 flex h-16 justify-between items-center"
                ],

            );
        }

        return view('institutes/instituteInfo', $data);
    }

    public function InstituteForm()
    {

        helper('form');

        $populations = new PoblacioModel();

        $data = [
            "populations" => $populations->getAllPopulations(),
        ];

        return view('institutes/instituteForm', $data);
    }

    public function addInstitutes()
    {
        helper('form');

        $validationRules =
            [
                'code' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error Code',
                    ],
                ],
                'name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error Name',
                    ],
                ],
                'active' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error active',
                    ],
                ],
                'work' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error work',
                    ],
                ],
                'phone' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error phone',
                    ],
                ],
                'adress' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error Adress',
                    ],
                ],
                'population' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error population',
                    ],
                ],


            ];
        $model = new CentreModel();

        $fake = Factory::create("es_ES");

        $codi =  $this->request->getPost("code");
        $id_user = $fake->uuid();
        $nom =  $this->request->getPost("name");
        $actiu = $this->request->getPost("active");
        $taller =  $this->request->getPost("work");
        $telefon = $this->request->getPost("phone");
        $adreca_fisica = $this->request->getPost("adress");
        $nom_persona_contacte = "";
        $correu_persona_contacte = "a".$this->request->getPost("code")."@xtec.cat";
        $id_sstt = session('user')['code'];
        $id_poblacio = $this->request->getPost("population");

        if ($this->validate($validationRules)) {
         
            $model->addCentre(
                $id_user,
                $codi,
                $nom,
                $actiu,
                $taller,
                $telefon,
                $adreca_fisica,
                $nom_persona_contacte,
                $correu_persona_contacte,
                $id_sstt,
                $id_poblacio
            );
        } else {
            return redirect()->back()->withInput();
        }
        return redirect()->to(base_url('/institutes'));
    }

    public function modifyInstitute($id)
    {
        helper('form');

        $modelInstitute = new CentreModel();
        $populations = new PoblacioModel();

        $sstt = new SSTTModel();


        $data = [
            "institute" => $modelInstitute->getInstituteById($id),
            "populations" => $populations->getAllPopulations(),
            "SSTTs" => $sstt->getAllSSTT(),

        ];
 
        return view('institutes/modifyInstitute', $data);
    }

    public function modifyInstitute_post($id)
    {

        $model = new CentreModel();
        helper('form');

        $data = [
            "codi" =>  $this->request->getPost("code"),
            "nom" => $this->request->getPost("name"),
            "actiu" =>  intval($this->request->getPost("active")),
            "taller" => intval($this->request->getPost("work")),
            "telefon" => $this->request->getPost("phone"),
            "adreca_fisica" => $this->request->getPost("adress"),
            "id_sstt" =>  $this->request->getPost("sstt"),
            "id_poblacio" => $this->request->getPost("population"),
        ];



        $model->modifyInstitute($id, $data);

        return redirect()->to(base_url('/institutes'));
    }

    public function assign()
    {
        return view('institutes/assign');
    }
}
