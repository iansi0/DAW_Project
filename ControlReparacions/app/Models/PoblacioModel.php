<?php

namespace App\Models;

use CodeIgniter\Model;

class PoblacioModel extends Model
{
    protected $table            = 'poblacio';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','nom','id_comarca','id_sstt'];

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

    public function addPoblacio($id,$nom,$id_comarca,$ssttCode) {
           
        $data = [
            'id'         => htmlspecialchars(trim($id)),
            'nom'        => htmlspecialchars(trim($nom)),
            'id_comarca' => htmlspecialchars(trim($id_comarca)),
            'id_sstt' => htmlspecialchars(trim($ssttCode)),
        ];

        $this->insert($data);
    }

    public function getAllPopulations(){
        return $this->select('id, nom')->findAll();
    }

    public function getAllPaged()
    {

        $ssttCode = session()->get('user')['code'];

        $this->select('poblacio.id, poblacio.nom, comarca.nom as comarca');
            $this->join('comarca', 'poblacio.id_comarca = comarca.codi');
            $this->join('centre', 'poblacio.id = centre.id_poblacio');
            $this->join('sstt', 'centre.id_sstt = sstt.codi');
            $this->where('sstt.codi', $ssttCode);
            
        return $this->groupBy('poblacio.id, poblacio.nom, comarca.nom');

    }

    public function getByTitleOrText($search)
    {

        return $this->select('poblacio.id, poblacio.nom, comarca.nom as comarca')
        
            ->join('comarca', 'poblacio.id_comarca = comarca.codi')
            ->join('centre', 'poblacio.id = centre.id_poblacio')
            ->join('sstt', 'centre.id_sstt = sstt.codi')
            ->orLike('poblacio.id', $search, 'both', true)
            ->orLike('poblacio.nom', $search, 'both', true)
            ->orLike('comarca', $search, 'both', true);
    }

    public function modifyPoblacio($id, $nom)
    {

        $data = [
            'nom' => htmlspecialchars(trim($nom)),
        ];

        $role = session()->get('user')['role'];
    
        if($role == "sstt"){
            $this->groupStart();
                $this->where("id_sstt", session('user')['code']);
            $this->groupEnd();
        }else if ($role != 'admin') {
            return;
        }

        return $this->set($data)->update($id);
        // dd($this->db->getLastQuery());

    }

    public function deletePoblacio($id)
    {

        $role = session()->get('user')['role'];
    
        if($role == "sstt"){
            $this->groupStart();
                $this->where("id_sstt", session('user')['code']);
            $this->groupEnd();
        }else if ($role != 'admin') {
            return;
        }

        return $this->delete($id);
        // dd($this->db->getLastQuery());

    }

}
