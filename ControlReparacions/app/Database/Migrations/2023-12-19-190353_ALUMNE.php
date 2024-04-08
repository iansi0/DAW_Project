<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ALUMNE extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'correu_alumne'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 50,
                ],
                'codi_centre'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                        'null'           => false,
                ],
                'language'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 10,
                        'null'           => true,
                ],
        ]);
        $this->forge->addKey('correu_alumne', true);
        $this->forge->createTable('ALUMNE');
        $this->forge->addForeignKey('codi_centre', 'CENTRE', 'codi');
        $this->forge->addForeignKey('id_user', 'USERS', 'id');
        
    }

    public function down()
    {
        $this->forge->dropTable('ALUMNE');
    }
}
