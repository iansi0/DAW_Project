<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;

class PDFController extends BaseController
{
    public function index($route)
    {
        $dompdf = new Dompdf();
        $html = view('pdfTicket'); 
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream("ticket_".$route.".pdf", array("Attachment" => false));
        $dompdf->down
    }
}
