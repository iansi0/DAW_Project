<?php

namespace App\Controllers;

use App\Models\AlumneModel;
use App\Models\UsersModel;
use App\Controllers\BaseController;
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
        $table->setHeading('ID de Usuario', 'Nombre', 'Cognoms', 'Code_centre', ' ', ' ', ' ');


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

            $table->addRow(
                $students['id_user'],
                $students['nom'],
                $students['cognoms'],
                $students['codi_centre'],
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

        if ($this->request->getPost("csv")) {
            // guardar el csv 
            $file = $this->request->getPost("csv");

            // leer el csv 
            $fileCsv = fopen($file, 'r');

            // Boolean para saltarnos la primera fila (es una fila con los nombres de los campos y por ende la descartamos)
            $firstLine = true;

            // hacer un while para introducir los datos 
            while (($row = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

                if (!$firstLine) {

                    if (trim($row[2] == 1)) {

                        $modelAlumne = new AlumneModel();

                        $centre->addCentre(
                            trim($row[0]),
                            trim($row[1]),
                            false,
                            false,
                            str_replace(' ', '', trim($row[8])),
                            trim($row[6]),
                            '',
                            trim($row[24]),
                            trim($row[9]),
                            trim($row[13])
                        );
                    }
                }

                $firstLine = false;
            }

            fclose($csvFile);
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

                $fake = Factory::create("es_ES");

                $id_user = $fake->uuid();
                $nom = $this->request->getPost("name");
                $cognoms = $this->request->getPost("surnames");
                $codi_centre = session()->get('user')['code'];
                $id_curs = $this->request->getPost("course");

                $modelAlumne->addAlumne($id_user, $nom, $cognoms, $id_curs, $codi_centre);


                $user = $this->request->getPost("email");
                $passwd = password_hash($fake->password(), PASSWORD_DEFAULT);
                $lang = "ca";

                $modelUser->addUser($id_user, $user, $passwd, $lang);
                dd('añadido');
            } else {
                return redirect()->back()->withInput();
            }

            return redirect()->to(base_url('/students'));
        }
    }
}
