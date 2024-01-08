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
                ],
                'nom_estat'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
        ]);
        $this->forge->addPrimaryKey('id_estat', true);
        $this->forge->createTable('Estat');
    }

    public function down()
    {
        $this->forge->dropTable('Estat');
    }
}
