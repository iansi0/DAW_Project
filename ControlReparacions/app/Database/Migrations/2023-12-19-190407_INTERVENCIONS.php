<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class INTERVENCIONS extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_intervencio'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                ],
                'descripcio_intervencio'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 100,
                        'null'           => false,
                ],
                'data_intervencio'          => [
                        'type'           => 'DATE',
                        'default'        => date("Y-m-d H:i:s"),
                        'null'           => false,
                ],
                'id_tipus_intervencio'          => [
                        'type'           => 'INT',
                        'constraint'     => 3,
                        'null'           => false,
                ],
                'id_curs'          => [
                        'type'           => 'INT',
                        'null'           => false,
                ],
                'correu_alumne'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 50,
                        'null'           => false,
                ],
                'id_xtec'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('id_intervencio', true);
        $this->forge->createTable('Intervencio');
        $this->forge->addForeignKey('id_tipus_intervencio', 'TipusIntervencio', 'id_tipus_intervencio');
        $this->forge->addForeignKey('id_tipus_intervencio', 'TipusIntervencio', 'id_tipus_intervencio');
        $this->forge->addForeignKey('correu_alumne', 'Alumne', 'correu_alumne');
        $this->forge->addForeignKey('id_xtec', 'Professor', 'id_xtec');


    }

    public function down()
    {
        $this->forge->dropTable('Intervencio');
    }
}
