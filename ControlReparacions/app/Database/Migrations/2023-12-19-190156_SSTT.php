<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SSTT extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_sstt' => [
                        'type'           => 'BINARY',
                        'constraint'     => '2',
                ],
                'nom_sstt' => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '40',
                        'null'           => false,
                ],
                'adreca_fisica_sstt' => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '100',
                        'null'           => false,
                ],
                'telefon_sstt' => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '9',
                        'null'           => false,
                ],
                'correu_sstt' => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '50',
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('id_sstt', true);
        $this->forge->createTable('SSTT');
    }

    public function down()
    {
        $this->forge->dropTable('SSTT');
    }
}
