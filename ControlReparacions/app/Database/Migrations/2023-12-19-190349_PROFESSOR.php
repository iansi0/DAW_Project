<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PROFESSOR extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_xtec'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 20,
                ],
                'nom_professor'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 20,
                        'null'           => false,
                ],
                'cognoms_professor'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 30,
                        'null'           => false,
                ],
                'correu_professor'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 50,
                        'null'           => false,
                ],
                'codi_centre'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 20,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('id_xtec', true);
        $this->forge->createTable('Professor');
        $this->forge->addForeignKey('codi_centre', 'Centre', 'codi_centre');


    }

    public function down()
    {
        $this->forge->dropTable('Professor');
    }
}
