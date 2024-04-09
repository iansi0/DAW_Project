<?php

namespace App\Controllers;

use App\Models\TiquetModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;

use Faker\Factory;

class Home extends BaseController
{
    //Common Functions
    public function login()
    {
        return view('login');
    }
    
}
