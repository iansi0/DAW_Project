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

        if ($email == "admin@gmail.com") {

            $session = \Config\Services::session();

            //Crear sesion
            $newdata = [
                'username' => 'admin',
                'email' => $email,
                'logged_in' => true,
            ];

            $session->set($newdata);

            //Redirect a tickets
            return redirect()->to(base_url("tickets"));
        }

        //Si no existen o no son correctos devolvemos a login con un mensaje de error

        //Cambiar error a sesion de 1 solo uso
        $data["error"] = "EMAIL O CONTRASENYA INCORRECTE";
        return view("login.php", $data);
    }

    public function tickets(): string
    {
        /*
        //Comprovar si tenemos un filtro de busqueda
        $searchData = $this->request->getGet();

        if (isset($searchData) && isset($searchData['q'])) {
            $search = $searchData["q"];
        } else {
            $search = "";
        }


        //Recuperar los datos a mostrar en la tabla de la BBDD
        $model = new TicketsModel();

        //Paginacion con filtro
        if ($search == '') {
            $paginateData = $model->getAllPaged(5);
        } else {
            $paginateData = $model->getByTitleOrText($search)->paginate(5);
        }

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
