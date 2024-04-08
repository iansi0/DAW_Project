<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class USERSINROLES extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id' => [
                'type'           => 'BINARY',
                'constraint'     => 32,
            ],
            'id_user' => [
                'type'           => 'BINARY',
                'constraint'     => 32,
            ],
            'id_role' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('USERS_IN_ROLES');
        $this->forge->addForeignKey('id_user', 'USERS', 'id');
        $this->forge->addForeignKey('id_role', 'ROLES', 'id');

    }

    public function down()
    {
        $this->forge->dropTable('USERS_IN_ROLES');
    }
}
