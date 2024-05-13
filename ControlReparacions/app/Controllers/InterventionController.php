<?php

namespace App\Controllers;

use App\Models\IntervencioModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;


use App\Models\InventariModel;

class InterventionController extends BaseController
{
    public function intervention()
    {
        return view('intervention/intervention');
    }

    public function interventionForm()
    {

        $inventary = new InventariModel();

        $data = [

            "inventary" => $inventary->getInventaryNoAssigned(),

        ];


        return view('intervention/interventionForm', $data);
    }
}
