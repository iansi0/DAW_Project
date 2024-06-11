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
                $data = [
                    'id_curs'         => htmlspecialchars(trim($id_curs)),
                    'deleted_at'      => null,
                ];

                $this->where('id_user', $userExist['id'])->set('id_curs', trim($id_curs))->update();
                $this->where('id_user', $userExist['id'])->set($this->deletedField, null)->update();

                $modelUser->activatedUser($userExist['id']);
                return false;
            }

        }

        //Si no existe añadirlo normal
        $data = [
            'id_user'       => htmlspecialchars($id),
            'nom'           => htmlspecialchars(trim($nom)),
            'cognoms'       => htmlspecialchars(trim($cognoms)),
            'id_curs'       => htmlspecialchars(trim($id_curs)),
            'codi_centre'   => htmlspecialchars(trim($codi_centre)),
        ];

        $this->insert($data);
        return true;

    }

    public function getByTitleOrText($search)
    {
        return $this->select(['id_user', 'nom', 'cognoms', 'codi_centre'])->orLike('id_user', $search, 'both', true)->orLike('nom', $search, 'both', true);
    }

    public function getAllPaged($export = null)
    {

        $role = session()->get('user')['role'];
        $code = session()->get('user')['code'];

        if ($export) {
            $this->select(
                "
                alumne.nom,
                alumne.cognoms,
                alumne.id_curs,
                CONCAT(curs.any, ' ' , curs.titol, ' ', curs.clase) as curs,
                "
            );
            $this->join('curs', 'alumne.id_curs = curs.id', 'left');
        } else {
            $this->select(
                "
                alumne.id_user,
                alumne.nom,
                alumne.cognoms,
                alumne.id_curs,
                CONCAT(curs.any, ' ' , curs.titol, ' ', curs.clase) as curs,
                alumne.codi_centre
                "
            );
            $this->join('curs', 'alumne.id_curs = curs.id', 'left');
        }


        if ($role == "prof" || $role == "ins") {
            $this->where("alumne.codi_centre", $code);
        }

        $this->orderBy('curs');
        $this->orderBy('cognoms');

        return $this;
    }

    public function getStudentById($id)
    {

        $this->select(
            "alumne.id_user,
            alumne.nom,
            alumne.cognoms,
            alumne.id_curs,
              CONCAT(curs.any, ' ' , curs.titol, ' ', curs.clase) as curs,
            alumne.codi_centre,
            users.user as correo "
        );

        $this->join('curs', 'alumne.id_curs = curs.id', 'left');
        $this->join('users', 'alumne.id_user = users.id', 'left');

        return $this->where('id_user', $id)->first();
    }

    public function modifyStudent($id, $data)
    {

        $role = session()->get('user')['role'];
        $code = session()->get('user')['code'];

        if ($role == "prof" || $role == "ins") {
            $this->groupStart();
                $this->where("codi_centre", $code);
            $this->groupEnd();
        } else if ($role != 'admin'){
            return;
        }

        return $this->set($data)->update($id);
    }


    public function deleteStudent($id)
    {

        $modelUser = new UsersModel();

        $role = session()->get('user')['role'];
        $code = session()->get('user')['code'];

        if ($role == "prof" || $role == "ins") {
            
            $this->groupStart();
                $this->where("codi_centre", $code);
            $this->groupEnd();

        } else if ($role != 'admin') {
            return;
        }

        $modelUser->deleteUser($id);
        return $this->delete($id);
    }
}
