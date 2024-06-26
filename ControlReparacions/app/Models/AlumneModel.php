<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumneModel extends Model
{
    protected $table            = 'alumne';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'nom', 'cognoms', 'id_curs', 'codi_centre'];

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

    public function addAlumne($id, $nom, $cognoms, $id_curs, $codi_centre) {
           
        $data = [
            'id_user'       => $id,
            'nom'           => trim($nom),
            'cognoms'       => trim($cognoms),
            'id_curs'       => trim($id_curs),
            'codi_centre'   => trim($codi_centre),
        ];

        $this->insert($data);
    }

    public function getByTitleOrText($search)
    {

        return $this->select(['id_user','nom','cognoms','codi_centre'])->orLike('id_user', $search, 'both', true)->orLike('nom', $search, 'both', true);
    }

    public function getAllPaged($nElements)
    {

        return $this->select(['id_user','nom','cognoms','codi_centre'])->paginate($nElements);
    }
}
