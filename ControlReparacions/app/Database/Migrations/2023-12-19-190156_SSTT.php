<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SSTT extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_sstt'          => [
                        'type'           => 'VARCHAR',
                ],
                'nom_sstt'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'adreca_fisica_sstt'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'telefon_sstt'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'correu_sstt'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
        ]);
        $this->forge->addPrimaryKey('id_sstt', true);
        $this->forge->createTable('SSTT');
    }

    public function down()
    {
        $this->forge->dropTable('SSTT');
    }
}
