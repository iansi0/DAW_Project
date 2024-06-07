<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CentreModel;
use App\Models\TiquetModel;
use CodeIgniter\HTTP\ResponseInterface;

class StatisticsController extends BaseController
{
    public function index()
    {
        if ((session()->get('user')['role']=="sstt") || (session()->get('user')['role']=="admin")) {

            $ssttCode = session()->get('user')['code'];
            // Mirem comarques amb més tiquets
            $centremodel= new CentreModel();
            $comarcaTotal=$centremodel->getRegionWithMostTickets($ssttCode);
            
            $comarcaName=[];
            $comarcaCount=[];
            foreach ($comarcaTotal as $comarca) {
                array_push($comarcaName,$comarca['name']);
                array_push($comarcaCount,intval($comarca['count']));
            }
            $comarcaTotal=['name' => $comarcaName,'count' => $comarcaCount];
            
            // Aqui mirem quin mes hi ha més tiquets
            $tiquetmodel = new TiquetModel();
            $allTiquetsMonthly = $tiquetmodel->getTicketsByMonths();
            $allTiquetsCounts=[];
            $months=[];
            for ($i=0; $i <= 11 ; $i++) { 
                array_push($allTiquetsCounts,0);
                array_push($months,lang('months.'.($i)));
            }
            foreach ($allTiquetsMonthly as $tiquet) {
                $allTiquetsCounts[$tiquet['month']-1]=$tiquet['count'];
            }
            $allTiquetsMonthly=['month' => $months,'count' => $allTiquetsCounts];

            $allTiquetsType = $tiquetmodel->getTicketsByType();

            $typeName=[];
            $typeCount=[];
            foreach ($allTiquetsType as $type) {
                array_push($typeName,$type['tipus']);
                array_push($typeCount,intval($type['count']));
            }
            
            $allTiquetsType=['type' => $typeName,'count' => $typeCount];


            // data per passar tot
            $data = [
                'comarca' => $comarcaTotal,
                'date' => $allTiquetsMonthly,
                'type' => $allTiquetsType,
            ];            
            // return a la vista amb les dades
            return view('statistics',$data);
            
        }else{
            return redirect()->back()->withInput();
        }
    }
}
