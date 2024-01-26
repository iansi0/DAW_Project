<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class COMARCA extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id' => [
                    'type'           => 'BINARY',
                    'constraint'     => 32,
                ],
                
                'nom' => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 50,
                    'null'           => false,
                ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('COMARCA');
    }

    public function down()
    {
        $this->forge->dropTable('COMARCA');
    }
}
