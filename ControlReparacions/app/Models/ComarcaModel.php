<?php

namespace App\Models;

use CodeIgniter\Model;

class ComarcaModel extends Model
{
    protected $table            = 'comarcas';
    protected $primaryKey       = 'id_comarca';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_comarca','nom_comarca'];

    // Dates
    protected $useTimestamps = false;
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

    public function addComarca($id_comarca,$nom_comarca) {
           
        $data = [
            'id_comarca' =>  $id_comarca,
            'nom_comarca' => $nom_comarca,
        ];

        $this->insert($data);
    }

}
