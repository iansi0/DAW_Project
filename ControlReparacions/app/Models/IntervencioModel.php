<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\InventariModel;

class IntervencioModel extends Model
{
    protected $table            = 'intervencio';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'descripcio', 'id_ticket', 'id_tipus', 'id_curs', 'id_user'];

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

    public function addIntervencio($id, $descripcio, $id_ticket, $id_tipus, $codi_centre, $id_persona_reparadora)
    {

        $data = [
            'id'            => htmlspecialchars($id),
            'descripcio'    => htmlspecialchars(trim($descripcio)),
            'id_ticket'     => htmlspecialchars(trim($id_ticket)),
            'id_tipus'      => htmlspecialchars(trim($id_tipus)),
            'codi_centre'   => htmlspecialchars(trim($codi_centre)),
            'id_user'       => htmlspecialchars(trim($id_persona_reparadora)),
        ];

        $this->insert($data);
    }

    //Buscar intervencions de ticket
    public function getInterventions($id)
    {
        return $this
            ->select([
                'intervencio.id',
                'intervencio.id_user AS id_reparador',
                'COALESCE(CONCAT(alumne.nom, " ", alumne.cognoms), CONCAT(professor.nom, " ", professor.cognoms), "") as nom_reparador',
                'intervencio.id_tipus',
                'intervencio.descripcio',
                'intervencio.created_at',
                'SUM(inventari.preu) as preu',
                'inventari.nom as material',
            ])
            ->join('inventari', 'intervencio.id = inventari.id_intervencio', 'left')
            ->join('alumne', 'intervencio.id_user = alumne.id_user', 'left')
            ->join('professor', 'intervencio.id_user = professor.id_user', 'left')
            ->where('intervencio.id_ticket', $id)
            ->groupBy('intervencio.id')
            ->orderBy('intervencio.created_at','DESC')

            ->findAll();
    }

    //Buscar una intervecion por id
    public function getInterventionById($id){

       return $this->select([
            'intervencio.id',
            'intervencio.descripcio',
            'intervencio.id_ticket',
        ])
        ->where('intervencio.id', $id)
        ->first();
    }

    public function modifyIntervention($id, $id_tipus, $description)
    {

        $data = [
            'id_tipus'      => htmlspecialchars(trim($id_tipus)),
            'descripcio'    => htmlspecialchars(trim($description)),
        ];

        $role = session()->get('user')['role'];
        $uid = session()->get('user')['uid'];

        $this->where('id', $id);
    
        if($role == "alumn" || $role == 'prof'){
            $this->groupStart();
                $this->where("intervencio.id_user", $uid);
            $this->groupEnd();
        }else if ($role != 'admin') {
            return;
        }

        return $this->set($data)->update();
        // dd($this->db->getLastQuery());

    }

    public function deleteIntervention($id)
    {
        $role = session()->get('user')['role'];
        $uid = session()->get('user')['uid'];

        $modelInventary = new InventariModel();

        if($role == "alumn" || $role == 'prof'){

            $this->groupStart();
                $this->where("id_user", $uid);
            $this->groupEnd();

        } else if ($role != 'admin'){
            return; 
        }

        $modelInventary->unassignInventary($id);

        return $this->delete($id);
    }
}
