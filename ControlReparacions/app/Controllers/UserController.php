<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function config()
    {
        return view('user/user_config');
    }

    public function config_post()
    {
        //
    }
}
