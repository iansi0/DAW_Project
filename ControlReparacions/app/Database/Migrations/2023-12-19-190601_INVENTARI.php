<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class INVENTARI extends Migration
{
    public function up()
{
        $this->forge->addField([
                'id_inventari'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 20,
                ],
                'data_compra'          => [
                        'type'           => 'DATE',
                        'default'        => date("Y-m-d H:i:s"),
                        'null'           => false,
                ],
                'preu'          => [
                        'type'           => 'FLOAT',
                        'null'           => false,
                ],
                'codi_centre'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 20,
                        'null'           => false,
                ],
                'id_tipus_inventari'          => [
                        'type'           => 'INT',
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('id_inventari', true);
        $this->forge->createTable('Inventari');
        $this->forge->addForeignKey('codi_centre', 'Centre', 'codi_centre');
        $this->forge->addForeignKey('id_tipus_inventari', 'TipusInventari', 'id_tipus_inventari');


    }

    public function down()
    {
        $this->forge->dropTable('Inventari');
    }
}
