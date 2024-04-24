<?php

namespace App\Controllers;

use App\Models\AlumneModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class StudentsController extends BaseController
{
    public function students()
    {
        //crear una tabla con todas los intitutos
        $searchData = $this->request->getGet();
        
        if(isset($searchData)&& isset($searchData['q'])){
            $search = $searchData['q'];
        }else{
            $search = "";
        }

        // GET NEWS DATA
        $model = new AlumneModel();

        // realizar la busqueda filtrada si se ha espesificado una busqueda
        if($search ==''){
            $paginateData = $model->getAllPaged(8);
        }else{
            $paginateData = $model->getByTitleOrText($search)->paginate(8);
        }

        // GENERADOR DE TABLA 
        $table = new \CodeIgniter\View\Table();
        $table->setHeading('ID de Usuario', 'Nombre','Cognoms','Code_centre',' ',' ',' ');


        $template =[
            'table_open'  => "<table class='w-full'>",
            'thead_open'  => "<thead class='bg-primario text-secundario'>",
            'heading_cell_start' => "<th class='p-5'>",
            'cell_start' => "<td class='p-5'>",
        ];

        $table->setTemplate($template);

        /**GENERADOR DE TABLA**/

        //datos que se pasaran a la vista 
        $data =[
            'page_title' => 'CI4 Pager & search filter',
            'students' =>$paginateData,  //se utiliza el metodo paginate para obtener los datos paginados
            'pager' => $model->pager,
            'search'=>$search,
            'table' => $table,
        ];


        
        // llenar la tabla con los datos de los alumnes
        foreach($data['students'] as $students){
            $buttonDelete = base_url("deleteStudents/". $students['id_user']);
            $buttonUpdate = base_url("tu/controlador/accion/" . $students['id_user']);
            $buttonView = base_url("Studentsinfo/" . $students['id_user']);

            
            $table->addRow(
                $students['id_user'],
                $students['nom'],
                $students['cognoms'],
                $students['codi_centre'],
                "<a href='$buttonView' class='btn btn-green text-white bg-green-500 hover:bg-green-600 px-3 py-1 rounded'>View</a>",
                "<a href='$buttonDelete' class='btn btn-red text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded'>Delete</a>",
                "<a href='$buttonUpdate' class='btn btn-yellow text-white bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded'>Modify</a>"
            );
        }
        return view('students/students', $data);
    }

    public function studentsForm()
    {
        return view('students/studentsForm');
    }

    public function exportCSV($search = '')
    {
        $searchData = $this->request->getGet();

        // Obtener datos de institutos
        $model = new AlumneModel();

        if ($search == '') {
            $paginateData = $model->findAll();
        } else {
            // Si hay términos de búsqueda, buscar institutos que coincidan con los términos de búsqueda
            $paginateData = $model->orLike('nombre', $search, 'both', true)->findAll($search);
        }

        // Generar el contenido del archivo CSV
        $csv_string = "";

        foreach ($paginateData as $students) {

            $csv_string .= implode(",", $students) . "\n";
        }

        // Encabezado para descargar como archivo CSV
        header('Content-Disposition: attachment; filename="archivo.csv"');

        // Mostrar el contenido del archivo CSV
        echo $csv_string;
    }
}
