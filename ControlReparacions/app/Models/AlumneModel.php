<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumneModel extends Model
{
    protected $table            = 'alumne';
    protected $primaryKey       = 'correu_alumne';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['correu_alumne','codi_centre'];

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

    public function addAlumne($correu_alumne,$codi_centre) {
           
        $data = [
            'correu_alumne' => $correu_alumne,
            'codi_centre' =>  $codi_centre,
        ];

        $this->insert($data);
    }
}
