<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class COMARCA extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_comarca'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 3,
                    ],
                    'nom_comarca'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 50,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('id_comarca', true);
        $this->forge->createTable('Comarca');
    }

    public function down()
    {
        $this->forge->dropTable('Comarca');
    }
}
