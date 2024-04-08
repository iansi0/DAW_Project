<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\TiquetModel;

use Faker\Factory;

class TIQUETSeeder extends Seeder
{
    public function run()
    {
        $fake = Factory::create("es_ES");

        for ($i=0; $i < 20; $i++) { 
            $tiquet = new TiquetModel();

            /*

                PARÁMETROS DE addTiquet()
                +---------------------------------+
                | id_tiquet                       |
                | codi_equip                      |
                | descripcio_avaria               |
                | nom_persona_contacte_centre     |
                | correu_persona_contacte_centre  |
                | id_tipus_dispositiu             |
                | id_estat                        |
                | codi_centre_emissor             |
                | codi_centre_reparador           |
                +---------------------------------+

            */

            $arrCentres = ['25002799', '17010700', '17010499', '17008249', '8000013', '8001509', '8002198', '8015399', '8017104', '8019401'];

            $tiquet->addTiquet(
                $fake->uuid(),
                $fake->uuid(),
                $fake->text(25),
                $fake->name()." ".$fake->lastName(),
                $fake->email(),
                rand(0, 9),
                rand(0, 13),    
                $arrCentres[rand((count($arrCentres)/2)-1, count($arrCentres)-1)],
                $arrCentres[rand(count($arrCentres)-1, (count($arrCentres)/2)-1)]
            );
        }
    }
}
