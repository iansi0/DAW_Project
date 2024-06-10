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
    protected $allowedFields    = ['codi', 'id_user', 'nom', 'actiu', 'taller', 'telefon', 'adreca_fisica', 'nom_persona_contacte', 'correu_persona_contacte', 'id_sstt', 'id_poblacio'];

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

        // $modelUser = new UsersModel();

        // $exist = $modelUser->getUserByEmail($correu_persona_contacte);

        // if ($exist != null) {
        //     return false;
        // }

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

        return true;
    }

    public function getAllCenter()
    {
        $role = session()->get('user')['role'];
        $code = session()->get('user')['code'];

        $this->select('codi, nom');

        if ($role == "admin") {
            $this;
        } else if ($role == "prof" || $role == "alumn") {
            $this->where("codi", $code);
        } else if ($role == "sstt") {
            $this->where("id_sstt", $code);
        } else if ($role == "ins") {
            $this->where("codi", $code);
        }

        $this->orderBy('nom');

        return $this->findAll();
    }
    public function getAllCenter2()
    {

        $this->select('codi, nom');
        $this->orderBy('nom');

        return $this->findAll();
    }

    public function getAllRepairCenters()
    {

        $role = session()->get('user')['role'];
        $code = session()->get('user')['code'];

        $this->select('codi, nom')->where('actiu', true)->where('taller', true);

        if ($role == "admin") {
            $this;
        } else if ($role == "prof" || $role == "alumn") {
            $this->where("centre.codi", $code);
        } else if ($role == "sstt") {
            $this->where("centre.id_sstt", $code);
        } else if ($role == "ins") {
            $this->where("centre.codi", $code);
        }

        $this->orderBy('nom');
        
        return $this->findAll();
    }

    public function getRegionWithMostTickets($ssttCode)
    {

        
        $this->select('
        comarca.nom as name,
        COUNT(tiquet.id) as count,
        ');
        $this->join('tiquet', 'centre.codi = tiquet.codi_centre_emissor');
        $this->join('poblacio', 'centre.id_poblacio = poblacio.id');
        $this->join('comarca', 'poblacio.id_comarca = comarca.codi');
        $this->where('centre.id_sstt', $ssttCode);
        $this->orderBy('count', 'DESC');

        return $this->findAll();
    }

    public function getCostByRepairCenter()
    {

        $role = session()->get('user')['role'];
        $code = session()->get('user')['code'];

        $this->select('
        centre.nom as name,
        SUM(inventari.preu) as count,
        ');
        $this->join('tiquet', 'centre.codi = tiquet.codi_centre_emissor');
        $this->join('intervencio', 'intervencio.id_ticket = tiquet.id');
        $this->join('inventari', 'inventari.id_intervencio = intervencio.id');

        $this->orderBy('count', 'DESC');
        if ($role == "admin") {
            $this;
        } else if ($role == "prof" || $role == "alumn") {
            $this->where("centre.codi", $code);
        } else if ($role == "sstt") {
            $this->where("centre.id_sstt", $code);
        } else if ($role == "ins") {
            $this->where("centre.codi", $code);
        }
        
        return $this->findAll();
    }

    public function getByTitleOrText($search)
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

            ->orLike('centre.codi', $search, 'both', true)
            ->orLike('centre.nom', $search, 'both', true)
            ->orLike('centre.actiu', $search, 'both', true)
            ->orLike('centre.taller', $search, 'both', true)
            ->orLike('centre.nom_persona_contacte', $search, 'both', true)
            ->orLike('centre.correu_persona_contacte', $search, 'both', true)
            ->orLike('poblacio.nom', $search, 'both', true)
            ->orLike('centre.telefon', $search, 'both', true);
    }

    public function getAllPaged()
    {
        $role = session()->get('user')['role'];
        $code = session()->get('user')['code'];

        $this->select(
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
        );
        $this->join('poblacio', 'centre.id_poblacio = poblacio.id');

    
        if ($role == "admin") {
            return $this;
        } else if ($role == "prof" || $role == "alumn") {
            return $this->where("centre.codi", $code);
        } else if ($role == "sstt") {
            return $this->where("centre.id_sstt", $code);
        } else if ($role == "ins") {
            return $this->where("centre.codi", $code);
        }
        
        
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
        return $this->where('codi', $id)->first();
    }

    public function modifyInstitute($id, $data)
    {
        return $this->where('codi', $id)->set($data)->update();
    }
}
