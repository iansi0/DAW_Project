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
                        'constraint'     => 32,
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
                        'constraint'     => 32,
                        'null'           => false,
                ],
                'language'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 10,
                        'null'           => true,
                ],
        ]);
        $this->forge->addKey('id_xtec', true);
        $this->forge->createTable('PROFESSOR');
        $this->forge->addForeignKey('codi_centre', 'CENTRE', 'codi');
        $this->forge->addForeignKey('id_user', 'USERS', 'id');


    }

    public function down()
    {
        $this->forge->dropTable('PROFESSOR');
    }
}
