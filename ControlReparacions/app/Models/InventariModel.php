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
            'id' =>  htmlspecialchars(trim($id_inventari)),
            'nom' => htmlspecialchars(trim($nom)),
            'data_compra' => htmlspecialchars(trim($data_compra)),
            'preu' => htmlspecialchars(trim($preu)),
            'codi_centre' => htmlspecialchars(trim($codi_centre)),
            'id_tipus_inventari' => htmlspecialchars(trim($id_tipus_inventari)),
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
            ->join('tipus_inventari', 'inventari.id_tipus_inventari = tipus_inventari.id')
            ->orLike('inventari.id', $search, 'both', true)
            ->orLike('inventari.nom', $search, 'both', true)
            ->orLike('inventari.preu', $search, 'both', true)
            ->orLike('inventari.data_compra', $search, 'both', true)
            ->orLike('tipus_inventari.nom', $search, 'both', true)
            ;
        // ->where('codi_centre', session('user')['code']);
    }

    public function getAllPaged()
    {
        $role = session()->get('user')['role'];
        $code = session()->get('user')['code'];

        $this->select("
        inventari.id AS id, 
        inventari.nom as nom,
        inventari.preu AS preu, 
        inventari.data_compra AS data_compra,
        inventari.id_tipus_inventari AS tipus,
        tipus_inventari.nom as nomInventary
        ");

        $this->join('tipus_inventari', 'inventari.id_tipus_inventari = tipus_inventari.id');

        if ($role == "admin") {
            $this;
        } else if ($role == "prof" || $role == "alumn" || $role == "ins") {
            $this->where("inventari.codi_centre", $code);
        } else if ($role == "sstt") {
            $this->where("centre_reparador.id_sstt", $code)->orWhere("centre_emissor.id_sstt", $code);
        } 
        return $this;
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

    public function getInventaryAssigned($id)
    {
        return $this->select('id, nom')->where('id_intervencio', $id)->findAll();
    }

    public function unassignInventary($id){

        $data = [
            'id_intervencio' => null,
        ];
        return $this->where('id_intervencio', $id)->set($data)->update();
    }
}
