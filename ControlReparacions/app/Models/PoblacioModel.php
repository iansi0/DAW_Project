<?php

namespace App\Models;

use CodeIgniter\Model;

class PoblacioModel extends Model
{
    protected $table            = 'poblacios';
    protected $primaryKey       = 'id_poblacio';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_poblacio','nom_poblacio','id_comarca'];

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

    public function addPoblacio($id_poblacio,$nom_poblacio,$id_comarca) {
           
        $data = [
            'id_poblacio' =>  $id_poblacio,
            'nom_poblacio' => $nom_poblacio,
            'id_comarca' => $id_comarca,
            
        ];

        $this->insert($data);
    }
}
