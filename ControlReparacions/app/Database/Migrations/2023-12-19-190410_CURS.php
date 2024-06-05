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
                'clase'          => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 5,
                    'null'           => false,
                ],
                'any'          => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 5,
                    'null'           => false,
                ],
                'titol'          => [
                    'type'           => 'VARCHAR',
                    'trim'           => true,
                    'constraint'     => 20,
                    'null'           => false,
                ],
                'codi_centre'          => [
                    'type'           => 'VARCHAR',
                    'trim'           => true,
                    'constraint'     => 10,
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
        $this->forge->addForeignKey('codi_centre', 'CENTRE', 'codi');

    }

    public function down()
    {
        $this->forge->dropTable('CURS');
    }
}
