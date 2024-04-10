<?php

namespace App\Controllers;

use App\Models\IntervencioModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class InterventionController extends BaseController
{
    public function intervention()
    {
        return view('intervention/intervention');
    }

    public function interventionForm()
    {
        return view('intervention/interventionForm');
    }
}
