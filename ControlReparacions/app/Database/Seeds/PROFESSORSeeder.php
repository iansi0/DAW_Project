<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\ProfessorModel;
use App\Models\LlistaAdmesosModel;

use Faker\Factory;

class PROFESSORSeeder extends Seeder
{
    public function run()
    {
        $fake = Factory::create("es_ES");

        for ($i = 0; $i < 10; $i++) {
            $professor = new ProfessorModel();

            $arrCentres = ['25002799', '17010700', '17010499', '17008249', '8000013', '8001509', '8002198', '8015399', '8017104', '8019401'];
            $rnd = rand(0, count($arrCentres) - 1);
            $xtecRnd = rand(0, 99);

            /*

                PARÁMETROS DE addProfessor()
                +------------------+
                | id_xtec          |
                | nom_professor    |
                | cognom_professor |
                | correu_professor |
                | codi_centre      |
                +------------------+
                    
            */

            $professor->addProfessor(
                $fake->name().$xtecRnd,
                $fake->name(),
                $fake->lastName(),
                $fake->name().$xtecRnd."@xtec.cat",
                $arrCentres[$rnd]
            );

            // Al mismo añadir al profesor, lo añadimos a la "whiteList"
            $admesos = new LlistaAdmesosModel();
            
            /*

                PARÁMETROS DE addLlistaAdmesos()
                +------------------+
                | correu_professor |
                | data_entrega     |
                | codi_centre      |
                +------------------+
                    
            */
            $admesos->addLlistaAdmesos(
                $fake->name().$xtecRnd."@xtec.cat",
                $fake->date(),
                $arrCentres[$rnd]
            );

        }
    }
}
