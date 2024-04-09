<?php

namespace App\Controllers;

use App\Models\CentreModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class InstitutesController extends BaseController
{
    public function institutes()
    {
        return view('institutes/institute');
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
