<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\ComarcaModel;

class COMARCASeeder extends Seeder
{
    public function run()
    {
        // Cargamos el archivo CSV desde la siguiente ruta
        $csvFile = fopen(WRITEPATH . 'install'.DIRECTORY_SEPARATOR.'CENTRE_seeder.csv', "r");
        // Boolean para saltarnos la primera fila (es una fila con los nombres de los campos y por ende la descartamos)
        $firstLine = true;

        // Array para guardar los id de comarca para no ir repitiendo
        $arrComarca = [];

        // Insertar los datos en la base de datos
        while (($row = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstLine) {

                // Creamos un Modelo Comarca y lo añadimos
                $comarca = new ComarcaModel();

                /*

                    PARÁMETROS DE addComarca()
                    +---------------+
                    | codi_comarca  |
                    | nom           |
                    +---------------+
                    
                */

                // Si no existe en el array, generamos la comarca en BBDD y guardamos el id en el array
                if (!in_array($arrComarca, $row[11])) {
                    $comarca -> addComarca( 
                        trim($row[11]), 
                        trim($row[12])
                    );

                    $arrComarca[] = $row[11];
                }

            }

            $firstLine = false;

        }

        fclose($csvFile);

    }

}
