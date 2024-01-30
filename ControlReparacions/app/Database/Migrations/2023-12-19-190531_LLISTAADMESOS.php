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
                        'constraint'     => 50,
                        
                ],
                'data_entrega'          => [
                        'type'           => 'DATE',
                        'default'        => date("Y-m-d H:i:s"),
                        'null'           => false,
                ],
                'codi_centre'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('correu_professor', true);
        $this->forge->createTable('LLISTA_ADMESOS');
        $this->forge->addForeignKey('codi_centre', 'CENTRE', 'codi');


    }

    public function down()
    {
        $this->forge->dropTable('LLISTA_ADMESOS');
    }
}
