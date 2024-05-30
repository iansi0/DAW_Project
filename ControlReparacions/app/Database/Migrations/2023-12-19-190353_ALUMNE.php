<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ALUMNE extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_user'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                        'null'           => false,
                ],
                'nom'          => [
                        'type'           => 'VARCHAR',
                        'trim'           => true,
                        'constraint'     => 20,
                        'null'           => false,
                ],
                'cognoms'          => [
                        'type'           => 'VARCHAR',
                        'trim'           => true,
                        'constraint'     => 80,
                        'null'           => false,
                ],
                'codi_centre'          => [
                        'type'           => 'VARCHAR',
                        'trim'           => true,
                        'constraint'     => 10,
                        'null'           => false,
                ],
                'id_curs'          => [
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
        
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('ALUMNE');
        $this->forge->addForeignKey('codi_centre', 'CENTRE', 'codi');
        $this->forge->addForeignKey('id_user', 'USERS', 'id');
        $this->forge->addForeignKey('id_curs', 'CURS', 'id');
        
    }

    public function down()
    {
        $this->forge->dropTable('ALUMNE');
    }
}
