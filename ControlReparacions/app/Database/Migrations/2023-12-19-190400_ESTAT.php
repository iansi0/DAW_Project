<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ESTATS extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id'          => [
                        'type'           => 'INT',
                        'constraint'     => 3,
                ],
                'nom'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 20,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ESTAT');
    }

    public function down()
    {
        $this->forge->dropTable('ESTAT');
    }
}
