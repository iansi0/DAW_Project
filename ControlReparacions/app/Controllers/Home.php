<?php

namespace App\Controllers;

use App\Models\TiquetModel;
use App\Models\UsersModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;

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
            // if (!$this->validate($rules)) {
            //     session()->setFlashdata('error', lang("error.login"));
            //     return redirect()->to(base_url('login'));
            // }

            // Creamos un Modelo Usuario
            $model = new UsersModel();
            // Obtenemos el usuario por user o por mail
            $user = $model->getLoginByMail($this->request->getVar('user'));

            // Si el user o mail no existe, devolvemos error
            if (!$user) {
                session()->setFlashdata('error', lang("error.login"));
                return redirect()->to(base_url('login'));
            }

            // Comprobamos la contraseña
            $verify = password_verify($this->request->getVar('password'), $user['passwd']);

            // Si la contraseña es incorrecta, devolvemos error
            if (!$verify) {
                session()->setFlashdata('error', lang("error.login"));
                return redirect()->to(base_url('login'));
            }

            // Obtenemos la información del usuario
            $user = $model->getUserById($user["id"]);            

            $sessionData = [
                "uid"           => $user["id"],
                "user"          => $user["user"],
                "code"          => $user["code"],
                "name"          => $user["name"],
                "adress"        => $user["adress"],
                "phone"         => $user["phone"],
                "other"         => (count(explode(',', $user["other"]))>0)?explode(',', $user["other"]):(($user["other"])?$user["other"]:''),
                "contact"       => (count(explode(',', $user["contact"]))>0)?explode(',', $user["contact"]):'',
                "type"          => $user["type"],
                "lang"          => ($user["lang"])?$user["lang"]:'esp',
                "logged_data"   => date("Y-m-d H:i:s"),
                "ip_user"       => $_SERVER['REMOTE_ADDR'],
            ];

            session()->set("user", $sessionData);

            return redirect()->to(base_url('tickets'));

        } else {
            return redirect()->to(base_url('/'));
        }

    }

    public function logout()
    {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to(base_url('/login'));
    }
}
