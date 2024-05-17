<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ROLES extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BINARY',
                'constraint'     => 32,
            ],
            'role' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
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
        $this->forge->createTable('ROLES');
        
    }

    public function down()
    {
        $this->forge->dropTable('ROLES');
    }
}
