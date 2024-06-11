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
    protected $allowedFields    = ['codi', 'nom', 'id_sstt'];

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

    public function addComarca($codi, $nom, $ssttCode)
    {

        $data = [
            'codi' => htmlspecialchars(trim($codi)),
            'nom'  => htmlspecialchars(trim($nom)),
            'id_sstt'  => htmlspecialchars(trim($ssttCode)),
        ];

        $this->insert($data);
    }

    public function getAllPaged()
    {
        $ssttCode = session()->get('user')['code'];

        $this->select('comarca.codi, comarca.nom,');
    
        $this->join('poblacio', 'comarca.codi = poblacio.id_comarca');
        $this->join('centre', 'poblacio.id = centre.id_poblacio');
        $this->join('sstt', 'centre.id_sstt = sstt.codi');
        $this->where('centre.id_sstt', $ssttCode);
        $this->groupBy('comarca.codi, comarca.nom');

        return $this;
    }

    public function getByTitleOrText($search)
    {
        return $this->select(['codi', 'nom'])
                    ->orLike('codi', $search, 'both', true)
                    ->orLike('nom', $search, 'both', true);
    }

    public function modifyComarca($id, $nom)
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

    public function deleteComarca($id)
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
