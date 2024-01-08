<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PROFESSOR extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_xtec'          => [
                        'type'           => 'VARCHAR',
                ],
                'nom_professor'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'cognoms_professor'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'correu_professor'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'codi_centre'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
        ]);
        $this->forge->addPrimaryKey('id_xtec', true);
        $this->forge->createTable('Professor');
        $this->forge->addForeignKey('codi_centre', 'Centre', 'codi_centre');


    }

    public function down()
    {
        $this->forge->dropTable('Professor');
    }
}
