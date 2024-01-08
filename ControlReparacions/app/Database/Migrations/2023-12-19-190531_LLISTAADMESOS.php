<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LLISTAADMESOS extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'correu_professor'          => [
                        'type'           => 'VARCHAR',
                ],
                'data_entrega'          => [
                        'type'           => 'DATE',
                        'null'           => false,
                ],
                'codi_centre'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
        ]);
        $this->forge->addPrimaryKey('correu_professor', true);
        $this->forge->createTable('LlistaAdmesos');
        $this->forge->addForeignKey('correu_professor', 'Intervencio', 'id_curs');
        $this->forge->addForeignKey('codi_centre', 'Centre', 'codi_centre');


    }

    public function down()
    {
        $this->forge->dropTable('LlistaAdmesos');
    }
}
