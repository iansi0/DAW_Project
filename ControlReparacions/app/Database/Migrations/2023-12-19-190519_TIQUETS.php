<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TIQUETS extends Migration
{
    public function up()
{
        $this->forge->addField([
                'id_tiquet'          => [
                        'type'           => 'INT',
                ],
                'codi_equip'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'descripcio_avaria'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'nom_persona_contacte_centre'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'correu_persona_contacte_centre'          => [
                        'type'           => 'VARCHAR',
                        'null'           => false,
                ],
                'data_alta'          => [
                        'type'           => 'DATE',
                        'null'           => false,
                ],
                'data_ultima_modificacio'          => [
                        'type'           => 'DATE',
                        'null'           => false,
                ],
                'id_tipus_dispositiu'          => [
                        'type'           => 'INT',
                        'null'           => false,
                ],
                'id_estat'          => [
                        'type'           => 'INT',
                        'null'           => false,
                ],
                'codi_centre_emissor'          => [
                        'type'           => 'INT',
                        'null'           => false,
                ],
                'codi_centre_reparador'          => [
                        'type'           => 'INT',
                        'null'           => false,
                ],
        ]);
        $this->forge->addPrimaryKey('codi_centre_reparador', true);
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
