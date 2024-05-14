<?php

namespace App\Controllers;

use App\Models\CentreModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class InstitutesController extends BaseController
{
    public function institutes()
    {
        //Crear una tabla con todos los tickets

        $searchData = $this->request->getGet();

        if (isset($searchData) && isset($searchData['q'])) {
            $search = $searchData["q"];
        } else {
            $search = "";
        }

        // Get News Data


        $model = new CentreModel();

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
            mb_strtoupper(lang('titles.name'), 'utf-8'),
            mb_strtoupper(lang('titles.name_contact'), 'utf-8'),
            mb_strtoupper(lang('titles.email_contact'), 'utf-8'),
            mb_strtoupper(lang('titles.active'), 'utf-8'),
            mb_strtoupper(lang('titles.workshop'), 'utf-8'),
            mb_strtoupper(lang('titles.population'), 'utf-8'),
            mb_strtoupper(lang('titles.number'), 'utf-8'),
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
            'institutes' => $paginateData,
            'pager' => $model->pager,
            'search' => $search,
            'table' => $table,
        ];

        // ROWS
        foreach ($data['institutes'] as $institute) {

            // $buttonDelete = base_url("tickets/delete/" . $institute['id']);
            // $buttonUpdate = base_url("tickets/modify/" . $institute['id']);
            // $buttonView = base_url("tickets/" . $institute['id']);
            $table->addRow(
                $institute['nom'],
                $institute['persona'],
                $institute['correu'],
                $institute['actiu'],
                $institute['taller'],
                $institute['poblacio'],
                $institute['telefon'],
                $institute['adreca'],
               

               

              

            );

            $count++;
        }

        return view('tickets/tickets', $data);
    }

    public function instituteForm()
    {
        return view('institutes/instituteForm');
    }

    public function assign()
    {
        return view('institutes/assign');
    }
}
