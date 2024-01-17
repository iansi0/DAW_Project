<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CENTRESeeder extends Seeder
{
    public function run()
    {
        // Cargamos el archivo CSV desde la siguiente ruta
        $csvFile = fopen(WRITEPATH . 'install'.DIRECTORY_SEPARATOR.'CENTRE_seeder.csv', "r");
        // Boolean para saltarnos la primera fila (es una fila con los nombres de los campos y por ende la descartamos)
        $firstline = true;

        // Insertar los datos en la base de datos
        while (($row = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (trim($row[2] == 1)) {
                                
                $dataToInsert = array(
                    'codi_centre'                       => trim($row[0]),
                    'nom_centre'                        => trim($row[1]),
                    'actiu'                             => false,
                    'taller'                            => false,
                    'telefon_centre'                    => str_replace(' ', '', trim($row[8])),
                    'adreca_fisica_centre'              => trim($row[6]),
                    'nom_persona_contacte_centre'       => '',
                    'correu_persona_contacte_centre'    => trim($row[24]),
                    'id_sstt'                           => '',
                    'id_poblacio'                       => ''
                );

                $this->db->table('SSTT')->insert($dataToInsert);
            }

            $firstline = false;

        }

        fclose($csvFile);
    }
}
