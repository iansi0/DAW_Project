<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CentreModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TiquetModel;

class AssignController extends BaseController
{
    public function assign($filter = "sender")
    {

        $modelTickets = new TiquetModel();

        $table = new \CodeIgniter\View\Table();
        $table->setHeading(
            ["data" => "
                <div class='inline-flex items-center'>
                <label class='relative flex items-center p-3 rounded-lg cursor-pointer' htmlFor='all'>
                    <input type='checkbox'
                    class='table-checkbox before:content[``] peer relative h-8 w-8 cursor-pointer appearance-none rounded-lg border border-gray-900/20 bg-secundario transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-secundario checked:bg-primario checked:before:bg-secundario hover:scale-105 hover:before:opacity-0'
                    id='all'  />    
                    <span
                    class='absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100'>
                    <svg xmlns='http://www.w3.org/2000/svg' class='h-3.5 w-3.5' viewBox='0 0 20 20' fill='currentColor'
                        stroke='currentColor' stroke-width='1'>
                        <path fill-rule='evenodd'
                        d='M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z'
                        clip-rule='evenodd'></path>
                    </svg>
                    </span>
                </label>
                </div>
                ", 
                "class" => "p-2 "],
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
            'table_open'  => "<table class='w-full rounded-t-2xl overflow-hidden border-b shadow-xl border-primario'>",

            'thead_open'  => "<thead class='bg-primario text-secundario'>",

            'heading_cell_start' => "<th class='py-3 text-base'>",

            'row_start' => "<tr class='border-b-[0.01px] '>",
            'row_alt_start' => "<tr class='border-b-[0.01px]  bg-[#F7F4EF]'>",


        ];
        $table->setTemplate($template);

        $data = [
            'tickets' => $modelTickets->getInstituteTickets("0", $filter)->paginate(20),
            'pager' => $modelTickets->pager,
            'table' => $table,
            'filter' => $filter,
        ];
        $insModel = new CentreModel();

        if ($filter == 'sender') {
            $data['institutes']=$insModel->getAllCenter();

        }else{
            $data['institutes']=$insModel->getAllRepairCenters();

        }

        foreach ($data['tickets'] as $ticket) {

            $buttonUpdate = base_url("tickets/modify/" . $ticket['id']);
            $buttonView = base_url("tickets/" . $ticket['id']);
            $table->addRow(
                // ["data" => "<input type='checkbox' class='subCheckbox accent-primario' id='".$ticket['id']."'>", "class" => "p-2 "],
                ["data" => "
                <div class='inline-flex items-center'>
                <label class='relative flex items-center p-3 rounded-lg cursor-pointer' htmlFor='".$ticket['id']."'>
                    <input type='checkbox'
                    class='subCheckbox before:content[``] peer relative h-8 w-8 cursor-pointer appearance-none rounded-lg border border-gray-900/20 bg-gray-900/10 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-primario checked:bg-primario checked:before:bg-primario hover:scale-105 hover:before:opacity-0'
                    id='".$ticket['id']."'  />
                    <span
                    class='absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100'>
                    <svg xmlns='http://www.w3.org/2000/svg' class='h-3.5 w-3.5' viewBox='0 0 20 20' fill='currentColor'
                        stroke='currentColor' stroke-width='1'>
                        <path fill-rule='evenodd'
                        d='M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z'
                        clip-rule='evenodd'></path>
                    </svg>
                    </span>
                </label>
                </div>
                ", 
                "class" => "p-2 "],
                
                explode("-", $ticket['id'])[4],
                $ticket['tipus'],
                ["data" =>  $ticket['descripcio'], "class" => " max-w-10 min-w-auto whitespace-nowrap overflow-hidden text-ellipsis"],
                ($ticket['emissor'] != lang('titles.toassign')) ? $ticket['emissor'] : lang('titles.toassign') . ' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',
                ($ticket['receptor'] != lang('titles.toassign')) ? $ticket['receptor'] : lang('titles.toassign') . ' <i class="fa-solid fa-circle-exclamation text-xl text-red-600" ></i>',

                date("d/m/Y", strtotime($ticket['created'])),
                date("H:i", strtotime($ticket['created'])),

                ["data" => "<a class='flex p-3 justify-center  whitespace-nowrap w-full estat_" . $ticket['id_estat'] . "'>" . $ticket['estat'] . "</a>", "class" => "p-2 "],

                [
                    "data" =>
                    "<a href='$buttonView' style='view-transition-name: info" . $ticket['id'] . ";' class=' p-2 btn btn-primary'><i class='fa-solid p-3 text-xl text-terciario-1 hover:bg-primario hover:text-secundario rounded-xl hover:rounded-xl transition-all ease-out duration-250 hover:transition hover:ease-in hover:duration-250 fa-eye'></i></a>
                    ",

                    "class" => "p-3 h-16 justify-between items-center"
                ],

            );
        }

        return view('assign', $data);
    }
    public function assign_post($filter = "sender"){

        $ids = $this->request->getPost('ids');
        $institute = $this->request->getPost('ins');
        $institute = explode("(",(string) $institute);
        $institute = explode(")",$institute[1]);
        $code = $institute[0];
        $ticketModel = new TiquetModel();

        // Forzamos el json_decode
        $ids = json_decode((string) $ids);

        if ($filter == "sender") {
            $data = [
                "codi_centre_emissor" => $code,
            ];
            foreach ($ids as $id) {
                $ticketModel->modifyInstitute($id,$data);
            }
        }else{
            $data = [
                "codi_centre_reparador" => $code,
            ];
            foreach ($ids as $id) {
                $ticketModel->modifyInstitute($id,$data);
            }
        }


        return redirect()->back();
    }
}
