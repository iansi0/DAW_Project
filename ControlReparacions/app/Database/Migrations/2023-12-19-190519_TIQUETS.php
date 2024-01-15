<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIQUETS extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id_tiquet'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 16,
                ],
                'codi_dispositiu'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 50,
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
                        'type'           => 'BINARY',
                        'constraint'     => 16,
                        'null'           => false,
                ],
                'codi_centre_reparador'          => [
                        'type'           => 'BINARY',
                        'constraint'     => 16,
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('codi_centre_reparador', true);
        $this->forge->createTable('Tiquet');
        $this->forge->addForeignKey('id_tipus_dispositiu', 'TipusDispositiu', 'id_tipus_dispositiu');
        $this->forge->addForeignKey('id_estat', 'Estat', 'id_estat');
        $this->forge->addForeignKey('codi_centre_emissor', 'Centre', 'codi_centre');
        $this->forge->addForeignKey('codi_centre_reparador', 'Centre', 'codi_centre');


    }

    public function down()
    {
        $this->forge->dropTable('Tiquet');
    }
}
