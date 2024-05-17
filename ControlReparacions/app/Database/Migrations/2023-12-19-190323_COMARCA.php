<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class COMARCA extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'codi' => [
                    'type'           => 'VARCHAR',
                    'trim'           => true,
                    'constraint'     => 5,
                ],
                'nom' => [
                    'type'           => 'VARCHAR',
                    'trim'           => true,
                    'constraint'     => 50,
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
        $this->forge->addKey('codi', true);
        $this->forge->createTable('COMARCA');
    }

    public function down()
    {
        $this->forge->dropTable('COMARCA');
    }
}
