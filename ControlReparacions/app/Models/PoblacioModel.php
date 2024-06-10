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
    protected $allowedFields    = ['id','nom','id_comarca'];

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

    public function addPoblacio($id,$nom,$id_comarca) {
           
        $data = [
            'id' =>  $id,
            'nom' => $nom,
            'id_comarca' => $id_comarca,
            
        ];

        $this->insert($data);
    }

    public function getAllPopulations(){
        return $this->select('id, nom')->findAll();
    }

    public function getAllPaged()
    {
        $role = session()->get('user')['role'];
        $ssttCode = session()->get('user')['code'];


            $this->select('poblacio.id, poblacio.nom, comarca.nom as comarca');
        
            $this->join('comarca', 'poblacio.id_comarca = comarca.codi');
            $this->join('centre', 'poblacio.id = centre.id_poblacio');
            $this->join('sstt', 'centre.id_sstt = sstt.codi');
            $this->where('sstt.codi', $ssttCode);
            $this->groupBy('poblacio.id, poblacio.nom, comarca.nom');

          
            return $this->findAll();
        
    }
}
