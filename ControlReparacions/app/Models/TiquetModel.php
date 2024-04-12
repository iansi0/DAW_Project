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
    protected $allowedFields    = ['id', 'codi_dispositiu', 'descripcio_avaria', 'nom_persona_contacte_centre', 'correu_persona_contacte_centre', 'id_tipus_dispositiu', 'id_estat', 'codi_centre_emissor', 'codi_centre_reparador'];

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

    public function addTiquet($id_tiquet, $codi_equip, $descripcio_avaria, $nom_persona_contacte_centre, $correu_persona_contacte_centre, $id_tipus_dispositiu, $id_estat, $codi_centre_emissor)
    {

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

        return $this->select(['tiquet.id as id', 'tipus_dispositiu.nom as tipus', 'tiquet.descripcio_avaria as descripcio', 'emissor.nom as centre_emisor', 'receptor.nom as centre_receptor', 'tiquet.created_at as data', 'estat.nom as estat' ])
            ->join('tipus_dispositiu','tiquet.id_tipus_dispositiu = tipus_dispositiu.id')
            ->join('centre as emissor','tiquet.codi_centre_emissor = emissor.codi')
            ->join('centre as receptor','tiquet.codi_centre_reparador = receptor.codi')
            ->join('estat','tiquet.id_estat = estat.id')
            ->orLike('id', $search, 'both', true)
            ->orLike('tipus', $search, 'both', true)
            ->orLike('descripcio', $search, 'both', true)
            ->orLike('centre_emisor', $search, 'both', true)
            ->orLike('centre_receptor', $search, 'both', true)
            ->orLike('data', $search, 'both', true)
            ->orLike('estat', $search, 'both', true);
    }

    public function getAllPaged($nElements)
    {

        $page = $this->select("tiquet.id as id
                                , tipus_dispositiu.nom as tipus
                                , tiquet.descripcio_avaria as descripcio
                                , tiquet.created_at as data
                                , CASE WHEN tiquet.codi_centre_emissor = centre.codi THEN centre.nom END AS emissor
                                , CASE WHEN tiquet.codi_centre_reparador = centre.codi THEN centre.nom END AS receptor
                                , estat.nom as estat"
                            );
                $this->join('tipus_dispositiu','tiquet.id_tipus_dispositiu = tipus_dispositiu.id');
                $this->join('centre', 'tiquet.codi_centre_emissor = centre.codi OR tiquet.codi_centre_reparador = centre.codi');
                $this->join('estat', 'tiquet.id_estat = estat.id');
                $this->paginate($nElements);

        return $page;
        
    }

    public function deleteTicket($id)
    {

        return $this->where('id', $id)->delete();
    }

    public function viewTicket($id)
    {
        return  $this->where('id', $id)->first();
    }
}
