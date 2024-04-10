<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Home extends BaseController
{
    //Common Functions
    public function login()
    {
        return view('login');
    }

    public function login_post()
    {
        if (!session()->has("user")) {
            helper("form"); // Helper nativo de CI4

            // Comprobamos las reglas de los input
            $rules = [
                'user' => 'required',
                'passwd' => 'required|min_length[4]'
            ];

            // Si no cumple, devolvemos error
            if (!$this->validate($rules)) {
                session()->setFlashdata('error', lang("error.login"));
                return redirect()->to(base_url('login'));
            }

            // Creamos un Modelo Usuario
            $model = new UsersModel();
            // Obtenemos el usuario por user o por mail
            $user = $model->getUserByMail($this->request->getVar('user'));

            // Si el user o mail no existe, devolvemos error
            if (!$user) {
                session()->setFlashdata('error', lang("error.login"));
                return redirect()->to(base_url('login'));
            }

            // Comprobamos la contraseña
            $verify = password_verify($this->request->getVar('passwd'), $user['password']);

            // Si la contraseña es incorrecta, devolvemos error
            if (!$verify) {
                session()->setFlashdata('error', lang("error.login"));
                return redirect()->to(base_url('login'));
            }

            if ($user["2fa_activated"]) { // Si tiene segundo factor, se lo pedimos

                session()->setFlashdata("userid", $user['id']);
                $data['user'] = $user['id'];

                return view('login_register/2fa_authenticator', $data);

            } else {  // Si no tiene segundo factor, lo iniciamos

                $model = new UsersModel();
                $isAdmin = $model->isAdmin($model->getUserRoles($user["id"]));

                $sessionData = [
                    "username"      => $user["username"],
                    "uid"           => $user["id"],
                    "email"         => $user["email"],
                    "phone"         => $user["phone"],
                    "name"          => $user["name"],
                    "surname1"      => $user["surname1"],
                    "surname2"      => $user["surname2"],
                    "complete_name" => $user["name"]." ".$user["surname1"]." ".$user["surname2"],
                    "2fa_activated" => $user["2fa_activated"],
                    "language"      => ($user["language"])?$user["language"]:'esp',
                    "logged_data"   => date("Y-m-d H:i:s"),
                    "isAdmin"       => $isAdmin
                ];

                session()->set("user", $sessionData);

                return redirect()->to(base_url('home'));

            }
        } else {
            return redirect()->to(base_url('/'));
        }
    }
    
}
