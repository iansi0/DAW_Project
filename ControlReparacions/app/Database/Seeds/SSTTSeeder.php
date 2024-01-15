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
                'id'            => $row['id'],
                'nom'           => $row['nom'],
                'adreca_fisica' => $row['adreca_fisica'],
                'cp'            => $row['cp'],
                'poblacio'      => $row['poblacio'],
                'telefon'       => $row['telefon'],
                'correu'        => $row['correu'],
                'altres'        => $row['altres'],
            );

            $this->db->table('SSTT')->insert($dataToInsert);
        }
    }
}
