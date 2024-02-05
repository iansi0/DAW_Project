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
                        'null'           => false,
                ],
                'descripcio_avaria'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 100,
                        'null'           => false,
                ],
                'nom_persona_contacte_centre'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 50,
                        'null'           => false,
                ],
                'correu_persona_contacte_centre'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 50,
                        'null'           => false,
                ],
                'data_alta'          => [
                        'type'           => 'DATE',
                        'default'        => date("Y-m-d H:i:s"),
                        'null'           => false,
                ],
                'data_ultima_modificacio'          => [
                        'type'           => 'DATE',
                        'default'        => date("Y-m-d H:i:s"),
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
                        'type'           => 'INT',
                        'constraint'     => 7,
                        'null'           => false,
                ],
                'codi_centre_reparador'          => [
                        'type'           => 'INT',
                        'constraint'     => 7,
                        'null'           => false,
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
