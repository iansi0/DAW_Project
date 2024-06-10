<?php

namespace App\Models;

use CodeIgniter\Model;

class ComarcaModel extends Model
{
    protected $table            = 'comarca';
    protected $primaryKey       = 'codi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['codi', 'nom'];

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

    public function addComarca($codi, $nom)
    {

        $data = [
            'codi' =>  $codi,
            'nom' => $nom,
        ];

        $this->insert($data);
    }

    public function getAllPaged()
    {
        $role = session()->get('user')['role'];
        $ssttCode = session()->get('user')['code'];


            $this->select('comarca.codi, comarca.nom,');
        
            $this->join('poblacio', 'comarca.codi = poblacio.id_comarca');
            $this->join('centre', 'poblacio.id = centre.id_poblacio');
            $this->join('sstt', 'centre.id_sstt = sstt.codi');
            $this->where('centre.id_sstt', $ssttCode);
            return $this->groupBy('comarca.codi, comarca.nom');

          
        
        
    }

    public function getByTitleOrText($search)
    {
        
        return $this->select(['codi', 'nom'])
        ->orLike('codi', $search, 'both', true)
        ->orLike('nom', $search, 'both', true);
    }

}
