<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersInRolesModel extends Model
{
    protected $table            = 'users_in_roles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'id_user', 'id_role'];

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

    public function addUserRole($id, $user, $role) {
           
        $data = [
            'id'            => $id,
            'id_user'          => trim($user),
            'id_role'          => trim($role)
        ];

        $this->insert($data);
    }

    public function getRoleByUser($id_user){
        d($id_user);
        $result = $this->select('roles.role as role')
        ->join('roles', 'users_in_roles.id_role = roles.id')
        ->where('users_in_roles.id_user' , $id_user)
        ->findAll();
        
        d($result);
        return $result;
        ;
    }
}
