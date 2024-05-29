<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EstatModel;
use App\Models\IntervencioModel;
use App\Models\TiquetModel;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

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

            'table_open'  => "<table style='width: 100%;border-collapse: collapse; padding: 2px;'>",

            'thead_open'  => "<thead style='background-color: #003049; color: #F2F2F2'>",

            'heading_cell_start' => "<th style='padding: 8px;padding-top: 14px;'>",

            'row_start' => "<tr style='border-bottom: 1px solid #DDDDDD'>",
            'row_alt_start' => "<tr style='border-bottom: 1px solid #DDDDDD; background-color: #B3B3B3'>"
            
        ];
        $table->setTemplate($template);

        $writer = new Writer(
            new ImageRenderer(
                new RendererStyle(400),
                new SvgImageBackEnd()
            )
        );

        $data = [
            'ticket' => $modelTickets->viewTicket($id),
            'interventions' => $modelInterventions->getInterventions($id),
            'pager' => $modelInterventions->pager,
            'table' => $table,
            'estats' => $estat->getAllStates(),
            'qr' => base64_encode($writer->writeString(base_url()."tickets/".$id)),
        ];

        foreach ($data['interventions'] as $intervencio) {
            // $buttonView = base_url("tickets/" . $intervencio['id']); // Reemplazar con tu ruta real

            $table->addRow(
                $intervencio['created_at'],
                $intervencio['correu_alumne'],
                $intervencio['id_tipus'],
                $intervencio['descripcio']
            );

        }
        
        $dompdf = new Dompdf();
        
        $html = view('pdfTicket',$data); 
        $dompdf->loadHtml($html);
        $dompdf->render();
        // Attachment == true -> descargar PDF || Attachment == false -> visualizar en navegador
        $dompdf->stream("ticket_".$id.".pdf", array("Attachment" => false));
        
    }
}
