<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CENTRE extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'codi'          => [
                        'type'           => 'INT',
                        'constraint'     => 7,
                        'null'           => false,
                ],
                'nom'          => [
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
                'telefon'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 9,
                        'null'           => false,
                ],
                'adreca_fisica'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 100,
                        'null'           => false,
                ],
                'nom_persona_contacte'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 50,
                        'null'           => false,
                ],
                'correu_persona_contacte'          => [
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
        $this->forge->addKey('codi', true);
        $this->forge->createTable('CENTRE');
        $this->forge->addForeignKey('id_sstt', 'SSTT', 'id');
        $this->forge->addForeignKey('id_poblacio', 'POBLACIO', 'id');


}

public function down()
{
        $this->forge->dropTable('CENTRE');
}
}
