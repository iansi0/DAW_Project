<?php

namespace App\Models;

use CodeIgniter\Model;

class SSTTModel extends Model
{
    protected $table            = 'sstts';
    protected $primaryKey       = 'id_sstt';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_sstt','nom_sstt','adreca_fisia_sstt','telefon_sstt','correu_sstt'];

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

    public function addSSTT($id_sstt,$nom_sstt,$adreca_fisia_sstt,$telefon_sstt,$correu_sstt) {
           
        $data = [
            'id_sstt' =>  $id_sstt,
            'nom_sstt' => $nom_sstt,
            'adreca_fisia_sstt' => $adreca_fisia_sstt,
            'telefon_sstt' => $telefon_sstt,
            'correu_sstt' => $correu_sstt,
            
        ];

        $this->insert($data);
    }
}
