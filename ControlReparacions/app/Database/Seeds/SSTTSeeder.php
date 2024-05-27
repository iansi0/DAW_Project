<?php

namespace App\Database\Seeds;

use App\Libraries\UUID as LibrariesUUID;
use CodeIgniter\Database\Seeder;
use App\Models\SSTTModel;

class SSTTSeeder extends Seeder
{
    public function run()
    {
        // Cargamos el archivo CSV desde la siguiente ruta
        $csvFile = fopen(WRITEPATH . 'install'.DIRECTORY_SEPARATOR.'SSTT_seeder.csv', "r");
        // Boolean para saltarnos la primera fila (es una fila con los nombres de los campos y por ende la descartamos)
        $firstLine = true;

        // Insertar los datos en la base de datos
        while (($row = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstLine) {

                // Generamos un UUID
                $uuid = LibrariesUUID::v4();

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

            }

            $firstLine = false;

        }

        fclose($csvFile);

    }
}
