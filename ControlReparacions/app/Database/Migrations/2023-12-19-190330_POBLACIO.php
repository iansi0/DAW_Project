<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class POBLACIO extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_poblacio'          => [
                        'type'           => 'INT',
                        'constraint'     => 2,
                ],
                'nom_poblacio'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'id_comarca'          => [
                        'type'           => 'INT',
                        'null'           => false,
                ],
        ]);
        $this->forge->addPrimaryKey('id_poblacio', true);
        $this->forge->createTable('Poblacio');
        $this->forge->addForeignKey('id_comarca', 'Comarca', 'id_comarca');


    }

    public function down()
    {
        $this->forge->dropTable('Poblacio');
    }
}
