<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIQUETS extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                        'null'           => false,
                ],
                'codi_dispositiu'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 32,
                ],
                'descripcio_avaria'          => [
                        'type'           => 'VARCHAR',
                        'trim'           => true,
                        'constraint'     => 500,
                        'null'           => false,
                ],
                'nom_persona_contacte_centre'          => [
                        'type'           => 'VARCHAR',
                        'trim'           => true,
                        'constraint'     => 100,
                        'null'           => false,
                ],
                'correu_persona_contacte_centre'          => [
                        'type'           => 'VARCHAR',
                        'trim'           => true,
                        'constraint'     => 100,
                        'null'           => false,
                ],
                'id_tipus_dispositiu'          => [
                        'type'           => 'INT',
                        'constraint'     => 2,
                        'null'           => false,
                ],
                'id_estat'          => [
                        'type'           => 'INT',
                        'constraint'     => 3,
                        'null'           => false,
                ],
                'codi_centre_emissor'          => [
                        'type'           => 'VARCHAR',
                        'trim'           => true,
                        'constraint'     => 10,
                ],
                'codi_centre_reparador'          => [
                        'type'           => 'VARCHAR',
                        'trim'           => true,
                        'constraint'     => 10,
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
        $this->forge->createTable('TIQUET');
        $this->forge->addForeignKey('id_tipus_dispositiu', 'TIPUS_DISPOSITIU', 'id');
        $this->forge->addForeignKey('id_estat', 'ESTAT', 'id');
        $this->forge->addForeignKey('codi_centre_emissor', 'CENTRE', 'codi');
        $this->forge->addForeignKey('codi_centre_reparador', 'CENTRE', 'codi');


    }

    public function down()
    {
        $this->forge->dropTable('TIQUET');
    }
}
