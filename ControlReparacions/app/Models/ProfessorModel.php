<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfessorModel extends Model
{
    protected $table            = 'professor';
    protected $primaryKey       = 'id_xtec';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_xtec','nom_professor','cognom_professor','correu_professor','codi_professor'];

    // Dates
    protected $useTimestamps = false;
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

    public function addProfessor($id_xtec,$nom_professor,$cognom_professor,$correu_professor,$codi_centre) {
           
        $data = [
            'id_xtec' =>  $id_xtec,
            'nom_professor' => $nom_professor,
            'cognoms_professor' => $cognom_professor,
            'correu_professor' => $correu_professor,
            'codi_centre' => $codi_centre
        ];

        $this->insert($data);
    }
}
