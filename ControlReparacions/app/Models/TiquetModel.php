<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Node\Stmt\Return_;
use CodeIgniter\Database\RawSql;

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

    public function addTiquet($id_tiquet, $codi_equip, $descripcio_avaria, $nom_persona_contacte_centre, $correu_persona_contacte_centre, $id_tipus_dispositiu, $id_estat, $codi_centre_emissor, $codi_centre_reparador)
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
            'codi_centre_reparador' => $codi_centre_reparador,
        ];

        $this->insert($data);
    }

    public function getByTitleOrText($search)
    {

        return $this->select([
            "tiquet.id AS id, 
            tiquet.descripcio_avaria AS descripcio,
            tiquet.created_at AS created,
            tipus_dispositiu.nom AS tipus,
            estat.nom as estat,
            tiquet.id_estat as id_estat,
            COALESCE(centre_emissor.nom, '".lang('titles.toassign')."') AS emissor,
            COALESCE(centre_reparador.nom, '".lang('titles.toassign')."') AS receptor"
        ])
        ->join('tipus_dispositiu', 'tiquet.id_tipus_dispositiu = tipus_dispositiu.id')
        ->join('estat', 'tiquet.id_estat = estat.id')
        ->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left')
        ->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left')
                    ->orLike('tiquet.id', $search, 'both', true)
                    ->orLike('tipus_dispositiu.nom', $search, 'both', true)
                    ->orLike('tiquet.descripcio_avaria', $search, 'both', true)
                    ->orLike('centre.nom', $search, 'both', true)
                    ->orLike('tiquet.created_at', $search, 'both', true)
                    ->orLike('estat.nom', $search, 'both', true);
    }

    public function getAllPaged()
    {

        /*
            SELECT tiquet.id as id
                , tipus_dispositiu.nom as tipus
                , tiquet.descripcio_avaria as descripcio
                , tiquet.created_at as data
                , CASE WHEN tiquet.codi_centre_emissor = centre.codi THEN centre.nom END AS emissor
                , CASE WHEN tiquet.codi_centre_reparador = centre.codi THEN centre.nom END AS receptor
                , estat.nom as estat
                
            FROM tiquet
                JOIN tipus_dispositiu ON tiquet.id_tipus_dispositiu = tipus_dispositiu.id
                JOIN centre ON tiquet.codi_centre_emissor = centre.codi OR tiquet.codi_centre_reparador = centre.codi
                JOIN estat ON tiquet.id_estat = estat.id
            WHERE tiquet.deleted_at IS NULL

            LIMIT 8
         */


         return $this->select([
            "tiquet.id AS id, 
            tiquet.descripcio_avaria AS descripcio,
            tiquet.created_at AS created,
            tipus_dispositiu.nom AS tipus,
            estat.nom as estat,
            tiquet.id_estat as id_estat,
            COALESCE(centre_emissor.nom, '".lang('titles.toassign')."') AS emissor,
            COALESCE(centre_reparador.nom, '".lang('titles.toassign')."') AS receptor"
        ])
        ->join('tipus_dispositiu', 'tiquet.id_tipus_dispositiu = tipus_dispositiu.id')
        ->join('estat', 'tiquet.id_estat = estat.id')
        ->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left')
        ->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left');
        
    }

    public function deleteTicket($id)
    {
        return $this->where('id', $id)->delete();
    }

    public function modifyTicket($id,$data)
    {
        return $this->where('id', $id)->set($data)->update();
    }


    public function viewTicket($id)
    {
        return $this->select([
            "tiquet.id AS id, 
            tiquet.descripcio_avaria AS descripcio,
            tiquet.created_at AS created,
            tipus_dispositiu.nom AS tipus,
            estat.nom as estat,
            tiquet.id_estat as id_estat,
            COALESCE(centre_emissor.nom, '".lang('titles.toassign')."') AS emissor,
            COALESCE(centre_reparador.nom, '".lang('titles.toassign')."') AS receptor"
        ])
        ->join('tipus_dispositiu', 'tiquet.id_tipus_dispositiu = tipus_dispositiu.id')
        ->join('estat', 'tiquet.id_estat = estat.id')
        ->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left')
        ->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left');
        

        return  $this->where('tiquet.id', $id)->first();
    }

    public function getTicketById($id)
    {
        return $this->where('tiquet.id', $id)->first();
    }
}
