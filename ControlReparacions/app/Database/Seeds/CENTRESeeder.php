<?php

namespace App\Database\Seeds;

// use App\Libraries\UUID as LibrariesUUID;
use CodeIgniter\Database\Seeder;
use App\Models\CentreModel;

use Faker\Factory;

class CENTRESeeder extends Seeder
{
    public function run()
    {

        /**
         * 
         * ESTE SEEDER TAN SOLO ES RELLENO DE DATOS PERO NO VAN A TENER LOGIN
         * SI LO QUE QUIERE ES TENER CENTROS CON LOGIN VE A USERSSeeder.php
         * 
         */

        $fake = Factory::create("es_ES");

        // Cargamos el archivo CSV desde la siguiente ruta
        $csvFile = fopen(WRITEPATH . 'install'.DIRECTORY_SEPARATOR.'CENTRE_seeder.csv', "r");
        // Boolean para saltarnos la primera fila (es una fila con los nombres de los campos y por ende la descartamos)
        $firstLine = true;

        // Insertar los datos en la base de datos
        while (($row = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstLine) {

                if (trim($row[2] == 1)) {

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
                    | correu_persona_contacte        |                  |
                    | id_sstt                        |
                    | id_poblacio                    |
                    +--------------------------------+
                    
                    */
                    $centre -> addCentre(
                        $fake->uuid(),
                        trim($row[0]),
                        str_replace('"', '\"', trim($row[1])),
                        false,
                        false,
                        str_replace(' ', '', trim($row[8])),
                        trim($row[6]),
                        $fake->name(),
                        trim($row[23]),
                        trim($row[9]),
                        trim($row[13])
                    );
    
                }

            }

            $firstLine = false;

        }

        fclose($csvFile);
    }
}
