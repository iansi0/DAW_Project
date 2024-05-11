<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\AlumneModel;

use Faker\Factory;

class ALUMNESeeder extends Seeder
{
    public function run()
    {
        $fake = Factory::create("es_ES");

        for ($i = 0; $i < 20; $i++) {
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

                $fake->uuid(),
                $fake->name(),
                $fake->lastName(),
                $fake->email(),
                $arrCurs[$rndCurs],
                $arrCentres[$rndCentre]
            );

        }
    }
}
