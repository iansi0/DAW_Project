<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class INVENTARI extends Migration
{
    public function up()
{
        $this->forge->addField([
                'id_inventari'          => [
                        'type'           => 'VARCHAR',
                ],
                'data_compra'          => [
                        'type'           => 'DATE',
                        'null'           => false,
                ],
                'preu'          => [
                        'type'           => 'FLOAT',
                        'null'           => false,
                ],
                'codi_centre'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'id_tipus_inventari'          => [
                        'type'           => 'INT',
                        'null'           => false,
                ],
        ]);
        $this->forge->addPrimaryKey('id_inventari', true);
        $this->forge->createTable('Inventari');
        $this->forge->addForeignKey('codi_centre', 'Centre', 'codi_centre');
        $this->forge->addForeignKey('id_tipus_inventari', 'TipusInventari', 'id_tipus_inventari');


    }

    public function down()
    {
        $this->forge->dropTable('Inventari');
    }
}
