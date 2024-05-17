<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SSTT extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_user' => [
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
                        'type'           => 'VARCHAR',
                        'constraint'     => 9,
                        'null'           => true,
                ],
                'altres' => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 250,
                        'null'           => true,
                ],

                'created_at' => [
                        'type'       => 'DATETIME',
                ],
                'updated_at' => [
                        'type'       => 'DATETIME',
                ],
                'deleted_at' => [
                        'type'       => 'DATETIME',
                        'null'       => true,
                ],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('SSTT');
        $this->forge->addForeignKey('id_user', 'USERS', 'id');

    }

    public function down()
    {
        $this->forge->dropTable('SSTT');
    }
}
