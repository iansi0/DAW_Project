<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Libraries\UUID as LibrariesUUID;
use Faker\Factory;

use App\Models\UsersModel;
use App\Models\SSTTModel;
use App\Models\CentreModel;
use App\Models\ProfessorModel;
use App\Models\LlistaAdmesosModel;
use App\Models\AlumneModel;
use App\Models\RolesModel;
use App\Models\UsersInRolesModel;

class USERSSeeder extends Seeder
{
    public function run()
    {
        $fake = Factory::create("es_ES");

        echo("START ROLE\n");

        /**
        * AÑADIR ROLES
        */

        $arrRoles = ['admin', 'sstt', 'ins', 'prof', 'alumn']; // Añadir roles segun convenga
        $role_id = [];

        for ($i=0; $i < count($arrRoles); $i++) { 

            // Generamos un UUID
            $uuid = LibrariesUUID::v4();
            $role_id[] = $uuid;

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

        echo("ROLES DONE\n");

        echo("START ADMIN\n");

        /**
         * AÑADIR ADMINISTRADOR
         */
        
        // Generamos un UUID
        $uuid = LibrariesUUID::v4();
        $user_id = $uuid;

        // Creamos un Modelo Users y lo añadimos
        $user = new UsersModel();

        /*

            PARÁMETROS DE addUser()
            +----------+
            | id       |
            | user     |
            | password |
            | language |
            +----------+
                
        */

        $user -> addUser( 
            $uuid,
            'admin',
            password_hash('1234', PASSWORD_DEFAULT),
            'es',
        );

        /**
         * AÑADIR ROLES DE ADMIN A USER ADMIN
         */

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
            LibrariesUUID::v4(), 
            $user_id,
            $role_id[0]
        );

        unset($role_id[0]);

        echo("ADMIN DONE\n");

        echo("START SSTT\n");

        /**
         * AÑADIR SSTT
         */

        // Cargamos el archivo CSV desde la siguiente ruta
        $csvFile = fopen(WRITEPATH . 'install'.DIRECTORY_SEPARATOR.'SSTT_seeder.csv', "r");
        // Boolean para saltarnos la primera fila (es una fila con los nombres de los campos y por ende la descartamos)
        $firstLine = true;

        // Insertar los datos en la base de datos
        while (($row = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstLine) {

                // AÑADIR USUARIO SSTT //
                
                // Generamos un UUID
                $uuid = LibrariesUUID::v4();

                $user -> addUser( 
                    $uuid, 
                    trim($row[6]),
                    password_hash('1234', PASSWORD_DEFAULT),
                    'cat'
                );

                // Creamos un Modelo SSTT y lo añadimos
                $sstt = new SSTTModel();

                /*

                    PARÁMETROS DE addSSTT()
                    +---------------+
                    | id_user       |
                    | codi          |
                    | nom           |
                    | adreca_fisica |
                    | cp            |
                    | poblacio      |
                    | telefon       |
                    | altres        |
                    +---------------+
                    
                */

                $sstt -> addSSTT( 
                    $uuid, 
                    trim($row[0]), 
                    trim($row[1]), 
                    trim($row[2]), 
                    str_replace(' ', '', trim($row[3])), 
                    trim($row[4]), 
                    str_replace(' ', '', trim($row[5])), 
                    trim($row[7])
                );

                // Le añadimos el rol de SSTT
                $user_role -> addUserRole( 
                    LibrariesUUID::v4(),
                    $uuid,
                    $role_id[1]
                );

            }

            $firstLine = false;

        }

        fclose($csvFile);

        echo("SSTT DONE\n");

        echo("START INSTITUTE\n");

        /**
         * AÑADIR INSTITUTOS
         */

        // Cargamos el archivo CSV desde la siguiente ruta
        $csvFile = fopen(WRITEPATH . 'install'.DIRECTORY_SEPARATOR.'CENTRE_seeder.csv', "r");
        // Boolean para saltarnos la primera fila (es una fila con los nombres de los campos y por ende la descartamos)
        $firstLine = true;
        $count = 0;

        // Insertar los datos en la base de datos 
        // PARA EL 100% DEL ARCHIVO COMENTAR LA PARTE DE - && $count < 20 -
        // while (($row = fgetcsv($csvFile, 2000, ",")) !== FALSE && $count < 20) {
        while (($row = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstLine) {

                if (trim($row[2] == 1)) {

                    $count++;

                    // Generamos un UUID
                    $uuid = LibrariesUUID::v4();

                    $user -> addUser( 
                        $uuid, 
                        trim($row[23]),
                        password_hash('1234', PASSWORD_DEFAULT),
                        'cat'
                    );

                    $centre = new CentreModel();

                    /*

                        PARÁMETROS DE addCentre()
                        +--------------------------------+                    
                        | id_user                        |
                        | codi                           |
                        | nom                            |
                        | actiu                          |
                        | taller                         |
                        | telefon                        |
                        | adreca_fisica                  |
                        | nom_persona_contacte           |
                        | correu_persona_contacte        |
                        | id_sstt                        |
                        | id_poblacio                    |
                        +--------------------------------+
                    
                    */
                                
                    $centre -> addCentre(
                        $uuid,
                        trim($row[0]),
                        trim($row[1]),
                        false,
                        false,
                        str_replace(' ', '', trim($row[8])),
                        trim($row[6]),
                        '',
                        trim($row[23]),
                        trim($row[9]),
                        trim($row[13])
                    );

                    // Le añadimos el rol de INS
                    $user_role -> addUserRole( 
                        LibrariesUUID::v4(),
                        $uuid,
                        $role_id[1]
                    );
    
                }

            }

            $firstLine = false;

        }

        fclose($csvFile);

        echo("INSTITUTE DONE\n");

        echo("START PROF\n");

        /**
         * AÑADIR PROFESORES
         */

        for ($i = 0; $i < 10; $i++) {
            
            // Generamos un UUID
            $uuid = LibrariesUUID::v4();

            $user -> addUser( 
                $uuid, 
                $fake->userName(),
                password_hash('1234', PASSWORD_DEFAULT),
                'cat'
            );

            $professor = new ProfessorModel();

            $arrCentres = ['25002799', '17010700', '17010499', '17008249', '8000013', '8001509', '8002198', '8015399', '8017104', '8019401'];
            $rnd = rand(0, count($arrCentres) - 1);

            /*

                PARÁMETROS DE addProfessor()
                +------------------+
                | id_user          |
                | id_xtec          |
                | nom_professor    |
                | cognom_professor |
                | codi_centre      |
                +------------------+
                    
            */

            $professor->addProfessor(
                $uuid,
                $fake->userName(),
                $fake->name(),
                $fake->lastName(),
                $arrCentres[$rnd]
            );

            // Le añadimos el rol de PROF
            $user_role -> addUserRole( 
                LibrariesUUID::v4(),
                $uuid,
                $role_id[3]
            );

            // Al mismo añadir al profesor, lo añadimos a la "whiteList"
            $admesos = new LlistaAdmesosModel();
            
            /*

                PARÁMETROS DE addLlistaAdmesos()
                +------------------+
                | id_user          |
                | data_entrega     |
                | codi_centre      |
                +------------------+
                    
            */
            $admesos->addLlistaAdmesos(
                $uuid,
                $fake->date(),
                $arrCentres[$rnd]
            );

            echo("PROF DONE\n");

            echo("START ALUMN\n");

            /**
            * AÑADIR ALUMNOS
            */

            for ($i = 0; $i < 20; $i++) {

                // Generamos un UUID
                $uuid = LibrariesUUID::v4();

                $user -> addUser( 
                    $uuid, 
                    $fake->userName(),
                    password_hash('1234', PASSWORD_DEFAULT),
                    'cat'
                );

                $alumne = new AlumneModel();
    
                /*
    
                    PARÁMETROS DE addAlumne()
                    +--------------+
                    | correu       |
                    | codi_centre  |
                    +--------------+
                        
                */
    
                $arrCentres = ['25002799', '17010700', '17010499', '17008249', '8000013', '8001509', '8002198', '8015399', '8017104', '8019401'];
                $rndCentre = rand(0, count($arrCentres) - 1);
                $arrCurs = [0,1,2,3,4,5,6,7,8];
                $rndCurs = rand(0, count($arrCurs) - 1);

                $alumne->addAlumne(

                    $uuid,
                    $fake->name(),
                    $fake->lastName(),
                    $fake->email(),
                    $arrCurs[$rndCurs],
                    $arrCentres[$rndCentre]
                );

                // Le añadimos el rol de ALUMN
                $user_role -> addUserRole( 
                    LibrariesUUID::v4(),
                    $uuid,
                    $role_id[4]
                );
    
            }

        }

        echo("ALUMN DONE\n");
        
    }
}
