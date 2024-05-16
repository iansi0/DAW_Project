<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EstatModel;
use App\Models\IntervencioModel;
use App\Models\TiquetModel;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;

class PDFController extends BaseController
{
    public function index($id)
    {
        if ($id == null) {
            return redirect()->to(base_url('/tickets'));
        }

        $modelTickets = new TiquetModel();
        $modelInterventions = new IntervencioModel();
        $estat = new EstatModel();

        /** TABLE GENERATOR **/
        $table = new \CodeIgniter\View\Table();
        $table->setHeading(
            mb_strtoupper(lang('forms.date'), 'utf-8'),
            mb_strtoupper(lang('titles.students'), 'utf-8'),
            mb_strtoupper(lang('titles.material_2'), 'utf-8'),
            mb_strtoupper(lang('forms.description'), 'utf-8')
        );

        $template = [
            'table_open'  => "<table class='w-full'>",

            'thead_open'  => "<thead class='bg-primario text-secundario'>",

            'heading_cell_start' => "<th class='py-3 text-base'>",

            'row_start' => "<tr class='border-b-[0.01px] '>",
            'row_alt_start' => "<tr class='border-b-[0.01px]  bg-terciario-2'>",


        ];
        $table->setTemplate($template);

        $data = [
            'ticket' => $modelTickets->viewTicket($id),
            'interventions' => $modelInterventions->getInterventions($id),
            'pager' => $modelInterventions->pager,
            'table' => $table,
            'estats' => $estat->getAllStates(),
        ];

        foreach ($data['interventions'] as $intervencio) {
            $buttonView = base_url("tickets/" . $intervencio['id']); // Reemplazar con tu ruta real

            $table->addRow(
                $intervencio['created_at'],
                $intervencio['correu_alumne'],
                $intervencio['id_tipus'],

                ['data' => $intervencio['descripcio'], 'class' => $intervencio['id_tipus'] == 2 ? 'bg-red-500 text-segundario' : 'bg-segundario']
            );
        }        $dompdf = new Dompdf();
        
        $html = view('pdfTicket',$data); 
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream("ticket_".$id.".pdf", array("Attachment" => true));
        
    }
}
