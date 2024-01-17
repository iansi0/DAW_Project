<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SSTT extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id' => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                ],
                'codi' => [
                        'type'           => 'INT',
                        'constraint'     => 10,
                        'null'           => false,
                ],
                'nom' => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 40,
                        'null'           => false,
                ],
                'adreca_fisica' => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 100,
                        'null'           => false,
                ],
                'cp' => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 5,
                        'null'           => false,
                ],
                'poblacio' => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 100,
                        'null'           => false,
                ],
                'telefon' => [
                        'type'           => 'INT',
                        'constraint'     => 9,
                        'null'           => true,
                ],
                'correu' => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 50,
                        'null'           => true,
                ],
                'altres' => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 250,
                        'null'           => true,
                ],
        ]);
        $this->forge->addKey('id_sstt', true);
        $this->forge->createTable('SSTT');

    }

    public function down()
    {
        $this->forge->dropTable('SSTT');
    }
}
