<?php

namespace App\Models;

use CodeIgniter\Model;


class InventariModel extends Model
{
    protected $table            = 'inventari';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'nom', 'data_compra', 'preu',  'codi_centre', 'id_tipus_inventari', 'id_intervencio'];

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

    public function addInventari($id_inventari, $nom, $data_compra, $preu, $codi_centre, $id_tipus_inventari)
    {

        $data = [
            'id' =>  $id_inventari,
            'nom' => $nom,
            'data_compra' => $data_compra,
            'preu' => $preu,
            'codi_centre' => $codi_centre,
            'id_tipus_inventari' => $id_tipus_inventari,
            'id_intervencio' => null,
        ];

        $this->insert($data);
    }

    public function getByTitleOrText($search)
    {
        return $this->select("
        inventari.id AS id, 
        inventari.nom as nom,
        inventari.preu AS preu, 
        inventari.data_compra AS data_compra,
        inventari.id_tipus_inventari AS tipus,
        tipus_inventari.nom as nomInventary
        ")
            ->join('tipus_inventari', 'inventari.id_tipus_inventari = tipus_inventari.id');
        // ->where('codi_centre', session('user')['code']);


    }

    public function getAllPaged()
    {

        return $this->select("
        inventari.id AS id, 
        inventari.nom as nom,
        inventari.preu AS preu, 
        inventari.data_compra AS data_compra,
        inventari.id_tipus_inventari AS tipus,
        tipus_inventari.nom as nomInventary
        ")
            ->join('tipus_inventari', 'inventari.id_tipus_inventari = tipus_inventari.id');
        // ->where('codi_centre', session('user')['code']);

    }

    public function deleteInventari($id)
    {
        return $this->where('id', $id)->delete();
    }

    public function modifyInventari($id, $data)
    {
        return $this->where('id', $id)->set($data)->update();
    
    }

    public function getInventarytById($id)
    {
        return $this->where('inventari.id', $id)->first();
    }

    public function getInventaryNoAssigned()
    {
        return $this->select('id, nom')->where('id_intervencio', null)->findAll();
    }
}
