<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CENTRE extends Migration
{
    public function up()
{
        $this->forge->addField([
                'codi_centre'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'nom_centre'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'actiu'          => [
                        'type'           => 'BOOLEAN',
                ],
                'taller'          => [
                        'type'           => 'BOOLEAN',
                ],
                'telefon_centre'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'adreca_fisica_centre'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'nom_persona_contacte_centre'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'correu_persona_contacte_centre'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'id_sstt'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'id_poblacio'          => [
                        'type'           => 'INT',
                        'null'           => false,
                ],
        ]);
        $this->forge->addPrimaryKey('codi_centre', true);
        $this->forge->createTable('Centre');
        $this->forge->addForeignKey('id_sstt', 'SSTT', 'id_sstt');
        $this->forge->addForeignKey('id_poblacio', 'Poblacio', 'id_poblacio');


}

public function down()
{
        $this->forge->dropTable('Centre');
}
}
