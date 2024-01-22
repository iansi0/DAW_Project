<?php

namespace App\Models;

use CodeIgniter\Model;

class IntervencioModel extends Model
{
    protected $table            = 'intervencios';
    protected $primaryKey       = 'id_intervencio';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_intervencio','descripcio_intervencio','data_intervencio','id_tipus_intervencio','id_curs','correu_alumne','id_xtec'];

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

    public function addIntervencio($id_intervencio,$descripcio_intervencio,$data_intervencio,$id_tipus_intervencio,$id_curs,$correu_alumne,$id_xtec) {
           
        $data = [
            'id_intervencio' =>  $id_intervencio,
            'descripcio_intervencio' => $descripcio_intervencio,
            'data_intervencio' => $data_intervencio,
            'id_tipus_intervencio' => $id_tipus_intervencio,
            'id_curs' => $id_curs,
            'correu_alumne' => $correu_alumne,
            'id_xtec' => $id_xtec,
        ];

        $this->insert($data);
    }
}
