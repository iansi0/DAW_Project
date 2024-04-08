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
            'passwd' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('USERS');
    }

    public function down()
    {
        $this->forge->dropTable('USERS');
    }
}
