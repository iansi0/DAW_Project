<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIPUSINTERVENCIONS extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                ],
                'nom'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 20,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('TIPUS_INTERVENCIO');
    }

    public function down()
    {
        $this->forge->dropTable('TIPUS_INTERVENCIO');
    }
}
