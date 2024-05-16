<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class StatisticsController extends BaseController
{
    public function index()
    {
        return view('statistics');
    }
}
