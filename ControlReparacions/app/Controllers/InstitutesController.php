<?php

namespace App\Controllers;

use App\Models\CentreModel;
use App\Models\UsersModel;
use App\Models\UsersInRolesModel;
use App\Models\RolesModel;
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
            'table_open'  => "<table class='w-full rounded-t-2xl shadow-xl overflow-hidden '>",

            'thead_open'  => "<thead class='py-5 bg-primario text-secundario '>",

            'heading_cell_start' => "<th class='py-6 text-base'>",

            'row_start' => "<tr class='border-b-[0.01px] py-2'>",
            'row_alt_start' => "<tr class='border-b-[0.01px]  bg-[#F7F4EF] py-2'>",
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

                $institute['actiu'] == 1
                    ? '<i class="fa-solid py-6 fa-check text-xl text-green-600" ></i>'
                    : '<i class="fa-solid py-6 fa-xmark text-xl text-red-600" ></i>',
                $institute['taller'] == 1
                    ? '<i class="fa-solid py-6 fa-check text-xl text-green-600" ></i>'
                    : '<i class="fa-solid py-6 fa-xmark text-xl text-red-600" ></i>',
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

            'heading_cell_start' => "<th class='py-6 text-base'>",

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
                ($ticket['emissor'] != lang('titles.toassign')) ? $ticket['emissor'] : lang('titles.toassign') . ' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',
                ($ticket['receptor'] != lang('titles.toassign')) ? $ticket['receptor'] : lang('titles.toassign') . ' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',

                date("d/m/Y", strtotime($ticket['created'])),
                date("H:i", strtotime($ticket['created'])),

                ["data" => "<a class='flex p-3 justify-center  whitespace-nowrap w-full estat_" . $ticket['id_estat'] . "'>" . $ticket['estat'] . "</a>", "class" => "p-3 "],

                [
                    "data" =>
                    "<a href='$buttonView' style='view-transition-name: info" . $ticket['id'] . ";' class='py-2 btn btn-primary'><i class='fa-solid p-3 text-center mt-4 text-xl text-terciario-1 hover:bg-primario hover:text-secundario rounded-xl hover:rounded-xl transition-all ease-out duration-250 hover:transition hover:ease-in hover:duration-250 fa-eye'></i></a>
                     <a href='$buttonUpdate' class='py-2 btn btn-primary'><i class='fa-solid p-3 text-center mt-4 text-xl text-terciario-1 hover:bg-orange-600 hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-pencil'></i></a>
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
    
                            Swal.fire({
                                title: `" . lang('alerts.deleted') . "`,
                                text: `" . lang('alerts.deleted_sub') . "`,
                                icon: `success`,
                                showConfirmButton: false,
                                timer:2000,
    
                            }).then(()=>{
                                window.location.href = `".$buttonDelete."`;
    
                            });
                        }
                      }); })()' class='py-2 cursor-pointer btn btn-primary'><i class='fa-solid p-3 px-3.5 text-xl mt-4 text-terciario-1 hover:bg-red-800 hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-trash'></i></a>",

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
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'active' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'work' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'phone' => [
                    'rules'  => 'required|is_numeric|min_length[9]|max_length[9]',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                        'is_numeric' => lang('error.wrong_numeric'),
                        'min_length' => lang('error.wrong_numeric'),
                        'max_length' => lang('error.wrong_numeric'),
                    ],
                ],
                'adress' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'population' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],


            ];
        $model = new CentreModel();
        $modelUser = new UsersModel();

        $fake = Factory::create("es_ES");

        $codi =  $this->request->getPost("code");
        $id_user = $fake->uuid();
        $nom =  $this->request->getPost("name");
        $actiu = $this->request->getPost("active");
        $taller =  $this->request->getPost("work");
        $telefon = $this->request->getPost("phone");
        $adreca_fisica = $this->request->getPost("adress");
        $nom_persona_contacte = "";
        $correu_persona_contacte = "a" . $this->request->getPost("code") . "@xtec.cat";
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

            $user = $codi . "@xtec.cat";
            $passwd_hash = password_hash($fake->password(), PASSWORD_DEFAULT);
            $lang = 'ca';

            $modelUser->addUser($id_user, $user, $passwd_hash, $lang);

            $roleModel = new RolesModel();
            $userInRole = new UsersInRolesModel();
            $newId = $fake->uuid();
            $role = $roleModel->getIdByRole("ins");

            $userInRole->addUserRole($newId, $id_user, $role["id"]);
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

        $validationRules =
            [
                'code' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'active' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'work' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'phone' => [
                    'rules'  => 'required|is_numeric|min_length[9]|max_length[9]',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                        'is_numeric' => lang('error.wrong_numeric'),
                        'min_length' => lang('error.wrong_numeric'),
                        'max_length' => lang('error.wrong_numeric'),
                    ],
                ],
                'adress' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'population' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],


            ];

        if ($this->validate($validationRules)) {

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

        return redirect()->back()->withInput();
    }

    public function assign()
    {
        return view('institutes/assign');
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
        // if (isset($searchData['d']) && !empty($searchData['d'])) {
        //     $filters['device'] = $searchData['d'];
        // } else {
        //     $filters['device'] = '';
        // }

        $model = new CentreModel();

        // if (is_array($filters) && !empty($filters)) {
        //     $paginateData = $model->getByTitleOrText($search, $filters)->findAll();
        // } else if ($search != '') {
        //     $paginateData = $model->getByTitleOrText($search, [])->findAll();
        // } else {
        //     $paginateData = $model->getAllPaged()->findAll();
        // }

        if ($search != '') {
            $paginateData = $model->getByTitleOrText($search)->findAll();
        } else {
            $paginateData = $model->getAllPaged()->findAll();
        }

        $propiedades = [

            'codi', 'nom', 'actiu', 'taller', 'persona', 'correu', 'id_poblacio', 'telefon', 'adreca', 'poblacio'
        ];



        $csv_string = "";

        $csv_string .= implode(";", $propiedades) . "\n";


        foreach ($paginateData as $ticket) {
            $csv_string .= implode(";", $ticket) . "\n";
        }

        header('Content-Disposition: attachment; filename="instituts_export_' . date("d-m-Y") . '.csv"');

        echo $csv_string;
    }

    public function importCSV()
    {
        $csv = $this->request->getFiles()['uploadCSV'];

        if ($csv->getSize() != 0) {
            // guardar el csv 
            $file = $this->request->getFiles();

            // leer el csv 
            $fileCsv = fopen($file['uploadCSV'], 'r');

            // Boolean para saltarnos la primera fila (es una fila con los nombres de los campos y por ende la descartamos)
            $firstLine = true;

            // hacer un while para introducir los datos 
            while (($row = fgetcsv($fileCsv, 2000, ";")) !== FALSE) {

                if (!$firstLine) {

                    $fake = Factory::create("es_ES");

                    $modelCentre = new CentreModel();
                    $modelUser = new UsersModel();
                    $userInRole = new UsersInRolesModel();
                    $roleModel = new RolesModel();


                    $fake = Factory::create("es_ES");

                    $codi =  trim($row[0]);
                    $id_user = $fake->uuid();
                    $nom =  trim($row[1]);
                    $actiu = trim($row[2]);
                    $taller =  trim($row[3]);
                    $nom_persona_contacte = trim($row[4]);
                    $correu_persona_contacte = trim($row[5]);
                    $id_poblacio = trim($row[6]);
                    $telefon = trim($row[7]);
                    $adreca_fisica = trim($row[8]);
                    $id_sstt = session('user')['code'];



                    $user = trim($row[5]);
                    $passwd = $fake->password();
                    $passwdHash = password_hash($passwd, PASSWORD_DEFAULT);
                    $lang = "ca";

                    $createdInstitute = $modelCentre->addCentre($id_user, $codi, $nom, $actiu, $taller, $telefon, $adreca_fisica, $nom_persona_contacte, $correu_persona_contacte, $id_sstt, $id_poblacio);

                    if ($createdInstitute) {

                        $modelUser->addUser($id_user, $user, $passwdHash, $lang);

                        $newId = $fake->uuid();
                        $role = $roleModel->getIdByRole("ins");

                        $userInRole->addUserRole($newId, $id_user, $role["id"]);

                    }
                }

                $firstLine = false;
            }

            fclose($fileCsv);

            return redirect()->to(base_url('/institutes'));
        }
    }

    public function downloadCSV()
    {
        // Establecer la ruta del archivo
        $rutaArchivo = WRITEPATH . 'plantilles' . DIRECTORY_SEPARATOR . 'plantilla_centres.csv';


        // Comprobar si el archivo existe
        if (!file_exists($rutaArchivo)) {
            // Manejar el error de archivo no encontrado
            echo "Error: Archivo no encontrado";
            return;
        }

        // Obtener el tamaño y el tipo de contenido del archivo
        $tamañoArchivo = filesize($rutaArchivo);
        $tipoContenido = mime_content_type($rutaArchivo);

        // Establecer encabezados de descarga
        header('Content-Disposition: attachment; filename="plantilla_centres.csv"');
        header('Content-Length: ' . $tamañoArchivo);
        header('Content-Type: ' . $tipoContenido);

        // Leer el contenido del archivo y enviarlo al navegador
        readfile($rutaArchivo);
    }
}
