<?php

namespace App\Database\Seeds;

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
        while (($row = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            $dataToInsert = '';

            if (!$firstline) {
                $dataToInsert = array(
                    'id'            => trim($row['id']),
                    'nom'           => trim($row['nom']),
                    'adreca_fisica' => trim($row['adreca_fisica']),
                    'cp'            => str_replace(' ', '', trim($row['cp'])),
                    'poblacio'      => trim($row['poblacio']),
                    'telefon'       => str_replace(' ', '', trim($row['telefon'])),
                    'correu'        => trim($row['correu']),
                    'altres'        => trim($row['altres'])
                );
            }

            $firstline = false;

            $this->db->table('SSTT')->insert($dataToInsert);
        }

        fclose($csvFile);

    }
}
