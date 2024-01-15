<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIPUSINTERVENCIONS extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_tipus_intevencio'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 16,
                ],
                'nom_tipus_intervencio'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 20,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('id_tipus_intevencio', true);
        $this->forge->createTable('TipusIntervencio');
    }

    public function down()
    {
        $this->forge->dropTable('TipusIntervencio');
    }
}
