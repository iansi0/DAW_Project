<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CENTRE extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'codi_centre'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                        'null'           => false,
                ],
                'nom_centre'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 100,
                        'null'           => false,
                ],
                'actiu'          => [
                        'type'           => 'BOOLEAN',
                        'null'           => false,
                ],
                'taller'          => [
                        'type'           => 'BOOLEAN',
                        'null'           => false,
                ],
                'telefon_centre'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 9,
                        'null'           => false,
                ],
                'adreca_fisica_centre'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 100,
                        'null'           => false,
                ],
                'nom_persona_contacte_centre'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 50,
                        'null'           => false,
                ],
                'correu_persona_contacte_centre'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 50,
                        'null'           => false,
                ],
                'id_sstt'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                        'null'           => false,
                ],
                'id_poblacio'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('codi_centre', true);
        $this->forge->createTable('Centre');
        $this->forge->addForeignKey('id_sstt', 'SSTT', 'id_sstt');
        $this->forge->addForeignKey('id_poblacio', 'Poblacio', 'id_poblacio');


}

public function down()
{
        $this->forge->dropTable('Centre');
}
}
