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
        $client = new \Google\Client();
        //$client->setAuthConfig('/path/to/client_credentials.json');
        $client->setClientId('825266504668-5e4qgd9bko7jqtu7ubqobtc0mfs1c2mk .
        apps.googleusercontent.com'); //Define your ClientID
        $client->setClientSecret('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'); //Define your Client Secret Key

        $client->setRedirectUri('http://localhost:8080'); //Define your Redirect Uri
        // $client->addScope(\Google\Service\Drive::DRIVE_METADATA_READONLY);
        $client->addScope(\Google\Service\Oauth2::USERINFO_EMAIL);
        $client->addScope(\Google\Service\Oauth2::USERINFO_PROFILE);
        $client->addScope(\Google\Service\Oauth2::OPENID);
        // $client->addScope('profile');
        $client->setAccessType('offline');

        $data['titol'] = "GSuite login";
        // $client->addScope('email');

        if (isset($_GET["code"])) {

            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

            if (!isset($token["error"])) {
                $client->setAccessToken($token['access_token']);

              

                $oauth2 = new \Google\Service\Oauth2($client);

                $userInfo = $oauth2->userinfo->get();

                // Creamos un Modelo Usuario
                $model = new UsersModel();
                // Obtenemos el usuario por user o por mail
                $user = $model->getLoginByMail($userInfo->getEmail());

                // Si el user o mail no existe, devolvemos error
                if (!$user) {
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
                    "other"         => (count(explode(',', $user["other"])) > 0) ? explode(',', $user["other"]) : (($user["other"]) ? $user["other"] : ''),
                    "contact"       => (count(explode(',', $user["contact"])) > 0) ? explode(',', $user["contact"]) : '',
                    "type"          => $user["type"],
                    "lang"          => ($user["lang"]) ? $user["lang"] : 'esp',
                    "logged_data"   => date("Y-m-d H:i:s"),
                    "ip_user"       => $_SERVER['REMOTE_ADDR'],
                ];

                session()->set('access_token', $token['access_token']);
                session()->set("user", $sessionData);
            }
        }

        if (!session()->get('access_token')) {

            $data['client'] = $client->createAuthUrl();
            return view('login', $data);
        } else {
            return redirect()->to(base_url('tickets'));
        }
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
