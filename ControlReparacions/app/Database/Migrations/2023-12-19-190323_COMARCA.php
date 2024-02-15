<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class COMARCA extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'codi' => [
                    'type'           => 'INT',
                    'constraint'     => 3,
                ],
                
                'nom' => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 50,
                    'null'           => false,
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
