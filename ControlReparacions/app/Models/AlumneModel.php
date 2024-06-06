<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\UsersModel;

class AlumneModel extends Model
{
    protected $table            = 'alumne';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'nom', 'cognoms', 'id_curs', 'codi_centre'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function addAlumne($id, $nom, $cognoms, $id_curs, $codi_centre, $correo = null)
    {


        if ($correo != null) {


            $modelUser = new UsersModel();
            // dd($correo);
            //Esto devuelve la id del user 
            $userExist = $modelUser->getUserByEmail($correo);


            if ($userExist != null) {
                // si la id existe buscar el alumno y activarlo 
                // dd($userExist);
                $data = [
                    'id_curs'       => trim($id_curs),
                    'deleted_at'      => null,
                ];

                $this->where('id_user', $userExist['id'])->set('id_curs', trim($id_curs))->update();
                $this->builder->where('id_user', $userExist['id'])->set($this->deletedField, null)->update();

                $modelUser->activatedUser($userExist);
                // $this->builder->where('id_user', $userExist['id'])->set($data)->update();
                return false;
            }
        }

        //Si no existe añadirlo normal
        $data = [
            'id_user'       => $id,
            'nom'           => trim($nom),
            'cognoms'       => trim($cognoms),
            'id_curs'       => trim($id_curs),
            'codi_centre'   => trim($codi_centre),
        ];

        $this->insert($data);
        return true;
    }

    public function getByTitleOrText($search)
    {

        return $this->select(['id_user', 'nom', 'cognoms', 'codi_centre'])->orLike('id_user', $search, 'both', true)->orLike('nom', $search, 'both', true);
    }

    public function getAllPaged($nElements)
    {

        $role = session()->get('user')['role'];
        $code = session()->get('user')['code'];


        $this->select(
            "alumne.id_user,
            alumne.nom,
            alumne.cognoms,
            alumne.id_curs,
            curs.titol as curs,
            alumne.codi_centre"
        );

        $this->join('curs', 'alumne.id_curs = curs.id', 'left');

        if ($role == "prof" || $role == "ins") {
            $this->where("alumne.codi_centre", $code);
        }

        return $this->paginate($nElements);
    }

    public function getStudentById($id)
    {

        $role = session()->get('user')['role'];
        $code = session()->get('user')['code'];


        $this->select(
            "alumne.id_user,
            alumne.nom,
            alumne.cognoms,
            alumne.id_curs,
            curs.titol as curs,
            alumne.codi_centre,
            users.user as correo "
        );

        $this->join('curs', 'alumne.id_curs = curs.id', 'left');
        $this->join('users', 'alumne.id_user = users.id', 'left');

        return $this->where('id_user', $id)->first();
    }

    public function modifyStudent($id, $data){

        $role=session()->get('user')['role'];
        $code=session()->get('user')['code'];

        $this->where('id_user', $id);
        $this->join('centre AS centre', 'alumne.codi_centre = centre.codi', 'left');

        if ($role=="admin") {
            $this;
        }else if($role=="prof" || $role=="ins"){
            $this->groupStart();
            $this->where("alumne.codi_centre",$code);
            $this->groupEnd();
        }

        return $this->set($data)->update();

    }


    public function deleteStudent($id)
    {

        $modelUser = new UsersModel();

        $role = session()->get('user')['role'];
        $code = session()->get('user')['code'];

        $this->join('centre AS centre', 'alumne.codi_centre = centre.codi', 'left');
        $this->where('id_user', $id);

        if ($role == "admin") {
            $modelUser->deleteUser($id);
            return $this->delete();
        } else if ($role == "prof" || $role == "ins") {
            $this->groupStart();
            $this->where("alumne.codi_centre", $code);
            $this->groupEnd();
        } else {
            return;
        }

        $modelUser->deleteUser($id);
        return $this->delete();
    }
}
