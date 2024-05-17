<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CURS extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id'          => [
                    'type'           => 'BINARY',
                    'constraint'     => 32,
                    'null'           => false,
                ],
                'curs'          => [
                    'type'           => 'INT',
                    'constraint'     => 4,
                    'null'           => false,
                ],
                'any'          => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null'           => false,
                ],
                'titol'          => [
                    'type'           => 'VARCHAR',
                    'trim'           => true,
                    'constraint'     => 20,
                    'null'           => false,
                ],
                

                'created_at' => [
                    'type'       => 'DATETIME',
                ],
                'updated_at' => [
                    'type'       => 'DATETIME',
                ],
                'deleted_at' => [
                    'type'       => 'DATETIME',
                    'null'       => true,
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
