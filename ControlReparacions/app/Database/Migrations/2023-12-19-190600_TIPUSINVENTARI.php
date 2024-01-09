<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIPUSINVENTARI extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_tipus_inventari'          => [
                        'type'           => 'INT',
                ],
                'nom_tipus_inventari'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 30,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('id_tipus_inventari', true);
        $this->forge->createTable('TipusInventari');
    }

    public function down()
    {
        $this->forge->dropTable('TipusInventari');
    }
}
