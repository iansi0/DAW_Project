<?php

namespace App\Models;

use CodeIgniter\Model;

class CentreModel extends Model
{
    protected $table            = 'centres';
    protected $primaryKey       = 'codi_centre';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['codi_centre','nom_centre','actiu','taller','telefon_centre','adreca_fisica_centre','nom_persona_contacte_centre','correu_persona_contacte_centre','id_sstt','id_poblacio'];

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

    public function addCentre($codi_centre,$nom_centre,$actiu,$taller,$telefon_centre,$adreca_fisica_centre,$nom_persona_contacte_centre,$correu_persona_contacte_centre,$id_sstt,$id_poblacio) {
           
        $data = [
            'codi_centre' =>  $codi_centre,
            'nom_centre' => $nom_centre,
            'actiu' => $actiu,
            'taller' => $taller,
            'telefon_centre' => $telefon_centre,
            'adreca_fisica_centre' => $adreca_fisica_centre,
            'nom_persona_contacte_centre' => $nom_persona_contacte_centre,
            'adreca_fisica_centre' => $adreca_fisica_centre,
            'correu_persona_contacte_centre' => $correu_persona_contacte_centre,
            'id_sstt' => $id_sstt,
            'id_poblacio' => $id_poblacio,
        ];

        $this->insert($data);
    }
}
