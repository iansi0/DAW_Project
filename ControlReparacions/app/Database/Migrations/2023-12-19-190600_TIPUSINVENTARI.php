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
                        'null'           => false,
                ],
        ]);
        $this->forge->addPrimaryKey('id_tipus_inventari', true);
        $this->forge->createTable('TipusInventari');
    }

    public function down()
    {
        $this->forge->dropTable('TipusInventari');
    }
}
