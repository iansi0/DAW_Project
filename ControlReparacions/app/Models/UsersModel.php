<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'user', 'passwd', 'lang'];

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

    public function addUser($id, $user, $passwd, $lang) {
           
        $data = [
            'id'            => $id,
            'user'            => $user,
            'passwd'         => trim($passwd),
            'lang'            => $lang
        ];

        $this->insert($data);
    }

    // FUNCIÓN EXCLUSIVA PARA OBTENER LA CONTRASEÑA DE LOGIN PARA UN USER
    public function getLoginByMail($user)
    {
        return $this->select("id, user, passwd")
                    ->orWhere('user', $user)
                    ->first();
        // dd($this->db->getLastQuery());
    }

    // Obtención de Usuario por ID (user_id)
    public function getUserById($id)
    {

        /*
            SQL Query (Change USER_ID to the id to search)

            SELECT users.id, users.user, users.lang
                , COALESCE(sstt.codi, centre.codi, professor.codi_centre, alumne.codi_centre, '') AS code
                , COALESCE(sstt.nom, centre.nom, CONCAT(professor.nom, ' ', COALESCE(professor.cognoms, '')), CONCAT(alumne.nom, ' ', COALESCE(alumne.cognoms, '')), '') AS name
                , COALESCE(sstt.adreca_fisica, centre.adreca_fisica, (SELECT centre.adreca_fisica FROM centre JOIN professor ON professor.codi_centre = centre.codi WHERE professor.id_user = 'USER_ID'), (SELECT centre.adreca_fisica FROM centre JOIN alumne ON alumne.codi_centre = centre.codi WHERE alumne.id_user = 'USER_ID'), '') AS adress
                , COALESCE(sstt.telefon, centre.telefon, '') AS phone
                , COALESCE(sstt.altres, CONCAT(centre.taller, ',', centre.actiu), professor.id_xtec, '') AS other
                , COALESCE(CONCAT(centre.nom_persona_contacte, ',', centre.correu_persona_contacte), '') AS contact
                , CASE
                    WHEN sstt.id_user IS NOT NULL THEN 'sstt'
                    WHEN centre.id_user IS NOT NULL THEN 'ins'
                    WHEN professor.id_user IS NOT NULL THEN 'prof'
                    WHEN alumne.id_user IS NOT NULL THEN 'alumn'
                    ELSE ''
                END AS type
            FROM users 
                LEFT JOIN sstt ON sstt.id_user = users.id
                LEFT JOIN centre ON centre.id_user = users.id
                LEFT JOIN professor ON professor.id_user = users.id
                LEFT JOIN alumne ON alumne.id_user = users.id
            WHERE users.id = 'USER_ID'
        
        */

        $id_str = $this->db->escape($id);

        $this->select(  "users.id, users.user, users.lang
                        ,COALESCE(sstt.codi, centre.codi, professor.codi_centre, alumne.codi_centre, '') AS code
                        ,COALESCE(sstt.nom, centre.nom, CONCAT(professor.nom, ' ', COALESCE(professor.cognoms, '')), CONCAT(alumne.nom, ' ', COALESCE(alumne.cognoms, '')), '') AS name
                        ,COALESCE(sstt.adreca_fisica, centre.adreca_fisica, (SELECT centre.adreca_fisica FROM centre JOIN professor ON professor.codi_centre = centre.codi WHERE professor.id_user = $id_str), (SELECT centre.adreca_fisica FROM centre JOIN alumne ON alumne.codi_centre = centre.codi WHERE alumne.id_user = $id_str), '') AS adress
                        ,COALESCE(sstt.telefon, centre.telefon, '') AS phone
                        ,COALESCE(sstt.altres, CONCAT(centre.taller, ',', centre.actiu), professor.id_xtec, '') AS other
                        ,COALESCE(CONCAT(centre.nom_persona_contacte, ',', centre.correu_persona_contacte), '') AS contact
                        ,CASE
                            WHEN sstt.id_user IS NOT NULL THEN 'sstt'
                            WHEN centre.id_user IS NOT NULL THEN 'ins'
                            WHEN professor.id_user IS NOT NULL THEN 'prof'
                            WHEN alumne.id_user IS NOT NULL THEN 'alumn'
                            ELSE ''
                        END AS type"
                    );
        $this->join('sstt', 'sstt.id_user = users.id', 'left');
        $this->join('centre', 'centre.id_user = users.id', 'left');
        $this->join('professor', 'professor.id_user = users.id', 'left');
        $this->join('alumne', 'alumne.id_user = users.id', 'left');

        $this->where('users.id', $id);

        $result = $this->first();
        
        return $result;
        // dd($this->db->getLastQuery());
    }

    // Cambiar lenguaje del user
    public function changeLang($lang)
    {
        if (session()->has("user") && !empty(session()->get("user"))) {
            return $this->update(session()->get('user')["uid"], ['lang'=>$lang]);
            // dd($this->db->getLastQuery());
        }
    }
}
