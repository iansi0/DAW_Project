<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ESTATS extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_estat'          => [
                        'type'           => 'INT',
                        'constraint'     => 3,
                ],
                'nom_estat'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 20,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('id_estat', true);
        $this->forge->createTable('Estat');
    }

    public function down()
    {
        $this->forge->dropTable('Estat');
    }
}
