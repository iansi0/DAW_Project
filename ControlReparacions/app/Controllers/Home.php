<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('login.php');
    }

    public function tickets(): string
    {
        return view('ticket.php');
    }
}
