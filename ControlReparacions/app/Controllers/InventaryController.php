<?php

namespace App\Controllers;

use App\Models\InventariModel;
use App\Models\TipusInventariModel;

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
                $product['data_compra'],
                $product['preu'],
                $product['nomInventary'],
                "
                <a href='$buttonUpdate' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-orange-600 hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-pencil'></i></a>
                <a href='$buttonDelete' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-red-800 hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-trash'></i></a>
                ",
            );

            $count++;
        }

        return view('inventary/inventary', $data);
    }

    public function inventaryForm()
    {

        $type = new TipusInventariModel();

        $data = [

            "types" => $type->getAllTypes(),
        ];

        return view('inventary/inventaryForm', $data);
    }

    public function addInventary()
    {

        $model = new InventariModel();
        $fake = Factory::create("es_ES");

        $id = $fake->uuid();
        $data_compra = date('Y-m-d');
        $nom = $this->request->getPost("name");
        $preu = $this->request->getPost("price");
        $codi_centre = session('user')['code'];
        $id_tipus_inventari = $this->request->getPost("type_inventary");

        $model->addInventari(
            $id,
            // $nom,
            $data_compra,
            $preu,
            $codi_centre,
            $id_tipus_inventari
        );

        return redirect()->to(base_url('inventary'));
    }

    public function modifyInventary($id)
    {
        $type = new TipusInventariModel();
        $inventary = new InventariModel();

        $data = [
            "types" => $type->getAllTypes(),
            "product" => $inventary->getInventarytById($id),
        ];
        return view('inventary/modifyInventary', $data);
    }

    // public function modifyInventary_post($id)
    // {

    //     $model = new TiquetModel();

    //     $data = [
    //         "id_tiquet" =>  $id,
    //         "descripcio_avaria" =>  $this->request->getPost("description"),
    //         "nom_persona_contacte_centre" => $this->request->getPost("nameContact"),
    //         "correu_persona_contacte_centre" =>  $this->request->getPost("emailContact"),
    //         "id_tipus_dispositiu" => $this->request->getPost("id_type"),
    //         "id_estat" => $this->request->getPost("id_state"),
    //         "codi_centre_emissor" => $this->request->getPost("sender"),
    //         "codi_centre_reparador" => $this->request->getPost("repair"),

    //     ];

    //     $model->modifyTicket($id, $data);

    //     return redirect()->to(base_url('/tickets'));
    // }

    public function deleteInventary($id)
    {

        $model = new InventariModel();

        $model->deleteTicket($id);

        return redirect()->to(base_url('/inventary'));
    }

    public function exportCSV($search = '')
    {
        $searchData = $this->request->getGet();

        // if ($search == '') {
        //     $paginateData = $model->getAllPaged(8);
        // } else {
        //     $paginateData = $model->getByTitleOrText($search)->paginate(8);
        // }

        // Get News Data

        $model = new InventariModel();

        if ($search == '') {
            $paginateData = $model->getAllPaged()->findAll();
        } else {
            $paginateData = $model->getByTitleOrText($search)->findAll();
        }

        $csv_string = "";

        foreach ($paginateData as $ticket) {
            $csv_string .= implode(",", $ticket) . "\n";
        }
        // dd($csv_string);
        if ($search != '') {
            header('Content-Disposition: attachment; filename="' . date("d-m-Y") . '_filter-' . $search . '.csv"');
        } else {
            header('Content-Disposition: attachment; filename="' . date("d-m-Y") . '.csv"');
        }


        echo $csv_string;
    }
    public function exportXLS($search = '')
    {
        $searchData = $this->request->getGet();



        // Get News Data

        $model = new InventariModel();

        if ($search == '') {
            $paginateData = $model->getAllPaged()->findAll();
            // dd($paginateData);


        } else {
            $paginateData = $model->getByTitleOrText($search)->findAll();
        }

        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        $xls_string = "";

        foreach ($paginateData as $ticket) {
            $xls_string .= implode("\t", $ticket) . "\n";
            // d($xls_string);
        }
        // dd('fin');

        if ($search != '') {
            header('Content-Disposition: attachment; filename="' . date("d-m-Y") . '_filter-' . $search . '.xls"');
        } else {
            header('Content-Disposition: attachment; filename="' . date("d-m-Y") . '.xls"');
        }

        echo $xls_string;
    }
}
