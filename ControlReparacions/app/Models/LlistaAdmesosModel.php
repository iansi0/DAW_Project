<?php

namespace App\Models;

use CodeIgniter\Model;

class LlistaAdmesosModel extends Model
{
    protected $table            = 'llista_admesos';
    protected $primaryKey       = 'correu_professor';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['correu_professor','data_entrega','codi_centre'];

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

    public function addLlistaAdmesos($correu_professor,$data_entrega,$codi_centre) {
           
        $data = [
            'correu_professor' =>  $correu_professor,
            'data_entrega' => $data_entrega,
            'codi_centre' => $codi_centre,
            
        ];

        $this->insert($data);
    }
}
