<?php

namespace App\Models;

use CodeIgniter\Model;

class SSTTModel extends Model
{
    protected $table            = 'SSTT';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'codi', 'nom', 'adreca_fisica', 'cp', 'poblacio', 'telefon', 'correu', 'altres'];

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

    public function addSSTT($id,$codi,$nom,$adreca_fisica,$cp,$poblacio,$telefon,$correu,$altres) {
           
        $data = [
            'id'            => $id,
            'codi'          => trim($codi),
            'nom'           => trim($nom),
            'adreca_fisica' => trim($adreca_fisica),
            'cp'            => str_replace(' ', '', trim($cp)),
            'poblacio'      => trim($poblacio),
            'telefon'       => str_replace(' ', '', trim($telefon)),
            'correu'        => trim($correu),
            'altres'        => trim($altres)
            
        ];

        $this->insert($data);
    }
}
