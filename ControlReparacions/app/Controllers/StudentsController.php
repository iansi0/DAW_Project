<?php

namespace App\Controllers;

use App\Models\AlumneModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class StudentsController extends BaseController
{
    public function students()
    {
        //CODIGO KPACRUD
        /*
        //Crear el objeto kpaCrud
        $crud = new KpaCrud();
 
        //La tabla que mostrara el kpaCrud sera solo de vista, no tendra funciones(add, modify, delete...)
        $crud->setConfig('default');
 
        //Le decimos a que tabla hace referencia
        $crud->setTable('Alumne');
 
        //Decimos que columnas nos interesa mostrar
        $crud->setColumns(['correu_alumne', 'codi_centre']);
 
        $data['table_alumnes'] = $crud;
        */
        return view('students/students', /* $data*/);
    }

    public function studentsForm()
    {
        return view('students/studentsForm');
    }
}
