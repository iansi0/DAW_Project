<?php

namespace App\Models;

use CodeIgniter\Model;

class CentreModel extends Model
{
    protected $table            = 'CENTRE';
    protected $primaryKey       = 'codi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'codi','nom','actiu','taller','telefon','adreca_fisica','nom_persona_contacte','correu_persona_contacte','id_sstt','id_poblacio'];

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

    public function addCentre($id, $codi, $nom, $actiu, $taller, $telefon, $adreca_fisica, $nom_persona_contacte, $correu_persona_contacte, $id_sstt, $id_poblacio) {
           
        $data = [
            'id_user'                 => $id,
            'codi'                    => trim($codi),
            'nom'                     => trim($nom),
            'actiu'                   => trim($actiu),
            'taller'                  => trim($taller),
            'telefon'                 => trim($telefon),
            'adreca_fisica'           => trim($adreca_fisica),
            'nom_persona_contacte'    => trim($nom_persona_contacte),
            'correu_persona_contacte' => trim($correu_persona_contacte),
            'id_sstt'                 => trim($id_sstt),
            'id_poblacio'             => trim($id_poblacio),
        ];

        $this->insert($data);
    }

    public function getByTitleOrText($search)
    {

        return $this->select(['codi','id_user','nom','actiu','taller','telefon','adreca_fisica','correu_persona_contacte','id_sstt','id_poblacio' ])->orLike('id_user', $search, 'both', true)->orLike('nom', $search, 'both', true);
    }

    public function getAllPaged($nElements)
    {

        return $this->select(['codi','id_user','nom','actiu','taller','telefon','adreca_fisica','correu_persona_contacte','id_sstt','id_poblacio' ])->paginate($nElements);
    }
}
