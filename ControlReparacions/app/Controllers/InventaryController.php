<?php

namespace App\Controllers;

use App\Models\InventariModel;
use App\Models\TipusInventariModel;
use App\Models\UsersModel;
use App\Models\UsersInRolesModel;
use App\Models\RolesModel;

use Faker\Factory;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class InventaryController extends BaseController
{
    public function index()
    {

        //Crear una tabla con todos los tickets

        $searchData = $this->request->getGet();

        if (isset($searchData) && isset($searchData['q'])) {
            $search = $searchData["q"];
        } else {
            $search = "";
        }

        // Get News Data


        $model = new InventariModel();

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
            mb_strtoupper(lang('titles.id'), 'utf-8'),
            mb_strtoupper(lang('titles.name'), 'utf-8'),
            mb_strtoupper(lang('titles.date'), 'utf-8'),
            mb_strtoupper(lang('titles.price'), 'utf-8'),
            mb_strtoupper(lang('titles.type'), 'utf-8'),
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
            'inventary' => $paginateData,
            'pager' => $model->pager,
            'search' => $search,
            'table' => $table,
        ];

        // ROWS
        foreach ($data['inventary'] as $product) {

            $buttonDelete = base_url("inventary/delete/" . $product['id']);
            $buttonUpdate = base_url("inventary/modify/" . $product['id']);


            $table->addRow(
                $product['id'],
                $product['nom'],
                $product['data_compra'],
                $product['preu'],
                $product['nomInventary'],
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
                  }); })()' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-red-800 hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-trash'></i></a>
                ",
            );

            $count++;
        }

        return view('inventary/inventary', $data);
    }

    public function inventaryForm()
    {

        helper('form');

        $type = new TipusInventariModel();

        $data = [

            "types" => $type->getAllTypes(),
        ];

        return view('inventary/inventaryForm', $data);
    }

    public function addInventary()
    {
        helper('form');

        $validationRules =
            [
                'name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'price' => [
                    'rules'  => 'required|is_numeric',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                        'is_numeric' => lang('error.wrong_price'),
                    ],
                ],
                'type_inventary' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
            ];

        if ($this->validate($validationRules)) {


            $model = new InventariModel();
            $fake = Factory::create("es_ES");

            $id = $fake->uuid();
            $nom = $this->request->getPost("name");
            $data_compra = date('Y-m-d');
            $preu = $this->request->getPost("price");
            $codi_centre = session('user')['code'];
            $id_tipus_inventari = $this->request->getPost("type_inventary");

            $model->addInventari(
                $id,
                $nom,
                $data_compra,
                $preu,
                $codi_centre,
                $id_tipus_inventari
            );

            return redirect()->to(base_url('inventary'));
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function modifyInventary($id)
    {
        helper('form');

        $type = new TipusInventariModel();
        $inventary = new InventariModel();

        $data = [
            "types" => $type->getAllTypes(),
            "product" => $inventary->getInventarytById($id),
        ];
        return view('inventary/modifyInventary', $data);
    }

    public function modifyInventary_post($id)
    {
        helper('form');

        $validationRules =
            [
                'name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'price' => [
                    'rules'  => 'required|is_numeric',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                        'is_numeric' => lang('error.wrong_price'),
                    ],
                ],
                'type_inventary' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
            ];

        if ($this->validate($validationRules)) {
            $model = new InventariModel();

            $data = [
                "id" =>  $id,
                "nom" =>  $this->request->getPost("name"),
                "preu" =>  $this->request->getPost("price"),
                "id_tipus_inventari" => intval($this->request->getPost("type_inventary")),
            ];


            $model->modifyInventari($id, $data);

            return redirect()->to(base_url('/inventary'));
        }

        return redirect()->back()->withInput();
    }

    public function deleteInventary($id)
    {

        $model = new InventariModel();

        $model->deleteInventari($id);

        return redirect()->to(base_url('/inventary'));
    }

    public function exportCSV($search = '')
    {
        $searchData = $this->request->getGet();

        // Get News Data

        $model = new InventariModel();

        if ($search == '') {
            $paginateData = $model->getAllPaged()->findAll();
        } else {
            $paginateData = $model->getByTitleOrText($search)->findAll();
        }


        $propiedades = [

            'id', 'nom', 'preu', 'data_compra', 'id_tipus', 'tipus'
        ];

        $csv_string = "";

        $csv_string .= implode(";", $propiedades) . "\n";

        foreach ($paginateData as $ticket) {
            $csv_string .= implode(";", $ticket) . "\n";
        }

        header('Content-Disposition: attachment; filename="inventary_export_' . date("d-m-Y") . '.csv"');

        echo $csv_string;
    }

    // public function exportXLS($search = '')
    // {
    //     $searchData = $this->request->getGet();



    //     // Get News Data

    //     $model = new InventariModel();

    //     if ($search == '') {
    //         $paginateData = $model->getAllPaged()->findAll();
    //         // dd($paginateData);


    //     } else {
    //         $paginateData = $model->getByTitleOrText($search)->findAll();
    //     }

    //     header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    //     $xls_string = "";

    //     foreach ($paginateData as $ticket) {
    //         $xls_string .= implode("\t", $ticket) . "\n";
    //         // d($xls_string);
    //     }
    //     // dd('fin');

    //     if ($search != '') {
    //         header('Content-Disposition: attachment; filename="' . date("d-m-Y") . '_filter-' . $search . '.xls"');
    //     } else {
    //         header('Content-Disposition: attachment; filename="' . date("d-m-Y") . '.xls"');
    //     }

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

                    $model = new InventariModel();



                    $fake = Factory::create("es_ES");


                    $id = $fake->uuid();
                    $nom = trim($row[0]);
                    $data_compra = trim($row[2]);
                    $preu = trim($row[1]);
                    $codi_centre = session('user')['code'];
                    $id_tipus_inventari = trim($row[3]);
        
                    $model->addInventari(
                        $id,
                        $nom,
                        $data_compra,
                        $preu,
                        $codi_centre,
                        $id_tipus_inventari
                    );
                }

                $firstLine = false;
            }

            fclose($fileCsv);

            return redirect()->to(base_url('/inventary'));
        }
    }

    public function downloadCSV()
    {
        // Establecer la ruta del archivo
        $rutaArchivo = WRITEPATH . 'plantillas' . DIRECTORY_SEPARATOR . 'plantilla_inventari.csv';


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
        header('Content-Disposition: attachment; filename="plantilla_inventari.csv"');
        header('Content-Length: ' . $tamañoArchivo);
        header('Content-Type: ' . $tipoContenido);

        // Leer el contenido del archivo y enviarlo al navegador
        readfile($rutaArchivo);
    }
}
