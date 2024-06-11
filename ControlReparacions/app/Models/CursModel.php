<?php

namespace App\Models;

use CodeIgniter\Model;

class CursModel extends Model
{
    protected $table            = 'curs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','clase','any','titol','codi_centre'];

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

    public function addCurs($id, $clase, $any, $titol, $codi_centre) {
           
        $data = [
            'id'            => htmlspecialchars($id),
            'clase'         => htmlspecialchars(trim($clase)),
            'any'           => htmlspecialchars(trim($any)),
            'titol'         => htmlspecialchars(trim($titol)),
            'codi_centre'   => htmlspecialchars(trim($codi_centre)),
        ];

        $this->insert($data);
    }

    public function getAllCourses(){

        $code = session()->get('user')['code'];

        $this->select('id, clase, any, titol');
        $this->where('codi_centre', $code);

        return $this->findAll();
    }
}

