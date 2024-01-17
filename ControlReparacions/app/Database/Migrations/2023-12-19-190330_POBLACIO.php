<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class POBLACIO extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_poblacio'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                ],
                'nom_poblacio'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 100,
                        'null'           => false,
                ],
                'id_comarca'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 2,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('id_poblacio', true);
        $this->forge->createTable('Poblacio');
        $this->forge->addForeignKey('id_comarca', 'Comarca', 'id_comarca');


    }

    public function down()
    {
        $this->forge->dropTable('Poblacio');
    }
}
