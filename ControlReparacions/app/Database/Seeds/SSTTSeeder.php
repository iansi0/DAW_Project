<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SSTTSeeder extends Seeder
{
    public function run()
    {
        // Cargar la librería CSVReader usando el inyector de dependencias
        $csvReader = \Config\Services::csvreader();

        // Configurar la ruta del archivo CSV
        $csvFilePath = APPPATH . '/writeable/install/SSTT_seeder.csv';

        // Leer el archivo CSV
        $data = $csvReader->parse($csvFilePath);

        // Insertar los datos en la base de datos
        foreach ($data as $row) {
            $dataToInsert = array(
                'id'            => trim($row['id']),
                'nom'           => trim($row['nom']),
                'adreca_fisica' => trim($row['adreca_fisica']),
                'cp'            => trim($row['cp']),
                'poblacio'      => trim($row['poblacio']),
                'telefon'       => trim($row['telefon']),
                'correu'        => trim($row['correu']),
                'altres'        => trim($row['altres']),
            );

            $this->db->table('SSTT')->insert($dataToInsert);
        }
    }
}
