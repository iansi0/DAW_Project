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
            'qr' => base64_encode($writer->writeString(base_url() . "tickets/" . $id)),
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

        $html = view('pdfTicket', $data);
        $dompdf->loadHtml($html);
        $dompdf->render();
        // Attachment == true -> descargar PDF || Attachment == false -> visualizar en navegador
        // Comentar aixo per pujar a PLESK
        $dompdf->stream("ticket_" . $id . ".pdf", array("Attachment" => false));

        // Descomentar aixo per pujar a PLESK
        // $this->response->setHeader('Content-Type', 'application/pdf');
        // $this->response->setHeader('Content-Disposition', 'inline; filename="ticket_' . $id . '.pdf"');
        // $this->response->setBody($dompdf->output());
        // return $this->response;
    }

    public function tickets()
    {

        $searchData = $this->request->getGet();
        if (isset($searchData['q'])) {
            $search = $searchData["q"];
        } else {
            $search = "";
        }

        //  Obtener filtro de dispositivo (?d=)
        if (isset($searchData['d']) && !empty($searchData['d'])) {
            $filters['device'] = $searchData['d'];
        } else {
            $filters['device'] = '';
        }


        // Obtener filtro de centro (?c=)
        if (isset($searchData['c']) && !empty($searchData['c'])) {
            $filters['center'] = $searchData['c'];
        } else {
            $filters['center'] = '';
        }

        // Obtener filtro de fecha-inicio (?dt_1=)
        if (isset($searchData['dt_1']) && !empty($searchData['dt_1'])) {
            $filters['date_ini'] = $searchData['dt_1'];
        } else {
            $filters['date_ini'] = '1970-01-01';
        }

        // Obtener filtro de fecha-fin (?dt_2=)
        if (isset($searchData['dt_2']) && !empty($searchData['dt_2'])) {
            $filters['date_end'] = $searchData['dt_2'];
        } else {
            $filters['date_end'] = date('Y-m-d');
        }

        // Obtener filtro de tiempo-inicio (?tm_1=)
        if (isset($searchData['tm_1']) && !empty($searchData['tm_1'])) {
            $filters['time_ini'] = $searchData['tm_1'];
        } else {
            $filters['time_ini'] = '00:00';
        }

        // Obtener filtro de tiempo-inicio (?tm_2=)
        if (isset($searchData['tm_2']) && !empty($searchData['tm_2'])) {
            $filters['time_end'] = $searchData['tm_2'];
        } else {
            $filters['time_end'] = '23:59';
        }

        // Obtener filtro de estado (?e=)
        if (isset($searchData['e']) && !empty($searchData['e'])) {
            $filters['state'] = $searchData['e'];
        } else {
            $filters['state'] = '';
        }


        $model = new TiquetModel();

        if (is_array($filters) && !empty($filters)) {

            $paginateData = $model->getByTitleOrText($search, $filters)->findAll();
        } else if ($search != '') {
            $paginateData = $model->getByTitleOrText($search, [])->findAll();
        } else {
            $paginateData = $model->getAllPaged()->findAll();
        }

        $writer = new Writer(
            new ImageRenderer(
                new RendererStyle(400),
                new SvgImageBackEnd()
            )
        );

        /** TABLE GENERATOR **/
        $table = new \CodeIgniter\View\Table();

        // HEADER
        $table->setHeading(
            mb_strtoupper(lang('titles.id'), 'utf-8'),
            mb_strtoupper(lang('titles.device'), 'utf-8'),
            mb_strtoupper(lang('titles.description'), 'utf-8'),
            mb_strtoupper(lang('titles.sender'), 'utf-8'),
            mb_strtoupper(lang('titles.receiver'), 'utf-8'),
            mb_strtoupper(lang('titles.date'), 'utf-8'),
            mb_strtoupper(lang('titles.hour'), 'utf-8'),
            mb_strtoupper(lang('titles.status'), 'utf-8'),
            mb_strtoupper(lang('titles.qr'), 'utf-8'),
        );

        // TEMPLATE
        $template = [
            'table_open'  => "<table cellspacing='0' style='width: 100%; border-radius: 1.5rem 1.5rem 0 0; overflow: hidden; '>",

            'thead_open'  => "<thead style='background-color: #003049; color: #F2F2F2;'>",

            'heading_cell_start' => "<th style='padding-top: 1rem; padding-bottom: 1rem; font-size: 1rem;'>",

            'row_start' => "<tr style=' background-color: white !important;'>",
            'row_alt_start' => "<tr style=' background-color: #F7F4EF ; '>",
        ];
        $table->setTemplate($template);

        $data = [
            'tickets' => $paginateData,
            'table' => $table,
        ];

   

        // ROWS
        $count = 0;
        foreach ($data['tickets'] as $ticket) {



            $table->addRow(
                // ["data" => $ticket['id'],"class"=>'p-5'],
                $ticket['id'],
                $ticket['tipus'],
                ["data" =>  $ticket['descripcio'], "style" => "max-width: 10rem; min-width: auto; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"],
                ($ticket['emissor'] != lang('titles.toassign')) ? $ticket['emissor'] : lang('titles.toassign') . " <i style='font-family: Font Awesome 5 Solid; content: '\f06a'; font-size: 1.25rem; color: #e53e3e; ' ></i>",
                ($ticket['receptor'] != lang('titles.toassign')) ? $ticket['receptor'] : lang('titles.toassign') . " <i style='font-family: Font Awesome 5 Solid; content: '\f06a'; font-size: 1.25rem; color: #e53e3e; ' ></i>",

                date("d/m/Y", strtotime($ticket['created'])),
                date("H:i", strtotime($ticket['created'])),

                [
                    "data" => "<a style='display: flex; padding: 1rem; border-radius: 10px;justify-content: center; white-space: nowrap; background-color: var(--estat-" . $ticket['id_estat'] . "); color: var(--text-color-" . $ticket['id_estat'] . ");'>" . $ticket['estat'] . "</a>",
                    "style" => "padding: 0.5rem "
                ],

                [
                    "data" => "<img style='width: 150px;' src='data:image/png;base64, " . base64_encode( $writer->writeString(base_url() . 'tickets/' . $ticket['id'])) ."'",
                    "style" => "padding: 0.5rem "
                ],

            );


            $count++;
        }

        $dompdf = new Dompdf();

        $html = view('ticketsPDF', $data);
        // dd("HOLA");
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->loadHtml($html);
        $dompdf->render();
        // Attachment == true -> descargar PDF || Attachment == false -> visualizar en navegador
        // Comentar aixo per pujar a PLESK
        $actual = date('d-m-Y');
        $dompdf->stream("etiquetes_" . $actual . ".pdf", array("Attachment" => false));

        // Descomentar aixo per pujar a PLESK
        // $this->response->setHeader('Content-Type', 'application/pdf');
        // $this->response->setHeader('Content-Disposition', 'inline; filename="ticket_' . $id . '.pdf"');
        // $this->response->setBody($dompdf->output());
        // return $this->response;
    }

    public function labels()
    {
        $searchData = $this->request->getGet();
        if (isset($searchData['q'])) {
            $search = $searchData["q"];
        } else {
            $search = "";
        }

        //  Obtener filtro de dispositivo (?d=)
        if (isset($searchData['d']) && !empty($searchData['d'])) {
            $filters['device'] = $searchData['d'];
        } else {
            $filters['device'] = '';
        }


        // Obtener filtro de centro (?c=)
        if (isset($searchData['c']) && !empty($searchData['c'])) {
            $filters['center'] = $searchData['c'];
        } else {
            $filters['center'] = '';
        }

        // Obtener filtro de fecha-inicio (?dt_1=)
        if (isset($searchData['dt_1']) && !empty($searchData['dt_1'])) {
            $filters['date_ini'] = $searchData['dt_1'];
        } else {
            $filters['date_ini'] = '1970-01-01';
        }

        // Obtener filtro de fecha-fin (?dt_2=)
        if (isset($searchData['dt_2']) && !empty($searchData['dt_2'])) {
            $filters['date_end'] = $searchData['dt_2'];
        } else {
            $filters['date_end'] = date('Y-m-d');
        }

        // Obtener filtro de tiempo-inicio (?tm_1=)
        if (isset($searchData['tm_1']) && !empty($searchData['tm_1'])) {
            $filters['time_ini'] = $searchData['tm_1'];
        } else {
            $filters['time_ini'] = '00:00';
        }

        // Obtener filtro de tiempo-inicio (?tm_2=)
        if (isset($searchData['tm_2']) && !empty($searchData['tm_2'])) {
            $filters['time_end'] = $searchData['tm_2'];
        } else {
            $filters['time_end'] = '23:59';
        }

        // Obtener filtro de estado (?e=)
        if (isset($searchData['e']) && !empty($searchData['e'])) {
            $filters['state'] = $searchData['e'];
        } else {
            $filters['state'] = '';
        }


        $model = new TiquetModel();

        if (is_array($filters) && !empty($filters)) {

            $paginateData = $model->getByTitleOrText($search, $filters)->findAll();
        } else if ($search != '') {
            $paginateData = $model->getByTitleOrText($search, [])->findAll();
        } else {
            $paginateData = $model->getAllPaged()->findAll();
        }


        $writer = new Writer(
            new ImageRenderer(
                new RendererStyle(400),
                new SvgImageBackEnd()
            )
        );

        // $tickets = [0]['id'];

        // 'id' => [], 
        // 'qr' => []

        $tickets = [];
        $id = [];
        $qr = [];
        foreach ($paginateData as $info) {
            // $tickets['id'][]=$info['id'];
            array_push($id, $info['id']);

            $qrString = base_url() . "tickets/" . $info['id'];
            $qrCode = $writer->writeString($qrString);
            $encodedQr = base64_encode($qrCode);
            array_push($qr, $encodedQr);
        }

        $tickets = ['id' => $id, 'qr' => $qr];
        // d($qr);


        $data = [
            'tickets' => $tickets,
        ];
        $dompdf = new Dompdf();

        $html = view('etiquetaTicket', $data);
        // dd("HOLA");
        $dompdf->loadHtml($html);
        $dompdf->render();
        // Attachment == true -> descargar PDF || Attachment == false -> visualizar en navegador
        // Comentar aixo per pujar a PLESK
        $actual = date('d-m-Y');
        $dompdf->stream("etiquetes_" . $actual . ".pdf", array("Attachment" => false));

        // Descomentar aixo per pujar a PLESK
        // $this->response->setHeader('Content-Type', 'application/pdf');
        // $this->response->setHeader('Content-Disposition', 'inline; filename="ticket_' . $id . '.pdf"');
        // $this->response->setBody($dompdf->output());
        // return $this->response;
    }
}
