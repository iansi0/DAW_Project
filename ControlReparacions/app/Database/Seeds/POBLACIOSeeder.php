<?php

namespace App\Database\Seeds;

use App\Models\PoblacioModel;
use CodeIgniter\Database\Seeder;

class POBLACIOSeeder extends Seeder
{
    public function run()
    {
        // Cargamos el archivo CSV desde la siguiente ruta
        $csvFile = fopen(WRITEPATH . 'install'.DIRECTORY_SEPARATOR.'CENTRE_seeder.csv', "r");
        // Boolean para saltarnos la primera fila (es una fila con los nombres de los campos y por ende la descartamos)
        $firstLine = true;

        // Array para guardar los id de comarca para no ir repitiendo
        $arrPoblacio = [];

        // Insertar los datos en la base de datos
        while (($row = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstLine) {

                // Creamos un Modelo Comarca y lo añadimos
                $poblacio = new PoblacioModel();

                /*

                    PARÁMETROS DE addComarca()
                    +---------------+
                    | id            |
                    | nom           |
                    | id_comarca    |
                    +---------------+
                    
                */

                // Si no existe en el array, generamos la comarca en BBDD y guardamos el id en el array
                if (!in_array($arrPoblacio, $row[11])) {
                    $poblacio -> addPoblacio( 
                        trim($row[13]),
                        trim($row[14]),
                        trim($row[11])
                    );

                    $arrPoblacio[] = $row[13];
                }

            }

            $firstLine = false;

        }

        fclose($csvFile);

    }
}
