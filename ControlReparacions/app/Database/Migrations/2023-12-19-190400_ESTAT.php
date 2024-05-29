<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ESTATS extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id'          => [
                    'type'           => 'INT',
                    'constraint'     => 3,
                ],
                'nom'          => [
                    'type'           => 'VARCHAR',
                    'trim'           => true,
                    'constraint'     => 20,
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
        $this->forge->createTable('ESTAT');
        
    }

    public function down()
    {
        $this->forge->dropTable('ESTAT');
    }
}
