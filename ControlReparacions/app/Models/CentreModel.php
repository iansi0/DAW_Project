<?php

namespace App\Models;

use CodeIgniter\Model;

class CentreModel extends Model
{
    protected $table            = 'centre';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'codi', 'nom', 'actiu', 'taller', 'telefon', 'adreca_fisica', 'nom_persona_contacte', 'correu_persona_contacte', 'id_sstt', 'id_poblacio'];

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

    public function addCentre($id, $codi, $nom, $actiu, $taller, $telefon, $adreca_fisica, $nom_persona_contacte, $correu_persona_contacte, $id_sstt, $id_poblacio)
    {

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

    public function getAllCenter()
    {
        return $this->select('codi, nom')->findAll();
    }

    public function getAllRepairCenters()
    {
        return $this->select('codi, nom')->where('actiu', true)->where('taller', true)->findAll();
    }

    public function getByTitleOrText($search)
    {

        return $this->select(["
                                tiquet.id AS id, 
                                tiquet.descripcio_avaria AS descripcio,
                                tiquet.created_at AS created,
                                tipus_dispositiu.nom AS tipus,
                                estat.nom as estat,
                                tiquet.id_estat as id_estat,
                                COALESCE(centre_emissor.nom, '" . lang('titles.toassign') . "') AS emissor,
                                COALESCE(centre_reparador.nom, '" . lang('titles.toassign') . "') AS receptor
                            "])
            ->join('tipus_dispositiu', 'tiquet.id_tipus_dispositiu = tipus_dispositiu.id')
            ->join('estat', 'tiquet.id_estat = estat.id')
            ->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left')
            ->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left')
            ->orLike('tiquet.id', $search, 'both', true)
            ->orLike('tipus_dispositiu.nom', $search, 'both', true)
            ->orLike('tiquet.descripcio_avaria', $search, 'both', true)
            ->orLike('centre_emissor.nom', $search, 'both', true)
            ->orLike('centre_reparador.nom', $search, 'both', true)
            ->orLike('tiquet.created_at', $search, 'both', true)
            ->orLike('estat.nom', $search, 'both', true);
    }

    public function getAllPaged()
    {

        return $this->select(
            "
            centre.codi AS codi,
            centre.nom AS nom, 
            centre.actiu AS actiu,
            centre.taller AS taller,
            centre.nom_persona_contacte AS persona,
            centre.correu_persona_contacte AS correu,
            centre.id_poblacio AS id_poblacio,
            centre.telefon AS telefon,
            centre.adreca_fisica AS adreca,
    
            COALESCE(poblacio.nom, '" . lang('titles.toassign') . "') AS poblacio,"
        )
            ->join('poblacio', 'centre.id_poblacio = poblacio.id');
    }

    public function viewInstitute($id)
    {

        return $this->select(
            "
            centre.codi AS codi,
            centre.nom AS nom, 
            centre.actiu AS actiu,
            centre.taller AS taller,
            centre.nom_persona_contacte AS persona,
            centre.correu_persona_contacte AS correu,
            centre.id_poblacio AS id_poblacio,
            centre.telefon AS telefon,
            centre.adreca_fisica AS adreca,
    
            COALESCE(poblacio.nom, '" . lang('titles.toassign') . "') AS poblacio,"
        )
            ->join('poblacio', 'centre.id_poblacio = poblacio.id')
            ->where('centre.codi', $id)->first();
    }

    public function getInstituteById($id)
    {
        return $this->where('centre.codi', $id)->first();
    }

    public function modifyInstitute($id, $data)
    {
        return $this->where('codi', $id)->set($data)->update();
    }
}
