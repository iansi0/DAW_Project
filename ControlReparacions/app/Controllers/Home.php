<?php

namespace App\Controllers;


class Home extends BaseController
{
    public function index(): string
    {
        return view('login.php');
    }

    public function login()
    {
        //Guardamos los datos que nos han llegado por post en variables
        $request = request();

        $email = $request->getPost('email');

        $password = $request->getPost('password');

        //Comprobar si los datos existen en la bbdd y son correctos

        //si son correctos creamos una session y redirigimos a tickets

        if ($email == "hola@gmail.com") {

            $session = \Config\Services::session();

            $newdata = [
                'username' => 'johndoe',
                'email' => $email,
                'logged_in' => true,
            ];

            $session->set($newdata);

            return redirect("tickets");
        }

        //Si no existen o no son correctos devolvemos a login con un mensaje de error
        $data["error"] = "Email o contraseña incorrectos";
        return view("login.php", $data);
    }

    public function tickets(): string
    {
        //Recuperar los datos a mostrar en la tabla de la BBDD

        //Paginacion con filtro

        //Crear tabla con los datos
        $table = new \CodeIgniter\View\Table();
        $table->setHeading('ID', 'Title', 'Text');

        $template = [
            'table_open' => "<table class='table table-hover' style='border-collapse: collapse;'>"
        ];
        $table->setTemplate($template);
        /*************** TABLE GENERATOR ********************/

        /* Tabla
        $data = [
            'page_title' => 'CI4 Pager & search filter',
            'title' => 'Llistat paginat',
            'news' => $paginateData,
            'pager' => $model->pager,
            'search' => $search,
            'table' => $table,
        ];
        */

        //Ir a tickets con la tabla
        return view('ticket.php');
    }
}
