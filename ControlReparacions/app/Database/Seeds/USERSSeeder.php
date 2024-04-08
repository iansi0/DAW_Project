<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Libraries\UUID as LibrariesUUID;
use App\Models\RolesModel;
use App\Models\UsersInRolesModel;
use App\Models\UsersModel;

class USERSSeeder extends Seeder
{
    public function run()
    {

        /////////////////////
        // AÑADIR USUARIOS //
        /////////////////////

        $arrUsers_id = [];

        // Generamos un UUID
        $uuid = LibrariesUUID::v4();
        $arrUsers_id[] = $uuid;

        // Creamos un Modelo Users y lo añadimos
        $user = new UsersModel();

        /*

            PARÁMETROS DE addUser()
            +----------+
            | id       |
            | password |
            +----------+
                
        */

        $user -> addUser( 
            $uuid, 
            password_hash('1234', PASSWORD_DEFAULT)
        );

        //////////////////
        // AÑADIR ROLES //
        //////////////////

        $arrRoles = ['admin']; // Añadir roles segun convenga
        $arrRoles_id = [];

        for ($i=0; $i < count($arrRoles); $i++) { 

            // Generamos un UUID
            $uuid = LibrariesUUID::v4();
            $arrRoles_id[] = $uuid;

            // Creamos un Modelo Roles y lo añadimos
            $role = new RolesModel();

            /*

                PARÁMETROS DE addRole()
                +------+
                | id   |
                | role |
                +------+
                
            */

            $role -> addRole( 
                $uuid, 
                $arrRoles[$i]
            );

        }

        /////////////////////////////
        // AÑADIR ROLES A USUARIOS //
        /////////////////////////////

        // Generamos un UUID
        $uuid = LibrariesUUID::v4();

        // Creamos un Modelo UserInRoles y lo añadimos
        $user_role = new UsersInRolesModel();

        /*

            PARÁMETROS DE addUserRole()
            +---------+
            | id      |
            | id_user |
            | id_role |
            +---------+
            
        */

        $user_role -> addUserRole( 
            $uuid, 
            $arrUsers_id[0],
            $arrRoles_id[0]
        );
        
    }
}
