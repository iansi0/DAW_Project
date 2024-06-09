<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\UsersModel;

class ProfessorModel extends Model
{
    protected $table            = 'professor';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'nom', 'cognoms', 'codi_centre'];

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

    public function addProfessor($id, $nom, $cognoms, $codi_centre) {
           
        $data = [
            'id_user'       => $id,
            'nom'           => trim($nom),
            'cognoms'       => trim($cognoms),
            'codi_centre'   => trim($codi_centre)
        ];

        $this->insert($data);
    }

    public function updateCode($id,$code){
         $this->where('id_user', $id)->set(['codi_centre' => $code])->update();
         
         $modelUser = new UsersModel();
         return $modelUser->activatedUser($id);
        }
}
