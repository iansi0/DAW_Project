<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class POBLACIO extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 8,
                'trim'           => true,
            ],
            'nom'          => [
                'type'           => 'VARCHAR',
                'trim'           => true,
                'constraint'     => 100,
                'null'           => false,
            ],
            'id_comarca'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 5,
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
        $this->forge->createTable('POBLACIO');
        $this->forge->addForeignKey('id_comarca', 'COMARCA', 'codi');

    }

    public function down()
    {
        $this->forge->dropTable('POBLACIO');
    }
}
