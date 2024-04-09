<?php

namespace App\Models;

use CodeIgniter\Model;

class TiquetModel extends Model
{
    protected $table            = 'tiquet';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','codi_dispositiu','descripcio_avaria','nom_persona_contacte_centre','correu_persona_contacte_centre','id_tipus_dispositiu','id_estat','codi_centre_emissor','codi_centre_reparador'];

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

    public function addTiquet($id_tiquet,$codi_equip,$descripcio_avaria,$nom_persona_contacte_centre,$correu_persona_contacte_centre,$id_tipus_dispositiu,$id_estat,$codi_centre_emissor) {
           
        $data = [
            'id' =>  $id_tiquet,
            'codi_dispositiu' => $codi_equip,
            'descripcio_avaria' => $descripcio_avaria,
            'nom_persona_contacte_centre' => $nom_persona_contacte_centre,
            'correu_persona_contacte_centre' => $correu_persona_contacte_centre,
            'id_tipus_dispositiu' => $id_tipus_dispositiu,
            'id_estat' => $id_estat,
            'codi_centre_emissor' => $codi_centre_emissor,
        ];

        $this->insert($data);
    }

    public function getByTitleOrText($search)
    {

        return $this->select(['id', 'id_tipus_dispositiu', 'codi_centre_emissor', 'codi_dispositiu', 'data_alta', 'data_ultima_modificacio', 'id_estat' ])->orLike('codi_dispositiu', $search, 'both', true)->orLike('descripcio_avaria', $search, 'both', true);
    }

    public function getAllPaged($nElements)
    {

        return $this->select(['id', 'id_tipus_dispositiu', 'codi_centre_emissor', 'codi_dispositiu', 'data_alta', 'data_ultima_modificacio', 'id_estat' ])->paginate($nElements);
    }
}
