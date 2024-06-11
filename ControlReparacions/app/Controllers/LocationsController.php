<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ComarcaModel;
use App\Models\PoblacioModel;

class LocationsController extends BaseController
{
    public function locations($filter = 'comarca')
    {
        $searchData = $this->request->getGet();

        if (isset($searchData) && isset($searchData['q'])) {
            $search = $searchData["q"];
        } else {
            $search = "";
        }

        $table = new \CodeIgniter\View\Table();

        $template = [
            'table_open'  => "<table class='w-full rounded-t-2xl overflow-hidden border-b shadow-xl border-primario'>",

            'thead_open'  => "<thead class='bg-primario text-secundario'>",

            'heading_cell_start' => "<th class='py-6 text-base'>",

            'row_start' => "<tr class='border-b-[0.01px] py-5 '>",
            'row_alt_start' => "<tr class='border-b-[0.01px]  bg-[#F7F4EF] py-5 '>",


        ];
        $table->setTemplate($template);


        // Get News Data
        if ($filter == 'comarca') {
            $model = new ComarcaModel();


            if ($search == '') {
                $paginateData = $model->getAllPaged()->paginate(8);
            } else {
                $paginateData = $model->getByTitleOrText($search)->paginate(8);
            }

            $data = [
                'locations' => $paginateData,
                'search' => $search,
                'pager' => $model->pager,
                'table' => $table,
                'filter' => $filter,
            ];

            $table->setHeading(
                mb_strtoupper(lang('titles.id'), 'utf-8'),
                mb_strtoupper(lang('titles.name'), 'utf-8'),
                mb_strtoupper(lang('titles.actions'), 'utf-8'),
            );

            foreach ($data['locations'] as $location) {

                $buttonUpdate = base_url("locations/modify/comarca/" . $location['codi']);
                $buttonDelete = base_url("locations/delete/comarca/" . $location['codi']);
                $table->addRow(
                    $location['codi'],
                
                    [
                        "data" =>$location['nom'],
                         "class" => " p-3 h-16"
                    ],

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
                                    showConfirmButton: false,
                                    timer:2000,
                                });
                            }
                        }); })()' class='p-2 btn btn-primary'><i class='fa-solid p-3 cursor-pointer text-xl text-terciario-1 hover:bg-red-800 hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-trash'></i></a>",

                        "class" => " p-5 h-16"
                    ],
                );
            }
        } else {
            $model = new PoblacioModel();


            if ($search == '') {
                $paginateData = $model->getAllPaged()->paginate(8);
            } else {
                $paginateData = $model->getByTitleOrText($search)->paginate(8);
            }

            $data = [
                'locations' => $paginateData,
                'search' => $search,
                'pager' => $model->pager,
                'table' => $table,
                'filter' => $filter,
            ];

            $table->setHeading(
                mb_strtoupper(lang('titles.id'), 'utf-8'),
                mb_strtoupper(lang('titles.name'), 'utf-8'),
                mb_strtoupper(lang('titles.comarca'), 'utf-8'),
                mb_strtoupper(lang('titles.actions'), 'utf-8'),
            );

            foreach ($data['locations'] as $location) {

                $buttonUpdate = base_url("locations/modify/poblacio/" . $location['id']);
                $buttonDelete = base_url("locations/delete/poblacio/" . $location['id']);
                $table->addRow(
                    $location['id'],
                    [
                        "data" =>$location['nom'],
                         "class" => " p-3 h-16"
                    ],                    
                    $location['comarca'],
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
                                    showConfirmButton: false,
                                    timer:2000,
                                });
                            }
                        }); })()' class='p-2 btn btn-primary'><i class='fa-solid p-3 cursor-pointer text-xl text-terciario-1 hover:bg-red-800 hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-trash'></i></a>",

                        "class" => " p-5 h-16"
                    ],
                );
            }
        }

        return view('locations/locations', $data);
    }

    
    public function comarcaForm()
    {

        helper('form');

        return view('locations/comarcaForm');
    }


    public function poblacioForm()
    {

        helper('form');

        $model = new ComarcaModel();

        $data = [
            'comarcas' => $model->getAllPaged()->findAll(),
        ];

        return view('locations/poblacioForm', $data);
    }


    public function addComarca()
    {

        helper('form');

        $validationRules =
            [
                'code' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
            ];

        if ($this->validate($validationRules)) {

            $model = new ComarcaModel();

            $codi =  $this->request->getPost("code");
            $nom =  $this->request->getPost("name");

            $model->addComarca($codi, $nom, session('user')['code']);

            return redirect()->to(base_url('locations/filterComarca'));
        }
        return redirect()->back()->withInput();
    }


    public function addPoblacio()
    {

        helper('form');

        $validationRules =
            [
                'code' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
                'population' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
            ];

        if ($this->validate($validationRules)) {

            $model = new PoblacioModel();
            
            $codi =  $this->request->getPost("code");
            $nom =  $this->request->getPost("name");
            $comarca =  $this->request->getPost("population");

            $model->addPoblacio($codi, $nom, $comarca, session('user')['code']);

            return redirect()->to(base_url('locations/filterPoblacio'));
        }
        return redirect()->back()->withInput();
    }


    public function modifyComarca($id){
        helper('form');

        $model = new ComarcaModel();

        $data = [
            "info" => $model->getByTitleOrText($id)->find()
        ];

        return view('locations/modifyComarca', $data);
    }

    public function modifyComarca_post($id){

        helper('form');

        $validationRules =
            [
                'name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
            ];

        if ($this->validate($validationRules)) {

            $model = new ComarcaModel();

            $model->modifyComarca($id, $this->request->getPost('name'));

        }

    }

    public function deleteComarca($id){

        $model = new ComarcaModel();

        $model->deleteComarca($id);

    }


    public function modifyPoblacio($id){
        helper('form');

        $model = new PoblacioModel();

        $data = [
            "info" => $model->getByTitleOrText($id)->find()
        ];

        return view('locations/modifyPoblacio', $data);
    }

    public function modifyPoblacio_post($id){

        helper('form');

        $validationRules =
            [
                'name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('error.empty_slot_2'),
                    ],
                ],
            ];

        if ($this->validate($validationRules)) {

            $model = new PoblacioModel();

            $model->modifyPoblacio($id, $this->request->getPost('name'));

        }

    }

    public function deletePoblacio($id){

        $model = new PoblacioModel();

        $model->deletePoblacio($id);

    }

}
