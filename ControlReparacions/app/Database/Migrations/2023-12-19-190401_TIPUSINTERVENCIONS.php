<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIPUSINTERVENCIONS extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_tipus_intevencio'          => [
                        'type'           => 'INT',
                ],
                'nom_tipus_intervencio'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
        ]);
        $this->forge->addPrimaryKey('id_tipus_intevencio', true);
        $this->forge->createTable('TipusIntervencio');
    }

    public function down()
    {
        $this->forge->dropTable('TipusIntervencio');
    }
}
