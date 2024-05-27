<?php

namespace App\Database\Seeds;

use App\Models\EstatModel;
use CodeIgniter\Database\Seeder;

class ESTATSeeder extends Seeder
{
    public function run()
    {
        // Cargamos el archivo CSV desde la siguiente ruta
        $csvFile = fopen(WRITEPATH . 'install'.DIRECTORY_SEPARATOR.'TIPUS_seeder.csv', "r");
        // Boolean para saltarnos la primera fila (es una fila con los nombres de los campos y por ende la descartamos)
        $firstLine = true;

        // Insertar los datos en la base de datos
        while (($row = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstLine) {

                // Creamos un Modelo Comarca y lo añadimos
                $estat = new EstatModel();

                /*

                    PARÁMETROS DE addEstat()
                    +------+
                    | id   |
                    | nom  |
                    +------+
                    
                */

                if ($row[1] != '') {
                    $estat -> addEstat(
                        trim($row[0]),
                        trim($row[1])
                    ); 
                } else {
                    break; // Paramos ejecución ya que no hay mas datos y no hace falta continuar
                }         

            }

            $firstLine = false;

        }

        fclose($csvFile);

    }
}
