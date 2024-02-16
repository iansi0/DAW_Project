<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CURS extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id'          => [
                        'type'           => 'INT',
                ],
                'cicle'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 50,
                        'null'           => false,
                ],
                'titol'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 20,
                        'null'           => false,
                ],
                'curs'          => [
                        'type'           => 'INT',
                        'constraint'     => 1,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('CURS');

    }

    public function down()
    {
        $this->forge->dropTable('CURS');
    }
}
