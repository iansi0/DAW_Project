<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reboot extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $sql = "
            CREATE EVENT IF NOT EXISTS reboot_prof_and_alumn_event
            ON SCHEDULE
                EVERY 1 YEAR
                STARTS '2024-08-31 00:00:00'
            DO
            BEGIN
                UPDATE alumne SET deleted_at = NOW() WHERE deleted_at IS NULL;
                UPDATE professor SET deleted_at = NOW() WHERE deleted_at IS NULL;
                UPDATE users SET deleted_at = NOW() WHERE id IN (SELECT id_user FROM alumne WHERE deleted_at = NOW());
                UPDATE users SET deleted_at = NOW() WHERE id IN (SELECT id_user FROM professor WHERE deleted_at = NOW());
            END;
        ";

        $db->query($sql);
    }

    public function down()
    {
        $db = \Config\Database::connect();

        $sql = "DROP EVENT IF EXISTS soft_delete_event";

        $db->query($sql);
    }
}
