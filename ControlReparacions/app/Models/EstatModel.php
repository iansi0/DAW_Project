<?php

namespace App\Models;

use CodeIgniter\Model;

class EstatModel extends Model
{
    protected $table            = 'estat';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','nom'];

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

    public function addEstat($id,$nom) {
           
        $data = [
            'id' =>  $id,
            'nom' => $nom,
        ];

        $this->insert($data);
    }

    public function getAllStates(){
        return $this->select('id,nom')->findAll();
    }
    public function getFilteredStates(){

        $role=session()->get('user')['role'];

        $this->select('id,nom');
        if($role=="prof" || $role=="ins"){
            $this->where("id",0)->orWhere("id",6)->orWhere("id",7)->orWhere("id",8)->orWhere("id",13);
        }
        return $this->findAll();
         
    }
}
