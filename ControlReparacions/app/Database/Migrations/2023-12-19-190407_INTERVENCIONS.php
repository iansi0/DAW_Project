<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class INTERVENCIONS extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_intervencio'          => [
                        'type'           => 'VARCHAR',
                ],
                'descripcio_intervencio'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'data_intervencio'          => [
                        'type'           => 'DATE',
                        'null'           => false,
                ],
                'id_tipus_intervencio'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'id_tipus_intervencio'          => [
                        'type'           => 'INT',
                        'null'           => false,
                ],
                'id_curs'          => [
                        'type'           => 'INT',
                        'null'           => false,
                ],
                'correu_alumne'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'id_xtec'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
        ]);
        $this->forge->addPrimaryKey('id_intervencio', true);
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
