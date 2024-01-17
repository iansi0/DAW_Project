<?php

namespace App\Database\Seeds;

use App\Libraries\UUID as LibrariesUUID;
use CodeIgniter\Database\Seeder;

class SSTTSeeder extends Seeder
{
    public function run()
    {
        // Cargamos el archivo CSV desde la siguiente ruta
        $csvFile = fopen(WRITEPATH . 'install'.DIRECTORY_SEPARATOR.'SSTT_seeder.csv', "r");
        // Boolean para saltarnos la primera fila (es una fila con los nombres de los campos y por ende la descartamos)
        $firstline = true;

        // Insertar los datos en la base de datos
        while (($row = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            // Generamos un UUID
            $uuid = LibrariesUUID::v4();

            if (!$firstline) {
                                
                $dataToInsert = array(
                    'id'            => $uuid,
                    'codi'          => trim($row[0]),
                    'nom'           => trim($row[1]),
                    'adreca_fisica' => trim($row[2]),
                    'cp'            => str_replace(' ', '', trim($row[3])),
                    'poblacio'      => trim($row[4]),
                    'telefon'       => str_replace(' ', '', trim($row[5])),
                    'correu'        => trim($row[6]),
                    'altres'        => trim($row[7])
                );

                $this->db->table('SSTT')->insert($dataToInsert);
            }

            $firstline = false;

        }

        fclose($csvFile);

    }
}
