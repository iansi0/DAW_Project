<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIPUSDISPOSITIU extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_tipus_dispositiu'          => [
                        'type'           => 'INT',
                        'constraint'     => 3,
                    ],
                'nom_tipus_dispositiu'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 20,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('id_tipus_dispositiu', true);
        $this->forge->createTable('TipusDispositiu');
    
    }

    public function down()
    {
        $this->forge->dropTable('TipusDispositiu');
    }
}
