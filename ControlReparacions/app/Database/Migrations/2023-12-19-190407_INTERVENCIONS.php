<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class INTERVENCIONS extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                ],
                'descripcio'          => [
                        'type'           => 'VARCHAR',
                        'trim'           => true,
                        'constraint'     => 100,
                        'null'           => false,
                ],
                'id_ticket'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                ],
                'id_tipus'          => [
                        'type'           => 'INT',
                        'constraint'     => 3,
                        'null'           => false,
                ],
                'id_curs'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                        'null'           => false,
                ],
                'id_user'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                        'null'           => false,
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
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('INTERVENCIO');
        $this->forge->addForeignKey('id_ticket', 'TICKET', 'id');
        $this->forge->addForeignKey('id_tipus', 'TIPUS_INTERVENCIO', 'id');
        $this->forge->addForeignKey('id_user', 'USERS', 'id');
        $this->forge->addForeignKey('id_curs', 'CURS', 'id');

    }

    public function down()
    {
        $this->forge->dropTable('INTERVENCIO');
    }
}
