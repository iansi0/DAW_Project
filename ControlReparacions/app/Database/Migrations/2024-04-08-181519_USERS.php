<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class USERS extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BINARY',
                'constraint'     => 32,
            ],
            'user' => [
                'type'           => 'VARCHAR',
                'trim'           => true,
                'constraint'     => 100,
            ],
            'passwd' => [
                'type'           => 'VARCHAR',
                'trim'           => true,
                'constraint'     => 255,
                'null'           => true,
            ],
            'lang'          => [
                'type'           => 'VARCHAR',
                'trim'           => true,
                'constraint'     => 2,
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

        $this->forge->addKey('id', true);
        $this->forge->addKey('user');
        $this->forge->createTable('USERS');
        
    }

    public function down()
    {
        $this->forge->dropTable('USERS');
    }
}
