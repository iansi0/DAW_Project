<?php

namespace App\Models;

use CodeIgniter\Model;

class CentreModel extends Model
{
    protected $table            = 'centre';
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

    public function getAllCenter(){
        $role=session()->get('user')['role'];
        $code=session()->get('user')['code'];

        $this->select('codi, nom');
        
        if ($role=="admin") {
            $this;
        }else if($role=="prof" || $role=="alumn"){
            $this->where("centre_reparador.id",$code);
        }else if($role=="sstt"){
            $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emisor.id_sstt",$code);
        }else if($role=="ins"){
            $this->where("centre_reparador.codi",$code)->orWhere("centre_emissor.codi",$code);
        }

        return $this->findAll();
    }
    
    public function getAllRepairCenters(){
         
        $role=session()->get('user')['role'];
        $code=session()->get('user')['code'];
        
        $this->select('codi, nom')->where('actiu', true)->where('taller', true);
        
        if ($role=="admin") {
            $this;
        }else if($role=="prof" || $role=="alumn"){
            $this->where("centre_reparador.id",$code);
        }else if($role=="sstt"){
            $this->where("centre_reparador.id_sstt",$code)->orWhere("centre_emisor.id_sstt",$code);
        }else if($role=="ins"){
            $this->where("centre_reparador.codi",$code)->orWhere("centre_emissor.codi",$code);
        }

        return $this->findAll();
    }
}
