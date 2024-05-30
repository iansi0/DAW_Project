<?php

namespace App\Models;

use CodeIgniter\Model;

class CursModel extends Model
{
    protected $table            = 'curs';
    protected $primaryKey       = 'idcurs';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'curs', 'any', 'titol', 'codi_centre'];

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

    public function addCurs($id, $curs, $any, $titol, $codi_centre) {
           
        $data = [
            'id' =>  $id,
            'curs' => $curs,
            'any' => $any,
            'titol' => $titol,
            'codi_centre' => $codi_centre,
        ];

        $this->insert($data);
    }
}
