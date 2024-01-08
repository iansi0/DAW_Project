<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CURS extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_curs'          => [
                        'type'           => 'INT',
                ],
                'cicle'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'titol'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'curs'          => [
                        'type'           => 'INT',
                        'null'           => false,
                ],
        ]);
        $this->forge->addPrimaryKey('id_curs', true);
        $this->forge->createTable('Curs');
        $this->forge->addForeignKey('id_curs', 'Intervencio', 'id_curs');

    }

    public function down()
    {
        $this->forge->dropTable('Curs');
    }
}
