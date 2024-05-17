<?php

namespace App\Models;

use CodeIgniter\Model;

class IntervencioModel extends Model
{
    protected $table            = 'intervencio';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'descripcio', 'id_ticket', 'id_tipus', 'id_curs', 'correu_alumne', 'id_xtec'];

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

    public function addIntervencio($id, $descripcio, $id_ticket, $id_tipus, $id_curs, $persona_reparadora)
    {

        $data = [
            'id' =>  $id,
            'descripcio' => $descripcio,
            'id_ticket' => $id_ticket,
            'id_tipus' => $id_tipus,
            'id_curs' => $id_curs,
            'correu_alumne' => $persona_reparadora,
        ];

        $this->insert($data);
    }

    public function getInterventions($id)
    {
        return $this
            ->select([
                'intervencio.id',
                'intervencio.correu_alumne',
                'intervencio.id_tipus',
                'intervencio.descripcio',
                'intervencio.id_tipus',
                'intervencio.created_at',
                'inventari.preu as preu',
            ])
            ->join('inventari', 'intervencio.id = inventari.id_intervencio', 'left')
            ->where('intervencio.id_ticket', $id)
            ->findAll();
    }
}
