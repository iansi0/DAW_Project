<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class COMARCA extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_comarca'          => [
                        'type'           => 'INT',
                        'constraint'     => 2,
                ],
                'nom_comarca'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
        ]);
        $this->forge->addPrimaryKey('id_comarca', true);
        $this->forge->createTable('Comarca');
    }

    public function down()
    {
        $this->forge->dropTable('Comarca');
    }
}
