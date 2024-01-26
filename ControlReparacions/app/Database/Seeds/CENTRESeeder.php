<?php

namespace App\Database\Seeds;

// use App\Libraries\UUID as LibrariesUUID;
use CodeIgniter\Database\Seeder;
use App\Models\CentreModel;


class CENTRESeeder extends Seeder
{
    public function run()
    {
        // Cargamos el archivo CSV desde la siguiente ruta
        $csvFile = fopen(WRITEPATH . 'install'.DIRECTORY_SEPARATOR.'CENTRE_seeder.csv', "r");
        // Boolean para saltarnos la primera fila (es una fila con los nombres de los campos y por ende la descartamos)
        $firstLine = true;

        // Insertar los datos en la base de datos
        while (($row = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if ($firstLine) {

                if (trim($row[2] == 1)) {

                    $centre = new CentreModel();

                    /*

                    PARÁMETROS DE addCentre()
                    +--------------------------------+
                    | codi_centre                    |
                    | nom_centre                     |
                    | actiu                          |
                    | taller                         |
                    | telefon_centre                 |
                    | adreca_fisica_centre           |
                    | nom_persona_contacte_centre    |
                    | correu_persona_contacte_centre |
                    | id_sstt                        |
                    | id_poblacio                    |
                    +--------------------------------+
                    
                */
                                
                    $centre -> addCentre(
                        trim($row[0]),                       
                        trim($row[1]),                       
                        false,                               
                        false,                               
                        str_replace(' ', '', trim($row[8])), 
                        trim($row[6]),                       
                        '',                                  
                        trim($row[24]),                      
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
