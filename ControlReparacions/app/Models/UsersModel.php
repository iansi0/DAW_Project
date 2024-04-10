<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'USERS';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'passwd'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

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

    public function addUser($id, $passwd) {
           
        $data = [
            'id'            => $id,
            'passwd'        => trim($passwd)
        ];

        $this->insert($data);
    }

    // Obtenemos user por Mail
    public function getUserByMail($email)
    {

        // Consulta SSTT
        $this->select('*');
        $this->from('sstt');
        $this->where('correu', $email);
        $this->limit(1);
        $query1 = $this->get();

        if ($query1->num_rows() > 0) {
            # code...
        }

        // Consulta Professor
        $this->select('*');
        $this->from('professor');
        $this->where('correu_professor', $email);
        $this->limit(1); // Limitamos a 1 resultado
        $query2 = $this->get();

        // Consulta Alumne
        $this->select('*');
        $this->from('alumnes');
        $this->where('correu_alumne', $email);
        $this->limit(1);
        $query3 = $this->get();

        $result = NULL;
        if ($query1->num_rows() > 0) {
            $result = $query1->row_array();
        } elseif ($query2->num_rows() > 0) {
            $result = $query2->row_array();
        } elseif ($query3->num_rows() > 0) {
            $result = $query3->row_array();
        }

        return $result;
        // dd($this->db->getLastQuery());
    }
}
