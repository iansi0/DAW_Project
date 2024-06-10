<?php

namespace App\Models;

use CodeIgniter\Model;
use Google\Service\AnalyticsData\OrderBy;
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
            'id' => htmlspecialchars( $id_tiquet),
            'codi_dispositiu' => htmlspecialchars($codi_equip),
            'descripcio_avaria' => htmlspecialchars($descripcio_avaria),
            'nom_persona_contacte_centre' => htmlspecialchars($nom_persona_contacte_centre),
            'correu_persona_contacte_centre' => htmlspecialchars($correu_persona_contacte_centre),
            'id_tipus_dispositiu' => htmlspecialchars($id_tipus_dispositiu),
            'id_estat' => htmlspecialchars($id_estat),
            'codi_centre_emissor' => htmlspecialchars($codi_centre_emissor),
            'codi_centre_reparador' => htmlspecialchars($codi_centre_reparador),
        ];

        $this->insert($data);
    }

    public function getByTitleOrText($search, $filters)
    {


        $role = session()->get('user')['role'];
        $code = session()->get('user')['code'];

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
        
        // WHERE USING SEARCH 
        // Si los filtros estan activos, los priorizamos antes que la búsqueda para evitar conflictos
        $this->groupStart();
            $this->orLike('tiquet.id', $search, 'both', true);
            $this->orLike('tiquet.descripcio_avaria', $search, 'both', true);
            if(empty($filters['device'])) $this->orLike('tipus_dispositiu.nom', $search, 'both', true);
            if(empty($filters['center'])) $this->orLike('centre_emissor.nom', $search, 'both', true);
            if(empty($filters['center'])) $this->orLike('centre_reparador.nom', $search, 'both', true);
            if(empty($filters['state'])) $this->orLike('estat.nom', $search, 'both', true);
        $this->groupEnd();

        // WHERE USING FILTERS
        if(!empty($filters)){
            $this->groupStart();
                if(!empty($filters['device'])) $this->where('tipus_dispositiu.nom', $filters['device'], true);
                if(!empty($filters['center'])) {
                    $this->groupStart(); 
                        $this->like('centre_emissor.nom', $filters['center'], 'both', true);
                        $this->orLike('centre_reparador.nom', $filters['center'], 'both', true);
                    $this->groupEnd();
                }
                $this->groupStart();
                    $this->where('DATE(tiquet.created_at) >= ', $filters['date_ini']);
                    $this->where('DATE(tiquet.created_at) <= ', $filters['date_end']);
                $this->groupEnd();
                $this->groupStart();
                    $this->where('TIME(tiquet.created_at) >= ', $filters['time_ini']);
                    $this->where('TIME(tiquet.created_at) <= ', $filters['time_end']);
                $this->groupEnd();
                if(!empty($filters['state'])) $this->like('estat.nom', $filters['state']);
            $this->groupEnd();
        };

        if ($role=="admin") {
            $this;
        }else if($role=="prof" || $role=="ins"){
            $this->groupStart();
                $this->where("tiquet.codi_centre_reparador",$code)->orWhere("tiquet.codi_centre_emissor",$code);
            $this->groupEnd();
        }else if($role=="alumn"){
            $this->groupStart();
                $this->where("tiquet.codi_centre_reparador",$code);
                $this->where("estat.id",'6');
            $this->groupEnd();
        }else if($role=="sstt"){
            $this->groupStart();
                $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emissor.id_sstt",$code);
            $this->groupEnd();
        }

        return $this->orderBy('tiquet.created_at', 'desc');

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
            ORDER BY tiquet.created_at DESC

            LIMIT 8
         */
        $role=session()->get('user')['role'];
        $code=session()->get('user')['code'];

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
            $this;
        }else if($role=="prof" || $role=="ins"){
            $this->groupStart();
                $this->where("tiquet.codi_centre_reparador",$code)->orWhere("tiquet.codi_centre_emissor",$code);
            $this->groupEnd();
        }else if($role=="alumn"){
            $this->groupStart();
                $this->where("tiquet.codi_centre_reparador",$code);
                $this->where("estat.id",'6');
            $this->groupEnd();
        }else if($role=="sstt"){
            $this->groupStart();
                $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emissor.id_sstt",$code);
            $this->groupEnd();
        }
        return $this->orderBy('tiquet.created_at', 'desc');

    }

    public function deleteTicket($id)
    {
        $role=session()->get('user')['role'];
        $code=session()->get('user')['code'];

        $this->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left');
        $this->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left');
        $this->where('id', $id);

        if ($role=="admin") {
            return $this->delete();
        }else if($role=="prof" || $role=="ins"){
            $this->groupStart();
                $this->where("tiquet.codi_centre_reparador",$code)->orWhere("tiquet.codi_centre_emissor",$code);
            $this->groupEnd();

        }else if($role=="sstt"){
            $this;
            // $a = $this->select('centre.codi')->join('centre', 'tiquet.codi_centre_reparador = centre.codi')->where("centre.id_sstt", $code)->find();
            // foreach ($a as &$value) {
            //     $value = $value['codi'];
            // }
            // $b = $this->select('centre.codi')->join('centre', 'tiquet.codi_centre_emissor = centre.codi')->where("centre.id_sstt", $code)->find();
            // foreach ($b as &$value) {
            //     $value = $value['codi'];
            // }

            // $this->groupStart();
            //     $this->where("tiquet.codi_centre_reparador", $a);
            //     $this->orWhere("tiquet.codi_centre_emissor", $b);
            // $this->groupEnd();
            
        }else{
            return; 
        }
        return $this->delete();
    }

    public function modifyTicket($id, $data)
    {

        foreach ($data as &$value) {
            $value = htmlspecialchars($value);
        }
        $role=session()->get('user')['role'];
        $code=session()->get('user')['code'];
        d($code);

        $this->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left');
        $this->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left');
        $this->where('id', $id);

        if ($role=="admin") {
            $this;
        }else if($role=="prof" || $role=="ins"){
            $this->groupStart();
                $this->where("tiquet.codi_centre_reparador",$code)->orWhere("tiquet.codi_centre_emissor",$code);
            $this->groupEnd();
        }else if($role=="sstt"){
            $this;
            // $a = $this->select('centre.codi')->join('centre', 'tiquet.codi_centre_reparador = centre.codi')->where("centre.id_sstt", $code)->find();
            // foreach ($a as &$value) {
            //     $value = $value['codi'];
            // }
            // $b = $this->select('centre.codi')->join('centre', 'tiquet.codi_centre_emissor = centre.codi')->where("centre.id_sstt", $code)->find();
            // foreach ($b as &$value) {
            //     $value = $value['codi'];
            // }

            // $this->groupStart();
            //     $this->whereIn("tiquet.codi_centre_reparador", $a);
            //     $this->orWhereIn("tiquet.codi_centre_emissor", $b);
            // $this->groupEnd();

        }else{
            return;
        }
        return $this->set($data)->update();

    }

    public function modifyInstitute($id,$data)
    {

        $role=session()->get('user')['role'];

        $this->where('id', $id);
        $this->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left');
        $this->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left');

        if ($role=="admin") {
            return $this->set($data)->update();
        } else if ($role=="sstt"){

            return $this->set($data)->update();
            
            // $a = $this->select('centre.codi')->join('centre', 'tiquet.codi_centre_reparador = centre.codi')->where("centre.id_sstt", session('user')['code'])->find();
            // foreach ($a as &$value) {
            //     $value = $value['codi'];
            // }
            // $b = $this->select('centre.codi')->join('centre', 'tiquet.codi_centre_emissor = centre.codi')->where("centre.id_sstt", session('user')['code'])->find();
            // foreach ($b as &$value) {
            //     $value = $value['codi'];
            // }

            // $this->groupStart();
            //     $this->whereIn("tiquet.codi_centre_reparador", $a);
            //     $this->orWhereIn("tiquet.codi_centre_emissor", $b);
            // $this->groupEnd();

        }else{
            return;
        }



    }

    public function saveState($id,$state)
    {

        $state = htmlspecialchars($state);

        $role = session()->get('user')['role'];
        $code = session()->get('user')['code'];

        $this->where('id', $id);

        if($role=="prof" || $role=="ins"){
            $this->groupStart();
                $this->where("tiquet.codi_centre_reparador",$code)->orWhere("tiquet.codi_centre_emissor",$code);
            $this->groupEnd();
        }else if($role=="sstt"){

            $a = $this->select('centre.codi')->join('centre', 'tiquet.codi_centre_reparador = centre.codi')->where("centre.id_sstt", $code)->find();
            foreach ($a as &$value) {
                $value = $value['codi'];
            }
            $b = $this->select('centre.codi')->join('centre', 'tiquet.codi_centre_emissor = centre.codi')->where("centre.id_sstt", $code)->find();
            foreach ($b as &$value) {
                $value = $value['codi'];
            }

            $this->groupStart();
                $this->whereIn("tiquet.codi_centre_reparador", $a);
                $this->orWhereIn("tiquet.codi_centre_emissor", $b);
            $this->groupEnd();

        }else if ($role!="admin") {
            return;
        }

        return $this->set(['id_estat' => $state])->update();

    }


    public function viewTicket($id)
    {
        $role=session()->get('user')['role'];
        $code=session()->get('user')['code'];

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
        }else if($role=="prof" || $role=="ins"){
            $this->groupStart();
            $this->where("tiquet.codi_centre_reparador",$code)->orWhere("tiquet.codi_centre_emissor",$code);
            $this->groupEnd();
        }else if($role=="alumn"){
            $this->groupStart();
            $this->where("tiquet.codi_centre_reparador",$code);
            $this->groupEnd();

        }else if($role=="sstt"){
            $this->groupStart();
            $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emissor.id_sstt",$code);
            $this->groupEnd();

        }
        
        return $this->first();
    }

    public function getTicketById($id)
    {
        $code=session()->get('user')['code'];
        $role=session()->get('user')['role'];

        $this->where('id', $id);
        $this->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left');
        $this->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left');
        
        if ($role=="admin") {
            $this;
        }else if($role=="prof" || $role=="ins"){
            $this->groupStart();
            $this->where("tiquet.codi_centre_reparador",$code)->orWhere("tiquet.codi_centre_emissor",$code);
            $this->groupEnd();
        }else if($role=="alumn"){
            $this->groupStart();
            $this->where("tiquet.codi_centre_reparador",$code);
            $this->groupEnd();
        }else if($role=="sstt"){
            $this->groupStart();
            $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emissor.id_sstt",$code);
            $this->groupEnd();
        }
        return $this->first();
    }

    public function getTicketsByMonths()
    {
        $role=session()->get('user')['role'];
        $code=session()->get('user')['code'];

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
        $code=session()->get('user')['code'];

        $this->select('
        tipus_dispositiu.nom AS tipus,
        , COUNT(tiquet.id) as count
        ');
        $this->join('tipus_dispositiu', 'tiquet.id_tipus_dispositiu = tipus_dispositiu.id');
        $this->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left');
        $this->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left');
        $this->groupBy('tipus');
        $this->orderBy('tipus_dispositiu.id');

        if ($role=="admin") {
            $this;
        }else if($role=="sstt"){
            $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emissor.id_sstt",$code);
        }
        return $this->findAll();
    }

    public function getTicketsByState()
    {

        $role=session()->get('user')['role'];
        $code=session()->get('user')['code'];

        $this->select('
        estat.nom AS estat,
        , COUNT(tiquet.id) as count
        ');
        $this->join('estat', 'tiquet.id_estat = estat.id');
        $this->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left');
        $this->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left');
        $this->groupBy('estat');
        $this->orderBy('estat.id');

        if ($role=="admin") {
            $this;
        }else if($role=="sstt"){
            $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emissor.id_sstt",$code);
        }
        return $this->findAll();
    }

    public function getInstituteTickets($id, $filter)
    {
      
        if ($filter == "sender") {

             return $this->select([
                "tiquet.id AS id, 
                tiquet.descripcio_avaria AS descripcio,
                tiquet.created_at AS created,
                tipus_dispositiu.nom AS tipus,
                estat.nom as estat,
                tiquet.id_estat as id_estat,
                COALESCE(centre_emissor.nom, '" . lang('titles.toassign') . "') AS emissor,
                COALESCE(centre_reparador.nom, '" . lang('titles.toassign') . "') AS receptor"
            ])
                ->join('tipus_dispositiu', 'tiquet.id_tipus_dispositiu = tipus_dispositiu.id')
                ->join('estat', 'tiquet.id_estat = estat.id')
                ->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left')
                ->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left')
                ->where("tiquet.codi_centre_emissor", $id);
                
        } else {

            return $this->select([
                "tiquet.id AS id, 
                tiquet.descripcio_avaria AS descripcio,
                tiquet.created_at AS created,
                tipus_dispositiu.nom AS tipus,
                estat.nom as estat,
                tiquet.id_estat as id_estat,
                COALESCE(centre_emissor.nom, '" . lang('titles.toassign') . "') AS emissor,
                COALESCE(centre_reparador.nom, '" . lang('titles.toassign') . "') AS receptor"
            ])
                ->join('tipus_dispositiu', 'tiquet.id_tipus_dispositiu = tipus_dispositiu.id')
                ->join('estat', 'tiquet.id_estat = estat.id')
                ->join('centre AS centre_emissor', 'tiquet.codi_centre_emissor = centre_emissor.codi', 'left')
                ->join('centre AS centre_reparador', 'tiquet.codi_centre_reparador = centre_reparador.codi', 'left')
                ->where("tiquet.codi_centre_reparador", $id);
        }
    }
}
