<?php

namespace App\Models;

use CodeIgniter\Model;

class InventariModel extends Model
{
    protected $table            = 'inventaris';
    protected $primaryKey       = 'id_inventari';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_inventari','data_compra','preu','codi_centre','id_tipus_inventari'];

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

    public function addInventari($id_inventari,$data_compra,$preu,$codi_centre,$id_tipus_inventari) {
           
        $data = [
            'id_inventari' =>  $id_inventari,
            'data_compra' => $data_compra,
            'preu' => $preu,
            'codi_centre' => $codi_centre,
            'id_tipus_inventari' => $id_tipus_inventari,
        ];

        $this->insert($data);
    }
}
