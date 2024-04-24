<?php

namespace App\Controllers;

use App\Models\CentreModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class InstitutesController extends BaseController
{
    public function institutes()
    {
        // crear una tabla con todos los intitutos
        $searchData = $this->request->getGet();

        if (isset($searchData) && isset($searchData['q'])) {
            $search = $searchData['q'];
        } else {
            $search = "";
        }


        // GET NEWS DATA
        $model = new CentreModel();

        // realizar la busqueda filtrada si se ha espesificado una busqueda 
        if ($search == '') {
            $paginateData = $model->getAllPaged(8);
        } else {
            $paginateData = $model->getByTitleOrText($search)->paginate(8);
        }

        /** Generador de tabla**/
        $table = new  \CodeIgniter\View\Table();
        $table->setHeading('Codi', 'ID de Usuario', 'Nombre', 'Activo', 'Taller', 'Teléfono', 'Dirección Física', 'Correo de Contacto', 'ID de SSTT', 'ID de Población', 'ver', 'eliminar', 'modificar');


        $template = [
            'table_open'  => "<table class='w-full'>",
            'thead_open'  => "<thead class='bg-primario text-secundario'>",
            'heading_cell_start' => "<th class='p-5'>",
            'cell_start' => "<td class='p-5'>",
        ];

        $table->setTemplate($template);


        /**Generador de tabla **/

        //datos que se pasaran a la vista
        $data = [
            'page_title' => 'CI4 Pager & search filter',
            'institutes' => $paginateData,  //se utiliza el metodo paginate para obtener los datos paginados
            'pager' => $model->pager,
            'search' => $search,
            'table' => $table,
        ];

        // llenar la tabla con los datos de los tickets 
        foreach ($data['institutes'] as $institute) {
            $buttonDelete = base_url("deleteinstitute/" . $institute['id_user']);
            $buttonUpdate = base_url("tu/controlador/accion/" . $institute['id_user']);
            $buttonView = base_url("instituteinfo/" . $institute['id_user']);
            $table->addRow(
                $institute['codi'],
                $institute['id_user'],
                $institute['nom'],
                $institute['actiu'],
                $institute['taller'],
                $institute['telefon'],
                $institute['adreca_fisica'],
                $institute['correu_persona_contacte'],
                $institute['id_sstt'],
                $institute['id_poblacio'],
                "<a href='$buttonView' class='btn btn-primary'>View</a>",
                "<a href='$buttonDelete' class='btn btn-primary'>Delete</a>",
                "<a href='$buttonUpdate' class='btn btn-primary'>Modify</a>"
            );
        }
        return view('institutes/institute', $data);
    }

    public function instituteForm($id = null)
    {
        // if($id == null){
        //     return redirect()->to(base_url('/intitutes'));
        // }

        // $modelInstitutes = new CentreModel();
        // // $modelInterventations = new  poner el CentreinterventatioModel o poner el CentreModel

        // /**Tabla generador**/
        // $table = new \CodeIgniter\View\Table();
        // $table->setHeading('fecha', 'alumno', 'material', 'descripción');

        // $template =[
        //     'table_open'         => "<table class='w-full'>",
        //     'thead_open'  => "<thead class='bg-primario text-secundario'>",
        //     'heading_cell_start' => "<th class='p-5 text-lg'>",
        //     'cell_start' => "<td>",
        // ];
        // $table->setTemplate($template);

        // $data = [
        //     'institute' => $modelInstitutes->viewInstitute($id),
        //     // 'interventions' => $modelInstitutes->getInterventionsByCentre($id), cambiar para intervencion de centre 
        //     'pager' =>$modelInstitutes->pager,
        //     'table' => $table,
        // ];

        // foreach($data['interventions'] as $intervencio){
        //     $buttonView = base_url("interventioninfo/".$intervencio['id']);
        //     $buttonDelete = base_url("/intervention/delete/{$intervencio['id']}");

        //     $table->addRow(
        //         $intervencio['date'],
        //         $intervencio['student'],
        //         $intervencio['type'],
        //         // botones  de ver y eliminar
        //         '<a href="'.$buttonView.'"class="btn btn-green">Ver</a>'.
        //         '<a href="'.$buttonDelete.'"class="btn btn-red ml-2">Borrar</a>',
        //         ['data' => $intervencio['descripcio'], 'class' => $intervencio['id_tipus'] == 2 ? 'bg-red-500 text-secundario' : 'bg-secundario']
        //     );
        // }
        return view('institutes/instituteForm');
    }

    public function assign()
    {

        return view('institutes/assign');
    }

    public function exportCSV($search = '')
    {
        $searchData = $this->request->getGet();

        // Obtener datos de institutos
        $model = new CentreModel();

        if ($search == '') {
            $paginateData = $model->findAll();
        } else {
            // Si hay términos de búsqueda, buscar institutos que coincidan con los términos de búsqueda
            $paginateData = $model->orLike('nombre', $search, 'both', true)->findAll($search);
        }

        // Generar el contenido del archivo CSV
        $csv_string = "";

        foreach ($paginateData as $institute) {

            $csv_string .= implode(",", $institute) . "\n";
        }

        // Encabezado para descargar como archivo CSV
        header('Content-Disposition: attachment; filename="archivo.csv"');

        // Mostrar el contenido del archivo CSV
        echo $csv_string;
    }
}
