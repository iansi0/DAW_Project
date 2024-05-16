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
        $role=session()->get('user')['role'];
        $code=intval(session()->get('user')['code']);

        $this->select(["
                        tiquet.id AS id, 
                        tiquet.descripcio_avaria AS descripcio,
                        tiquet.created_at AS created,
                        tipus_dispositiu.nom AS tipus,
                        estat.nom as estat,
                        tiquet.id_estat as id_estat,
                        COALESCE(centre_emissor.nom, '".lang('titles.toassign')."') AS emissor,
                        COALESCE(centre_reparador.nom, '".lang('titles.toassign')."') AS receptor
                    "]);
        $this->join('tipus_dispositiu', 'tiquet.id_tipus_dispositiu = tipus_dispositiu.id');
        $this->join('estat', 'tiquet.id_estat = estat.id');
        $this->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left');
        $this->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left');
        $this->orLike('tiquet.id', $search, 'both', true);
        $this->orLike('tipus_dispositiu.nom', $search, 'both', true);
        $this->orLike('tiquet.descripcio_avaria', $search, 'both', true);
        $this->orLike('centre_emissor.nom', $search, 'both', true);
        $this->orLike('centre_reparador.nom', $search, 'both', true);
        $this->orLike('tiquet.created_at', $search, 'both', true);
        $this->orLike('estat.nom', $search, 'both', true);

        if ($role=="admin") {
            return $this;
        }else if($role=="prof" || $role=="alumn"){
            return $this->where("centre_reparador.id",$code);
        }else if($role=="sstt"){
            return $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emisor.id_sstt",$code);
        }else if($role=="ins"){
            return $this->where("centre_reparador.codi",$code)->orWhere("centre_emissor.codi",$code);
        }
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
        $role=session()->get('user')['role'];
        $code=intval(session()->get('user')['code']);
        
        $this->select([
            "tiquet.id AS id, 
            tiquet.descripcio_avaria AS descripcio,
            tiquet.created_at AS created,
            tipus_dispositiu.nom AS tipus,
            tipus_dispositiu.id AS id_tipus,
            estat.nom as estat,
            tiquet.id_estat as id_estat,
            COALESCE(centre_emissor.nom, '".lang('titles.toassign')."') AS emissor,
            COALESCE(centre_reparador.nom, '".lang('titles.toassign')."') AS receptor"
        ]);
        $this->join('tipus_dispositiu', 'tiquet.id_tipus_dispositiu = tipus_dispositiu.id');
        $this->join('estat', 'tiquet.id_estat = estat.id');
        $this->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left');
        $this->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left');
        

        if ($role=="admin") {
            return $this;
        }else if($role=="prof" || $role=="alumn"){
            return $this->where("centre_reparador.id",$code);
        }else if($role=="sstt"){
            return $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emissor.id_sstt",$code);
        }else if($role=="ins"){
            return $this->where("centre_reparador.codi",$code)->orWhere("centre_emissor.codi",$code);
        }
    }

    public function deleteTicket($id)
    {
        $role=session()->get('user')['role'];
        $code=intval(session()->get('user')['code']);

        $this->where('id', $id);
        
        if ($role=="admin") {
            return $this->delete();
        }else if($role=="prof"){
            $this->where("centre_emissor.id",$code);
        }else if($role=="sstt"){
            $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emisor.id_sstt",$code);
        }else if($role=="ins"){
            $this->where("centre_emissor.codi",$code);
        }else{
            return;
        }
        return $this->delete();
    }

    public function modifyTicket($id,$data)
    {

        $role=session()->get('user')['role'];
        $code=intval(session()->get('user')['code']);

        $this->where('id', $id);
        if ($role=="admin") {
            return $this->delete();
        }else if($role=="prof"){
            $this->where("centre_emissor.id",$code);
        }else if($role=="sstt"){
            $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emisor.id_sstt",$code);
        }else if($role=="ins"){
            $this->where("centre_emissor.codi",$code);
        }else{
            return;
        }
        return $this->set($data)->update();

    }


    public function viewTicket($id)
    {
        
        $role=session()->get('user')['role'];
        $code=intval(session()->get('user')['code']);


        $this->select(["
            tiquet.id AS id, 
            tiquet.correu_persona_contacte_centre AS correu_contacte, 
            tiquet.descripcio_avaria AS descripcio,
            tiquet.created_at AS created,
            tipus_dispositiu.nom AS tipus,
            estat.nom as estat,
            tiquet.id_estat as id_estat,
            COALESCE(centre_emissor.nom, '".lang('titles.toassign')."') AS emissor,
            COALESCE(centre_reparador.nom, '".lang('titles.toassign')."') AS receptor,
            COALESCE(centre_reparador.codi, '0') AS codi_reparador
            "]);
    

        $this->join('tipus_dispositiu', 'tiquet.id_tipus_dispositiu = tipus_dispositiu.id');
        $this->join('estat', 'tiquet.id_estat = estat.id');
        $this->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left');
        $this->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left');

        $this->where('tiquet.id', $id);
        
        if ($role=="admin") {
            $this;
        }else if($role=="prof" || $role=="alumn"){
            $this->where("centre_reparador.id",$code);
        }else if($role=="sstt"){
            $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emissor.id_sstt",$code);
        }else if($role=="ins"){
            $this->where("centre_reparador.codi",$code)->orWhere("centre_emissor.codi",$code);
        }
        
        return $this->first();
    }

    public function getTicketById($id)
    {
        $code=intval(session()->get('user')['code']);
        $role=session()->get('user')['role'];

        $this->where('tiquet.id', $id)->first();

        if ($role=="admin") {
            $this;
        }else if($role=="prof" || $role=="alumn"){
            $this->where("centre_reparador.id",$code);
        }else if($role=="sstt"){
            $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emisor.id_sstt",$code);
        }else if($role=="ins"){
            $this->where("centre_reparador.codi",$code)->orWhere("centre_emissor.codi",$code);
        }
        return $this->first();
    }

    public function getTicketsByMonths()
    {
        $role=session()->get('user')['role'];
        $code=intval(session()->get('user')['code']);

        $this->select('
        MONTH(tiquet.created_at) as month
        , COUNT(tiquet.id) as count
        ');
        $this->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left');
        $this->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left');
        $this->groupBy('month');

        if ($role=="admin") {
            $this;
        }else if($role=="sstt"){
            $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emissor.id_sstt",$code);
        }
        return $this->findAll();

        
    }
    public function getTicketsByType()
    {

        $role=session()->get('user')['role'];
        $code=intval(session()->get('user')['code']);

        $this->select('
        tipus_dispositiu.nom AS tipus,
        , COUNT(tiquet.id) as count
        ');
        $this->join('tipus_dispositiu', 'tiquet.id_tipus_dispositiu = tipus_dispositiu.id');
        $this->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left');
        $this->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left');
        $this->groupBy('tipus');

        if ($role=="admin") {
            $this;
        }else if($role=="sstt"){
            $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emissor.id_sstt",$code);
        }
        return $this->findAll();
    }
}
