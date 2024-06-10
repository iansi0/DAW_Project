<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LocationsController extends BaseController
{
    public function locations()
    {
        return view('locations/locations');
    }
}
