<?php

namespace App\Controllers;

use App\Models\InventariModel;
use App\Models\TipusInventariModel;

use App\Controllers\BaseController;

use App\Libraries\UUID as LibrariesUUID;


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
                    title: `".lang('alerts.sure')."`,
                    text: `".lang('alerts.sure_sub')."`,
                    icon: `warning`,
                    showCancelButton: true,
                    confirmButtonColor: `#3085d6`,
                    cancelButtonColor: `#d33`,
                    confirmButtonText: `".lang('alerts.yes_del')."`,
                    cancelButtonText: `".lang('alerts.cancel')."`,
                  }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `".$buttonDelete."`;

                        Swal.fire({
                            title: `".lang('alerts.deleted')."`,
                            text: `".lang('alerts.deleted_sub')."`,
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

        $arrInventory = $this->request->getPost('arrInventory');

        // Forzamos el json_decode
        $arrInventory = json_decode((string) $arrInventory);

        // Creamos un array que irá almacenando los inputs erróneos
        $arrErrors = [];

        // Hacemos un primer recorrido comprobando que los inputs están correctos
        foreach ($arrInventory as $inventory) {

            $id_inventory = $inventory[0]->id;
            $id_tipus_inventari = $inventory[1]->id_type;
            $nom_inventari = $inventory[2]->name;
            $preu_inventari =  $inventory[3]->price;

            if ($id_tipus_inventari == null || $id_tipus_inventari == '') {
                $arrErrors[$id_inventory]["id_type"] = lang('error.id_type');
            }
            if ($nom_inventari == null || $nom_inventari == '') {
                $arrErrors[$id_inventory]["name"] = lang('error.name');
            }
            if ($preu_inventari == null || $preu_inventari == '') {
                $arrErrors[$id_inventory]["price"] = lang('error.price');
            }

        }

        // Si detectamos errores, los mandamos de vuelta al front para ser corregidos
        // PD: el flash data no sera ejecutado y no solo eso, se le va a recargar la pagina al cliente borrándole todos los tiquets
        // PDD: Un cliente normal se quedaria en las validaciones de javascript
        if (count($arrErrors) > 0) {
            session()->setFlashdata('error', $arrErrors);
            return redirect()->back();
        }

        // Si todo esta bien, añadimos los tickets
        foreach ($arrInventory as $inventory) {

            // dd($inventory);

            $model = new InventariModel();

            $id = LibrariesUUID::v4();
            $id_tipus_inventari = $inventory[1]->id_type;
            $nom = $inventory[2]->name;
            $data_compra = date('Y-m-d');
            $preu = $inventory[3]->price;
            $codi_centre = session('user')['code'];

            $model->addInventari(
                $id,
                $nom,
                $data_compra,
                $preu,
                $codi_centre,
                $id_tipus_inventari
            );
        }

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

    public function modifyInventary_post($id)
    {

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

    public function deleteInventary($id)
    {

        $model = new InventariModel();

        $model->deleteInventari($id);

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
