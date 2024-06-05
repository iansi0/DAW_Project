<?php

namespace App\Controllers;

use App\Models\AlumneModel;
use App\Models\UsersModel;
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
            $paginateData = $model->getAllPaged(8);
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
                $students['curs'],
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
        return view('students/studentsForm');
    }

    public function addStudent()
    {
        helper('form');


        $csv = $this->request->getFiles()['csv'];

        if ($csv->getSize() != 0) {
            // guardar el csv 
            $file = $this->request->getFiles();


            // leer el csv 
            $fileCsv = fopen($file['csv'], 'r');

            // Boolean para saltarnos la primera fila (es una fila con los nombres de los campos y por ende la descartamos)
            $firstLine = false;

            // hacer un while para introducir los datos 
            while (($row = fgetcsv($fileCsv, 2000, ",")) !== FALSE) {

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

                    $modelAlumne->addAlumne($id_user, $nom, $cognoms, $id_curs, $codi_centre, $user);
                    $modelUser->addUser($id_user, $user, $passwdHash, $lang);

                    // revisralo 
                    $newId = $fake->uuid();
                    $role = $roleModel->getIdByRole("alumn");

                    $userInRole->addUserRole($newId, $id_user, $role["id"]);
                }

                $firstLine = false;
            }

            fclose($fileCsv);

            $email = \Config\Services::email();

            $email->setFrom('braianpb02@gmail.com', 'KYS');
            $email->setTo($user);
            $email->setSubject('Registro KYS');
            $email->setMessage('Tu contraseña es: ' . $passwd);

            if ($email->send()) {
                echo 'Correo electrónico enviado correctamente.';
            } else {
                echo 'Error al enviar el correo electrónico.';
            }

            return redirect()->to(base_url('/students'));
        } else {
            $validationRules =
                [
                    'email' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Error Email',
                        ],
                    ],
                    'name' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Error Name',
                        ],
                    ],
                    'surnames' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Error Surnames',
                        ],
                    ],
                    'course' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Error Course',
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


                // dd($createdAlumne);
                if ($createdAlumne) {


                    $modelUser->addUser($id_user, $user, $passwd_hash, $lang);


                    $newId = $fake->uuid();
                    $role = $roleModel->getIdByRole("alumn");

                    $userInRole->addUserRole($newId, $id_user, $role["id"]);

                    $email = \Config\Services::email();

                $email->setFrom('keepyoursoftware@gmail.com', 'KeepYourSoftware');
                $email->setTo($user);
                $email->setSubject('Usuari gestor d\'intervencions');
                $email->setMessage('Hola '.$nom.' '.$cognoms.', et donem la benvinguda a <a href="'.base_url().'"> l\'aplicatiu de gestions d\'intervencions</a>. <br><br>
                 El teu usuari és: ' . $user . '<br> La teva contrassenya és: ' . $passwd);

                    $email->send();
                }
            } else {
                return redirect()->back()->withInput();
            }

            return redirect()->to(base_url('/students'));
        }
    }

    public function modifyStudent($id)
    {
        helper('form');

        $modelStudent = new AlumneModel();

        $data = [
            'student' => $modelStudent->getStudentById($id),
        ];

        return view('students/modifyStudent', $data);
    }

    public function deleteStudent($id)
    {

        $modelStudent = new AlumneModel();


        $modelStudent->deleteStudent($id);


        return redirect()->to(base_url('/students'));
    }
}
