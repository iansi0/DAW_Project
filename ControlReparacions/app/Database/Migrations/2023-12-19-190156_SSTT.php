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
                                'null'           => false,
                        ],
                        'codi' => [
                                'type'           => 'VARCHAR',
                                'trim'           => true,
                                'constraint'     => 10,
                                'null'           => false,
                        ],
                        'nom' => [
                                'type'           => 'VARCHAR',
                                'trim'           => true,
                                'constraint'     => 40,
                                'null'           => false,
                        ],
                        'adreca_fisica' => [
                                'type'           => 'VARCHAR',
                                'trim'           => true,
                                'constraint'     => 100,
                                'null'           => false,
                        ],
                        'cp' => [
                                'type'           => 'VARCHAR',
                                'trim'           => true,
                                'constraint'     => 5,
                                'null'           => false,
                        ],
                        'poblacio' => [
                                'type'           => 'VARCHAR',
                                'trim'           => true,
                                'constraint'     => 100,
                                'null'           => false,
                        ],
                        'telefon' => [
                                'type'           => 'VARCHAR',
                                'trim'           => true,
                                'constraint'     => 9,
                                'null'           => true,
                        ],
                        'altres' => [
                                'type'           => 'VARCHAR',
                                'trim'           => true,
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
                $this->forge->addKey('codi');
                $this->forge->createTable('SSTT');
                $this->forge->addForeignKey('id_user', 'USERS', 'id');

        }

        public function down()
        {
                $this->forge->dropTable('SSTT');
        }
}
