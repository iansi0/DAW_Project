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
  
  
          $template = [
            'table_open'  => "<table class='w-full rounded-t-2xl overflow-hidden '>",

            'thead_open'  => "<thead class='bg-primario text-secundario '>",

            'heading_cell_start' => "<th class='py-3 text-base'>",

            'row_start' => "<tr class='border-b-[0.01px] '>",
            'row_alt_start' => "<tr class='border-b-[0.01px]  bg-[#F7F4EF]'>",
        ];
  
          $table->setTemplate($template);

          $data =[
              'students' =>$paginateData,  
              'pager' => $model->pager,
              'search'=>$search,
              'table' => $table,
          ];
  
  
          
          // llenar la tabla con los datos de los alumnes
          foreach($data['students'] as $students){
              
              $table->addRow(
                  $students['id_user'],
                  $students['nom'],
                  $students['cognoms'],
                  $students['codi_centre'],
              );
          }
          return view('students/students', $data);
        }
  

    public function studentsForm()
    {
        return view('students/studentsForm');
    }
}
