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

    public function assignar(): string
    {
        return view('assignar.php');
    }

    public function alumnos() : string
    {
        return view('alumnos.php');
    }
}
