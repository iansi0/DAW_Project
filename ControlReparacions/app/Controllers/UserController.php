<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class UserController extends BaseController
{
    public function config()
    {
        $model = new UsersModel();
        $data['user'] = $model->getUserById(session('user')['uid']);

        return view('user/user_config', $data);
    }

    public function config_post()
    {
        $model = new UsersModel();

        $language = $this->request->getPost('select_lang');

        if($language != 'ca' && $language != 'es' && $language != 'en'){
            session()->setFlashdata('error', lang("error.wrong_slot"));
            return redirect()->to(base_url('config'));
        }

        $model->changeLang($language);

        $sessionData = [
            "uid"           => session('user')["uid"],
            "user"          => session('user')["user"],
            "code"          => session('user')["code"],
            "name"          => session('user')["name"],
            "adress"        => session('user')["adress"],
            "phone"         => session('user')["phone"],
            "other"         => session('user')["other"],
            "contact"       => session('user')["contact"],
            "type"          => session('user')["type"],
            "lang"          => $language,
            "logged_data"   => date("Y-m-d H:i:s"),
            "ip_user"       => $_SERVER['REMOTE_ADDR'],
        ];

        session()->set("user", $sessionData);

        return redirect()->to(base_url('config'));
    }
}
