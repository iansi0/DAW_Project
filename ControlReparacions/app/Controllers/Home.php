<?php

namespace App\Controllers;

use App\Models\CentreModel;
use App\Models\ProfessorModel;
use App\Models\TiquetModel;
use App\Models\UsersInRolesModel;
use App\Models\UsersModel;

use App\Libraries\UUID as LibrariesUUID;
use App\Models\RolesModel;

class Home extends BaseController
{
    //Common Functions
    public function login()
    {
        $client = new \Google\Client();
        //$client->setAuthConfig('/path/to/client_credentials.json');
        $client->setClientId('855574420320-b3icrgs1cfs8alm75o9shdhehndvfp20.apps.googleusercontent.com'); //Define your ClientID
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

                $dominio = explode( "@", $userInfo->getEmail());
            

                //si el domino no es xtex devolvemos error
                // if ($dominio[1] == 'gmail.com') {
                if ($dominio[1] == 'xtec.cat') {
                    $user = new UsersModel();
                    $mail=$userInfo->getEmail();
                    $fullname=$userInfo->getName();
                    $checkusername = $user->getLoginByMail($mail);
                    if ($checkusername==null) {
                        $institutes= new CentreModel();
                        $ins =$institutes->getAllCenter2();
                        session()->setFlashdata('mail', $mail);
                        session()->setFlashdata('fullname', $fullname);
                        $data =[
                            "institutes" => $ins,
                        ];
                        return view('assigninstitute', $data);

                    }
                }

                // Creamos un Modelo Usuario
                $model = new UsersModel();
                // Obtenemos el usuario por user o por mail
                $user = $model->getLoginByMail($userInfo->getEmail());

                // Si el user o mail no existe, devolvemos error
                if (!$user) {
                    session()->setFlashdata('error', lang("error.wrong_login"));
                    return redirect()->to(base_url('login'));
                }

                // Obtenemos la información del usuario
                $user = $model->getUserById($user["id"]);

                if ($user['code']==null && $user['role']=="prof") {
                    $institutes= new CentreModel();
                        $ins =$institutes->getAllCenter2();
                        session()->setFlashdata('mail', $user['user']);
                        $data =[
                            "institutes" => $ins,
                        ];
                        return view('assigninstitute', $data);
                }
                $userInRole = new UsersInRolesModel();
                // Generamos la sesión
             
                $sessionData = [
                    "uid"           => $user["id"],
                    "user"          => $user["user"],
                    "code"          => $user["code"],
                    "role"          => $userInRole->getRoleByUser($user["id"])['role'],
                    "name"          => $user["name"],
                    "adress"        => $user["adress"],
                    "phone"         => $user["phone"],
                    "other"         => (count(explode(',', $user["other"])) > 0) ? explode(',', $user["other"]) : (($user["other"]) ? $user["other"] : ''),
                    "contact"       => (count(explode(',', $user["contact"])) > 0) ? explode(',', $user["contact"]) : '',
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

        helper("form");

        // Comprobamos las reglas de los input
        $rules = [
            'user' => 'required',
            'passwd' => 'required|min_length[4]'
        ];

        // Si no cumple, devolvemos error
        // if (!$this->validate($rules)) {
        //     session()->setFlashdata('error', lang("error.wrong_login"));
        //     return redirect()->to(base_url('login'));
        // }
        if (str_contains($this->request->getVar('user'),"xtec.cat")) {
            session()->setFlashdata('error', lang("error.wrong_login"));
            return redirect()->to(base_url('login'));
        }
        // Creamos un Modelo Usuario
        $model = new UsersModel();
        // Obtenemos el usuario por user o por mail
        $user = $model->getLoginByMail($this->request->getVar('user'));
        // Si el user o mail no existe, devolvemos error
        if (!$user) {
            session()->setFlashdata('error', lang("error.wrong_login"));
            return redirect()->to(base_url('login'));
        }

        // Comprobamos la contraseña
        $verify = password_verify($this->request->getVar('password'), $user['passwd']);

        // Si la contraseña es incorrecta, devolvemos error
        if (!$verify) {
            session()->setFlashdata('error', lang("error.wrong_login"));
            return redirect()->to(base_url('login'));
        }

        // Obtenemos la información del usuario
        $user = $model->getUserById($user["id"]);

        $userInRole = new UsersInRolesModel();

        // Generamos la sesión
        $sessionData = [
            "uid"           => $user["id"],
            "role"          => $userInRole->getRoleByUser($user["id"])['role'],
            "user"          => $user["user"],
            "code"          => $user["code"],
            "name"          => $user["name"],
            "adress"        => $user["adress"],
            "phone"         => $user["phone"],
            "other"         => (count(explode(',', $user["other"])) > 0) ? explode(',', $user["other"]) : (($user["other"]) ? $user["other"] : ''),
            "contact"       => (count(explode(',', $user["contact"])) > 0) ? explode(',', $user["contact"]) : '',
            "lang"          => ($user["lang"]) ? $user["lang"] : 'ca',
            "logged_data"   => date("Y-m-d H:i:s"),
            "ip_user"       => $_SERVER['REMOTE_ADDR']
        ];
        session()->set("user", $sessionData);

        // Creamos la cookie para recordar el nombre de usuario
        if (!empty($this->request->getVar('remember'))) {
            // Si esta marcado, creamos la cookie
            setcookie("user", $_POST['user'], time() + 606024 * 30);
        } else {
            // Si no esta marcado, eliminamos la cookie
            setcookie("user", "", time() - 60);
        }

        if (session()->get('user')['role']=="sstt") {
            return redirect()->to(base_url('statistics'));
        }else{
            return redirect()->to(base_url('tickets'));
        }
           
    }    

    public function add_prof_or_code(){
        
        
        $institute = request()->getPost('d');
        $mail = session()->getFlashdata('mail');
        $fullname = session()->getFlashdata('fullname');

        // Dona error pero esta be, pensa que es un array i es un string
        // $fullname =  explode(" ", $fullname);
      
        $institute = explode("(",$institute);
        $institute = explode(")",$institute[1]);
        $code = $institute[0];
        // $name=$fullname[0];
        // $lastname=$fullname[1];
        $userModel = new UsersModel();
        $profModel = new ProfessorModel();
        $userInRole = new UsersInRolesModel();
        // Obtenemos el usuario por user o por mail
        $user = $userModel->getLoginByMail($mail);

        // Si el user o mail no existe, creamos el profe
        if (!$user) {
            $id=LibrariesUUID::v4();
            $userModel->addUser($id,$mail,password_hash("1234",PASSWORD_DEFAULT),'ca');
            $profModel->addProfessor($id,$fullname,"",$code);
            $roleModel = new RolesModel();
            $role=$roleModel->getIdByRole("prof");
            $newId=LibrariesUUID::v4();
            $userInRole->addUserRole($newId,$id,$role["id"]);
        }else{
            $id=$user['id'];
            $profModel->updateCode($id,$code);

        }

        $user = $userModel->getUserById(substr($id, 0, -4));
     
        // Generamos la sesión
        $sessionData = [
            "uid"           => $user["id"],
            "role"          => $userInRole->getRoleByUser($user["id"])['role'],
            "user"          => $user["user"],
            "code"          => $user["code"],
            "name"          => $user["name"],
            "adress"        => $user["adress"],
            "phone"         => $user["phone"],
            "other"         => (count(explode(',', $user["other"])) > 0) ? explode(',', $user["other"]) : (($user["other"]) ? $user["other"] : ''),
            "contact"       => (count(explode(',', $user["contact"])) > 0) ? explode(',', $user["contact"]) : '',
            "lang"          => ($user["lang"]) ? $user["lang"] : 'ca',
            "logged_data"   => date("Y-m-d H:i:s"),
            "ip_user"       => $_SERVER['REMOTE_ADDR']
        ];
        session()->set("user", $sessionData);
       
        return redirect()->to(base_url('tickets'));
          
    }

    public function logout()
    {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }

    public function empty()
    {
        // mano mano
        // retornamos  una vista vacía para evitar errores de rutas no definidas.
        return  view('/workingpage');
    }

    public function error404()
    {
        // retornamos  una vista vacía para evitar errores de rutas no definidas.
        return  view('/errors/cli/error_404');
    }


    // function para el lenguaje 
    public function change_lang($language)
    {
        // $userModel = new UsersModel();

        // // Obtén el ID del usuario de la sesión o de otro mecanismo de autenticación
        // $userId = session()->get('user_id');

        // if ($userId) {
        //     $userModel->updateLanguage($userId, $idioma);

        //     // Opcionalmente, actualiza la información de la sesión si es necesario
        //     session()->set('language', $idioma);
        // }
        

        $model = new UsersModel();


        if ($language != 'ca' && $language != 'es' && $language != 'en') {
            // session()->setFlashdata('error', lang("error.wrong_slot"));
            return redirect()->to(base_url('tickets'));
        }
        
        $model->changeLang($language);

        $sessionData = [
            "uid"           => session('user')["uid"],
            "role"          => session('user')["role"],
            "user"          => session('user')["user"],
            "code"          => session('user')["code"],
            "name"          => session('user')["name"],
            "adress"        => session('user')["adress"],
            "phone"         => session('user')["phone"],
            "other"         => session('user')["other"],
            "contact"       => session('user')["contact"],
            "lang"          => $language,
            "logged_data"   => date("Y-m-d H:i:s"),
            "ip_user"       => $_SERVER['REMOTE_ADDR'],
        ];
        session()->set("user", $sessionData);

        return redirect()->to(str_replace('index.php/', '', previous_url()));

    }
}
