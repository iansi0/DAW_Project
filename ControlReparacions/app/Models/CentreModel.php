<?php

namespace App\Models;

use CodeIgniter\Model;

class CentreModel extends Model
{
    protected $table            = 'CENTRES';
    protected $primaryKey       = 'codi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['codi','nom','actiu','taller','telefon','adreca_fisica','nom_persona_contacte','correu_persona_contacte','id_sstt','id_poblacio'];

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

    public function addCentre($codi,$nom,$actiu,$taller,$telefon,$adreca_fisica,$nom_persona_contacte,$correu_persona_contacte,$id_sstt,$id_poblacio) {
           
        $data = [
            'codi' =>  $codi,
            'nom' => $nom,
            'actiu' => $actiu,
            'taller' => $taller,
            'telefon' => $telefon,
            'adreca_fisica' => $adreca_fisica,
            'nom_persona_contacte' => $nom_persona_contacte,
            'correu_persona_contacte' => $correu_persona_contacte,
            'id_sstt' => $id_sstt,
            'id_poblacio' => $id_poblacio,
        ];

        $this->insert($data);
    }
}
