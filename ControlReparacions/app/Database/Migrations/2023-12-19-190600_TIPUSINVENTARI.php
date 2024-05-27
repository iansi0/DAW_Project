<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIPUSINVENTARI extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id'          => [
                        'type'           => 'INT',
                ],
                'nom'          => [
                        'type'           => 'VARCHAR',
                        'trim'           => true,
                        'constraint'     => 30,
                        'null'           => false,
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
        $this->forge->createTable('TIPUS_INVENTARI');
        
    }

    public function down()
    {
        $this->forge->dropTable('TIPUS_INVENTARI');
    }
}
