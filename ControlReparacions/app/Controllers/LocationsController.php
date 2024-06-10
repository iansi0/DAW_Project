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

            'row_start' => "<tr class='border-b-[0.01px] '>",
            'row_alt_start' => "<tr class='border-b-[0.01px]  bg-[#F7F4EF]'>",


        ];
        $table->setTemplate($template);


        // Get News Data
        if ($filter == 'comarca') {
            $model = new ComarcaModel();

           
            if ($search == '') {
                $paginateData = $model->getAllPaged();
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

                $buttonUpdate = base_url("location/modify/" . $location['codi']);
                $buttonView = base_url("location/" . $location['codi']);
                $table->addRow(                    
                    $location['codi'],
                    $location['nom'],    
                    [
                        "data" =>
                        "<a href='$buttonView' style='view-transition-name: info" . $location['codi'] . ";' class=' p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-primario hover:text-secundario rounded-xl hover:rounded-xl transition-all ease-out duration-250 hover:transition hover:ease-in hover:duration-250 fa-eye'></i></a>
                        ",
    
                        "class" => "p-2 h-16 justify-between items-center"
                    ],
    
                );
            }

        }else{
            $model = new PoblacioModel();

            
            if ($search == '') {
                $paginateData = $model->getAllPaged();
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

                $buttonUpdate = base_url("location/modify/" . $location['id']);
                $buttonView = base_url("location/" . $location['id']);
                $table->addRow(                    
                    $location['id'],
                    $location['nom'],   
                    $location['comarca'],  
                    [
                        "data" =>
                        "<a href='$buttonView' style='view-transition-name: info" . $location['id'] . ";' class=' p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-primario hover:text-secundario rounded-xl hover:rounded-xl transition-all ease-out duration-250 hover:transition hover:ease-in hover:duration-250 fa-eye'></i></a>
                        ",
    
                        "class" => "p-2 h-16 justify-between items-center"
                    ],
    
                );
            }
        }

        return view('locations/locations', $data);
    }
}
