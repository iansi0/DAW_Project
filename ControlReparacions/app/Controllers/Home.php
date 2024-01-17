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
        return view('ticket.php');
    }
}
