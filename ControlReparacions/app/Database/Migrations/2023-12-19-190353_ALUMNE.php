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
                        'constraint'     => 20,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('correu_alumne', true);
        $this->forge->createTable('Alumne');
        $this->forge->addForeignKey('codi_centre', 'Centre', 'codi_centre');


    }

    public function down()
    {
        $this->forge->dropTable('Alumne');
    }
}
