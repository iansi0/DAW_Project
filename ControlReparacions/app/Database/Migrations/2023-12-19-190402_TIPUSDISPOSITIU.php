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
                ],
                'nom_tipus_dispositiu'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
        ]);
        $this->forge->addPrimaryKey('id_tipus_dispositiu', true);
        $this->forge->createTable('TipusDispositiu');
    
    }

    public function down()
    {
        $this->forge->dropTable('TipusDispositiu');
    }
}
