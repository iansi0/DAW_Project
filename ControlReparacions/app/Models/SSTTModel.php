<?php

namespace App\Models;

use CodeIgniter\Model;

class SSTTModel extends Model
{
    protected $table            = 'sstt';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'codi', 'nom', 'adreca_fisica', 'cp', 'poblacio', 'telefon', 'altres'];

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

    public function addSSTT($id, $codi, $nom, $adreca_fisica, $cp, $poblacio, $telefon, $altres) {
           
        $data = [
            'id_user'       => htmlspecialchars($id),
            'codi'          => htmlspecialchars(trim($codi)),
            'nom'           => htmlspecialchars(trim($nom)),
            'adreca_fisica' => htmlspecialchars(trim($adreca_fisica)),
            'cp'            => htmlspecialchars(str_replace(' ', '', trim($cp))),
            'poblacio'      => htmlspecialchars(trim($poblacio)),
            'telefon'       => htmlspecialchars(str_replace(' ', '', trim($telefon))),
            'altres'        => htmlspecialchars(trim($altres))
            
        ];

        $this->insert($data);
    }

    public function getAllSSTT(){
        return $this->select('codi, nom')->findAll();
    }

    public function getSSTTById($id){
        return $this->where('codi', $id)->first();
    }

    public function modifySSTT($id, $data)
    {
        $role = session('user')['role'];
        
        if ($role == 'admin' || $role == 'sstt') {
            return $this->where('codi', $id)->set($data)->update();
        } else {
            return;
        }
    }
}
