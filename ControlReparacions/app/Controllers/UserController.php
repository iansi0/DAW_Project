<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\SSTTModel;
use App\Models\CentreModel;
use App\Models\ProfessorModel;
use App\Models\AlumneModel;

class UserController extends BaseController
{
    public function config()
    {
        $modelUser = new UsersModel();
        $modelSSTT = new SSTTModel();
        $modelInstitute = new CentreModel();
        $modelTeacher = new ProfessorModel();
        $modelStudent = new AlumneModel();

        $role = session()->get('user')['role'];

        if ($role == 'alumn') {
            $data['institute'] = $modelInstitute->getInstituteById(session('user')['code']);
            $data['student'] = $modelStudent->getStudentById(session('user')['uid']);

            return view('configurations/student', $data);

        } else if ($role == 'prof') {
            $data['institute'] = $modelInstitute->getInstituteById(session('user')['code']);
            $data['teacher'] = $modelTeacher->getPorfessorById(session('user')['uid']);   
            $data['user'] = $modelUser->getUserById(session('user')['uid']);   

            return view('configurations/teacher', $data);

        } else if ($role == 'ins') {
            $data['institute'] = $modelInstitute->getInstituteById(session('user')['code']);  
            $data['sstt'] = $modelSSTT->getSSTTById($data['institute']['id_sstt']);
    
            return view('configurations/institutes', $data);

        } else if ($role == 'sstt') {
            $data['user'] = $modelUser->getUserById(session('user')['uid']);
      

            return view('configurations/sstt', $data);

        }
        $data['user'] = $modelUser->getUserById(session('user')['uid']);
     
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
                        'required' => lang('error.empty_slot_2'),
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

    public function change_institute(){

        $model = new CentreModel();

           //validation errors
           helper('form');

           $validationRules =
           [
               'email' => [
                   'rules'  => 'required|valid_email',
                   'errors' => [
                       'required' => lang('error.empty_slot_2'),
                       'valid_email' => lang('error.wrong_email'),
                   ],
               ],
           ];

           if ($this->validate($validationRules)) {

            // dd( session('user'));
            $data = [
                "codi" =>  session('user')['code'],
                "nom_persona_contacte" => $this->request->getPost('name'),
                "correu_persona_contacte" =>  $this->request->getPost('email'),

            ];

            $model->modifyInstitute(session('user')['code'], $data);
            return redirect()->to(base_url('config'));
           }
           return redirect()->back()->withInput();
    }
}
