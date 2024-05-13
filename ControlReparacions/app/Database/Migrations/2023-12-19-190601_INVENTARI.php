<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class INVENTARI extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                ],
                'nom' => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 200,
                        'null'           => false,
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
                        'constraint'     => 32,
                        'null'           => false,
                ],
                'id_tipus_inventari'          => [
                        'type'           => 'INT',
                        'null'           => false,
                ],
                'id_intervencio'          => [
                    'type'           => 'BINARY',
                    'constraint'     => 32,
                    'null'           => true,
                ],
                'created_at' => [
                    'type'       => 'DATETIME',
                ],
                'updated_at' => [
                    'type'       => 'DATETIME',
                ],
                
                'deleted_at' => [
                    'type'       => 'DATETIME',
                    'null'       => true,
                ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('INVENTARI');
        $this->forge->addForeignKey('codi_centre', 'CENTRE', 'codi_centre');
        $this->forge->addForeignKey('id_tipus_inventari', 'TIPUS_INVENTARI', 'id');


    }

    public function down()
    {
        $this->forge->dropTable('INVENTARI');
    }
}
