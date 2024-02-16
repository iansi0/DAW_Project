<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIPUSINVENTARI extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id'          => [
                        'type'           => 'INT',
                ],
                'nom'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 30,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('TIPUS_INVENTARI');
    }

    public function down()
    {
        $this->forge->dropTable('TIPUS_INVENTARI');
    }
}
