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
                ],
                'codi_centre'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
        ]);
        $this->forge->addPrimaryKey('correu_alumne', true);
        $this->forge->createTable('Alumne');
        $this->forge->addForeignKey('codi_centre', 'Centre', 'codi_centre');


    }

    public function down()
    {
        $this->forge->dropTable('Alumne');
    }
}
