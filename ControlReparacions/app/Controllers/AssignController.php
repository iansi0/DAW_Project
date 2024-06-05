<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TiquetModel;

class AssignController extends BaseController
{
    public function assign($id = null, $filter = "sender")
    {

        $modelTickets = new TiquetModel();

        $table = new \CodeIgniter\View\Table();
        $table->setHeading(
            "<input type='checkbox' class='table-checkbox' id='all'>",
            mb_strtoupper(lang('titles.id'), 'utf-8'),
            mb_strtoupper(lang('titles.device'), 'utf-8'),
            mb_strtoupper(lang('titles.description'), 'utf-8'),
            mb_strtoupper(lang('titles.sender'), 'utf-8'),
            mb_strtoupper(lang('titles.receiver'), 'utf-8'),
            mb_strtoupper(lang('titles.date'), 'utf-8'),
            mb_strtoupper(lang('titles.hour'), 'utf-8'),
            mb_strtoupper(lang('titles.status'), 'utf-8'),
            mb_strtoupper(lang('titles.actions'), 'utf-8'),
        );

        // TEMPLATE
        $template = [
            'table_open'  => "<table class='w-full'>",

            'thead_open'  => "<thead class='bg-primario text-secundario'>",

            'heading_cell_start' => "<th class='py-3 text-base'>",

            'row_start' => "<tr class='border-b-[0.01px] '>",
            'row_alt_start' => "<tr class='border-b-[0.01px]  bg-terciario-2'>",


        ];
        $table->setTemplate($template);

        $data = [
            'tickets' => $modelTickets->getInstituteTickets($id, $filter)->paginate(20),
            'pager' => $modelTickets->pager,
            'table' => $table,
            'filter' => $filter,
        ];


        foreach ($data['tickets'] as $ticket) {

            $buttonDelete = base_url("tickets/delete/" . $ticket['id']);
            $buttonUpdate = base_url("tickets/modify/" . $ticket['id']);
            $buttonView = base_url("tickets/" . $ticket['id']);
            $table->addRow(
                // ["data" => $ticket['id'],"class"=>'p-5'],
                explode("-", $ticket['id'])[4],
                $ticket['tipus'],
                ["data" =>  $ticket['descripcio'], "class" => " max-w-10 min-w-auto whitespace-nowrap overflow-hidden text-ellipsis"],
                $ticket['emissor'],
                ($ticket['receptor'] != lang('titles.toassign')) ? $ticket['receptor'] : lang('titles.toassign') . ' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',

                date("d/m/Y", strtotime($ticket['created'])),
                date("H:i", strtotime($ticket['created'])),

                ["data" => "<a class='flex p-3 justify-center  whitespace-nowrap w-full estat_" . $ticket['id_estat'] . "'>" . $ticket['estat'] . "</a>", "class" => "p-2 "],

                [
                    "data" =>
                    "<a href='$buttonView' style='view-transition-name: info" . $ticket['id'] . ";' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-primario hover:text-secundario rounded-xl hover:rounded-xl transition-all ease-out duration-250 hover:transition hover:ease-in hover:duration-250 fa-eye'></i></a>
                     <a href='$buttonUpdate' class='p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-orange-600 hover:text-secundario hover:rounded-xl transition-all ease-out duration-250  rounded-xl hover:transition hover:ease-in hover:duration-250 fa-pencil'></i></a>
                    ",

                    "class" => " p-5 flex h-16 justify-between items-center"
                ],

            );
        }

        return view('assign', $data);
    }
    
}
