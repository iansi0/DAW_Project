<?php

namespace App\Controllers;

use App\Models\AlumneModel;
use App\Models\UsersModel;
use App\Models\CursModel;
use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\UsersInRolesModel;
use CodeIgniter\HTTP\ResponseInterface;
use Faker\Factory;

class StudentsController extends BaseController
{
    public function students()
    {
        //crear una tabla con todas los intitutos
        $searchData = $this->request->getGet();

        if (isset($searchData) && isset($searchData['q'])) {
            $search = $searchData['q'];
        } else {
            $search = "";
        }

        // GET NEWS DATA
        $model = new AlumneModel();

        // realizar la busqueda filtrada si se ha espesificado una busqueda
        if ($search == '') {
            $paginateData = $model->getAllPaged()->paginate(8);
        } else {
            $paginateData = $model->getByTitleOrText($search)->paginate(8);
        }

        // GENERADOR DE TABLA 
        $table = new \CodeIgniter\View\Table();
        $table->setHeading('Nombre', 'Cognoms', 'Curs', 'Actions');


        $template = [
            'table_open'  => "<table class='w-full rounded-t-2xl overflow-hidden '>",

            'thead_open'  => "<thead class='bg-primario text-secundario '>",

            'heading_cell_start' => "<th class='py-3 text-base'>",

            'row_start' => "<tr class='border-b-[0.01px] '>",
            'row_alt_start' => "<tr class='border-b-[0.01px]  bg-[#F7F4EF]'>",
        ];

        $table->setTemplate($template);

        $data = [
            'students' => $paginateData,
            'pager' => $model->pager,
            'search' => $search,
            'table' => $table,
        ];



        // llenar la tabla con los datos de los alumnes
        foreach ($data['students'] as $students) {

            $buttonDelete = base_url("students/delete/" . $students['id_user']);
            $buttonUpdate = base_url("students/modify/" . $students['id_user']);

            $table->addRow(
                $students['nom'],
                $students['cognoms'],
                mb_strtoupper($students['curs']),
                [
                    "data" =>
                    "
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

                    "class" => "  justify-between items-center"
                ],
            );
        }
        return view('students/students', $data);
    }

    public function studentForm()
    {
        helper('form');

        $modelCurs = new CursModel();

        $data = [
            "courses" => $modelCurs->getAllCourses(),
        ];

        return view('students/studentsForm', $data);
    }

    public function addStudent()
    {
        helper('form');

        $validationRules =
            [
                'email' => [
                    'rules'  => 'required|valid_email',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                        'valid_email' => lang('error.wrong_email'),
                    ],
                ],
                'name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'surnames' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'course' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
            ];


        if ($this->validate($validationRules)) {

            $modelAlumne = new AlumneModel();
            $modelUser = new UsersModel();
            $userInRole = new UsersInRolesModel();
            $roleModel = new RolesModel();

            $fake = Factory::create("es_ES");

            $id_user = $fake->uuid();
            $nom = $this->request->getPost("name");
            $cognoms = $this->request->getPost("surnames");
            $codi_centre = session()->get('user')['code'];
            $id_curs = $this->request->getPost("course");

            $user = $this->request->getPost("email");
            $passwd = $fake->password();
            $passwd_hash = password_hash($passwd, PASSWORD_DEFAULT);
            $lang = "ca";


            $createdAlumne = $modelAlumne->addAlumne($id_user, $nom, $cognoms, $id_curs, $codi_centre, $user);

            if ($createdAlumne) {


                $modelUser->addUser($id_user, $user, $passwd_hash, $lang);


                $newId = $fake->uuid();
                $role = $roleModel->getIdByRole("alumn");

                $userInRole->addUserRole($newId, $id_user, $role["id"]);

                $email = \Config\Services::email();

                $email->setFrom('keepyoursoftware@gmail.com', 'KeepYourSoftware');
                $email->setTo($user);
                $email->setSubject('Usuari gestor d\'intervencions');
                $email->setMessage('Hola ' . $nom . ' ' . $cognoms . ', et donem la benvinguda a <a href="' . base_url() . '"> l\'aplicatiu de gestions d\'intervencions</a>. <br><br>
                 El teu usuari és: ' . $user . '<br> La teva contrassenya és: ' . $passwd);

                $email->send();
            }
        } else {
            return redirect()->back()->withInput();
        }

        return redirect()->to(base_url('/students'));
    }

    public function modifyStudent($id)
    {
        helper('form');

        $modelStudent = new AlumneModel();
        $modelCurs = new CursModel();

        $data = [
            'student' => $modelStudent->getStudentById($id),
            "courses" => $modelCurs->getAllCourses(),
        ];

        // dd($data['courses']);

        return view('students/modifyStudent', $data);
    }

    public function modifyStudent_post($id)
    {

        helper('form');

        $modelStudent = new AlumneModel();
        $modelUser = new UsersModel();

        $validationRules =
            [
                'email' => [
                    'rules'  => 'required|valid_email',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                        'valid_email' => lang('error.wrong_email'),
                    ],
                ],
                'name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' =>  lang('error.empty_slot_2'),
                    ],
                ],
                'surnames' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' =>  lang('error.empty_slot_2'),
                    ],
                ],
                'course' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' =>  lang('error.empty_slot_2'),
                    ],
                ],
            ];

        if ($this->validate($validationRules)) {

            $student = [
                "id_user" => $id,
                "nom"     => $this->request->getPost("name"),
                "cognoms"     => $this->request->getPost("surnames"),
                "id_curs"     => $this->request->getPost("course"),

            ];

            $modelStudent->modifyStudent($id, $student);

            $user = [
                'id' => $id,
                'user' => $this->request->getPost("email"),
            ];

            $modelUser->modifyUser($id, $user);

            return redirect()->to(base_url('/students'));
        }

        return redirect()->back()->withInput();
    }

    public function deleteStudent($id)
    {

        $modelStudent = new AlumneModel();


        $modelStudent->deleteStudent($id);


        return redirect()->to(base_url('/students'));
    }


    public function exportCSV()
    {
        $searchData = $this->request->getGet();

        if (isset($searchData['q'])) {
            $search = $searchData["q"];
        } else {
            $search = "";
        }

        // Obtener filtro de estado (?e=)
        // if (isset($searchData['e']) && !empty($searchData['e'])) {
        //     $filters['state'] = $searchData['e'];
        // } else {
        //     $filters['state'] = '';
        // }


        $model = new AlumneModel();

        // if (is_array($filters) && !empty($filters)) {
        //     $paginateData = $model->getByTitleOrText($search, $filters)->findAll();
        // } else if ($search != '') {
        //     $paginateData = $model->getByTitleOrText($search, [])->findAll();
        // } else {
        //     $paginateData = $model->getAllPaged()->findAll();
        // }

        if ($search != '') {
            $paginateData = $model->getByTitleOrText($search)->findAll();
        }else{
            $paginateData = $model->getAllPaged(true)->findAll();
        }

        $propiedades = [

            'nom', 'cognoms', 'id_curs', 'curs'
        ];



        $csv_string = "";

        $csv_string .= implode(";", $propiedades) . "\n";


        foreach ($paginateData as $ticket) {
            $csv_string .= implode(";", $ticket) . "\n";
        }

        header('Content-Disposition: attachment; filename="students_export_' . date("d-m-Y") . '.csv"');

        echo $csv_string;
    }

    // public function exportXLS()
    // {
    //     $searchData = $this->request->getGet();

    //     if (isset($searchData['q'])) {
    //         $search = $searchData["q"];
    //     } else {
    //         $search = "";
    //     }

    //     // OBTENCIÓN Y ASIGNACIÓN DE FILTROS


    //     //  Obtener filtro de dispositivo (?d=)
    //     if (isset($searchData['d']) && !empty($searchData['d'])) {
    //         $filters['device'] = $searchData['d'];
    //     } else {
    //         $filters['device'] = '';
    //     }

    //     // Obtener filtro de centro (?c=)
    //     if (isset($searchData['c']) && !empty($searchData['c'])) {
    //         $filters['center'] = $searchData['c'];
    //     } else {
    //         $filters['center'] = '';
    //     }

    //     // Obtener filtro de fecha-inicio (?dt_1=)
    //     if (isset($searchData['dt_1']) && !empty($searchData['dt_1'])) {
    //         $filters['date_ini'] = $searchData['dt_1'];
    //     } else {
    //         $filters['date_ini'] = '1970-01-01';
    //     }

    //     // Obtener filtro de fecha-fin (?dt_2=)
    //     if (isset($searchData['dt_2']) && !empty($searchData['dt_2'])) {
    //         $filters['date_end'] = $searchData['dt_2'];
    //     } else {
    //         $filters['date_end'] = date('Y-m-d');
    //     }

    //     // Obtener filtro de tiempo-inicio (?tm_1=)
    //     if (isset($searchData['tm_1']) && !empty($searchData['tm_1'])) {
    //         $filters['time_ini'] = $searchData['tm_1'];
    //     } else {
    //         $filters['time_ini'] = '00:00';
    //     }

    //     // Obtener filtro de tiempo-inicio (?tm_2=)
    //     if (isset($searchData['tm_2']) && !empty($searchData['tm_2'])) {
    //         $filters['time_end'] = $searchData['tm_2'];
    //     } else {
    //         $filters['time_end'] = '23:59';
    //     }

    //     // Obtener filtro de estado (?e=)
    //     if (isset($searchData['e']) && !empty($searchData['e'])) {
    //         $filters['state'] = $searchData['e'];
    //     } else {
    //         $filters['state'] = '';
    //     }


    //     $model = new TiquetModel();

    //     if (is_array($filters) && !empty($filters)) {
    //         $paginateData = $model->getByTitleOrText($search, $filters)->findAll();
    //     } else if ($search != '') {
    //         $paginateData = $model->getByTitleOrText($search, [])->findAll();
    //     } else {
    //         $paginateData = $model->getAllPaged()->findAll();
    //     }


    //     $propiedades = [

    //         'id', 'descripcio', 'created', 'tipus', 'estat', 'id_estat', 'emissor', 'receptor'
    //     ];



    //     $xls_string = "";

    //     $xls_string .= implode("\t", $propiedades) . "\n";

    //     foreach ($paginateData as $ticket) {

    //         $xls_string .= implode("\t", $ticket) . "\n";
    //     }

    //     $xls_string = "\xFF\xFE" . mb_convert_encoding($xls_string, 'UTF-16LE', 'UTF-8');


    //     header('Content-type: application/vnd.ms-excel;charset=UTF-16LE');
    //     header('Content-Disposition: attachment; filename="ticket_export_' . date("d-m-Y") . '.xls"');
    //     header("Cache-Control: no-cache");

    //     echo $xls_string;
    // }

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

                    $modelAlumne = new AlumneModel();
                    $modelUser = new UsersModel();
                    $userInRole = new UsersInRolesModel();
                    $roleModel = new RolesModel();

                    $id_user = $fake->uuid();
                    $nom =  trim($row[0]);
                    $cognoms = trim($row[1]);
                    $codi_centre = session()->get('user')['code'];
                    $id_curs = trim($row[2]);



                    $user = trim($row[3]);
                    $passwd = $fake->password();
                    $passwdHash = password_hash($passwd, PASSWORD_DEFAULT);
                    $lang = "ca";

                    $createdAlumne = $modelAlumne->addAlumne($id_user, $nom, $cognoms, $id_curs, $codi_centre, $user);

                    if ($createdAlumne) {


                        $modelUser->addUser($id_user, $user, $passwdHash, $lang);


                        $newId = $fake->uuid();
                        $role = $roleModel->getIdByRole("alumn");

                        $userInRole->addUserRole($newId, $id_user, $role["id"]);

                        $email = \Config\Services::email();

                        $email->setFrom('keepyoursoftware@gmail.com', 'KeepYourSoftware');
                        $email->setTo($user);
                        $email->setSubject('Usuari gestor d\'intervencions');
                        $email->setMessage('Hola ' . $nom . ' ' . $cognoms . ', et donem la benvinguda a <a href="' . base_url() . '"> l\'aplicatiu de gestions d\'intervencions</a>. <br><br>
                         El teu usuari és: ' . $user . '<br> La teva contrassenya és: ' . $passwd);

                        $email->send();
                    }
                }

                $firstLine = false;
            }

            fclose($fileCsv);

            return redirect()->to(base_url('/students'));
        }
    }


    public function downloadCSV()
    {
        // Establecer la ruta del archivo
        $rutaArchivo = WRITEPATH . 'plantillas' . DIRECTORY_SEPARATOR . 'plantilla_alumnos.csv';

        // dd($rutaArchivo);

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
        header('Content-Disposition: attachment; filename="plantilla_alumnos.csv"');
        header('Content-Length: ' . $tamañoArchivo);
        header('Content-Type: ' . $tipoContenido);

        // Leer el contenido del archivo y enviarlo al navegador
        readfile($rutaArchivo);
    }

    public function downloadXLS()
    {
        // Establecer la ruta del archivo
        $rutaArchivo = WRITEPATH . 'plantillas' . DIRECTORY_SEPARATOR . 'plantilla_alumnos.xls';

        // dd($rutaArchivo);

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
        header('Content-Disposition: attachment; filename="plantilla_alumnos.xls"');
        header('Content-Length: ' . $tamañoArchivo);
        header('Content-Type: ' . $tipoContenido);

        // Leer el contenido del archivo y enviarlo al navegador
        readfile($rutaArchivo);
    }
}
