<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\CentreModel;

class UserController extends BaseController
{
    public function config()
    {
        $model = new UsersModel();
        $modelInstitute = new CentreModel();

        $data['user'] = $model->getUserById(session('user')['uid']);
        $data['institute'] = $modelInstitute->getInstituteById(session('user')['code']);

        // dd($data['institute']);

        $role = session()->get('user')['role'];

        return view('configurations/student', $data);

        if ($role == 'alumn') {
            return view('configurations/student', $data);
        } else if ($role == 'prof') {
            return view('configurations/teacher', $data);
        } else if ($role == 'ins') {
            return view('configurations/institutes', $data);
        } else if ($role == 'sstt') {
            return view('configurations/sstt', $data);
        }
        return view('configurations/admin', $data);
    }

    public function config_post()
    {
        $model = new UsersModel();

        $language = $this->request->getPost('select_lang');

        if ($language != 'ca' && $language != 'es' && $language != 'en') {
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
            "lang"          => $language,
            "logged_data"   => date("Y-m-d H:i:s"),
            "ip_user"       => $_SERVER['REMOTE_ADDR'],
        ];

        session()->set("user", $sessionData);

        return redirect()->to(base_url('config'));
    }

    public function change_passwd()
    {

        //cambiar la passwd
        $model = new UsersModel();
        $password = $this->request->getPost('passwd');

        //validation errors
        helper('form');

        $validationRules =
            [
                'passwd' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Error passwd',
                    ],
                ],
            ];


        if ($this->validate($validationRules)) {

            // dd($password);
            $model->changePassword($password);

            return redirect()->to(base_url('config'));
        }
        return redirect()->back()->withInput();
    }
}
