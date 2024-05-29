<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\ProfessorModel;

use Faker\Factory;

class PROFESSORSeeder extends Seeder
{
    public function run()
    {

        /**
         * 
         * ESTE SEEDER TAN SOLO ES RELLENO DE DATOS PERO NO VAN A TENER LOGIN
         * SI LO QUE QUIERE ES TENER PROFESORES CON LOGIN VE A USERSSeeder.php
         * 
         */

        $fake = Factory::create("es_ES");

        for ($i = 0; $i < 10; $i++) {
            $professor = new ProfessorModel();

            $arrCentres = ['25002799', '17010700', '17010499', '17008249', '8000013', '8001509', '8002198', '8015399', '8017104', '8019401'];
            $rnd = rand(0, count($arrCentres) - 1);

            /*

                PARÁMETROS DE addProfessor()
                +--------------+
                | id_user      |
                | nom          |
                | cognoms      |
                | codi_centre  |
                +--------------+
                    
            */

            $professor->addProfessor(
                $fake->uuid(),
                $fake->name(),
                $fake->lastName(),
                $arrCentres[$rnd]
            );

        }
    }
}
