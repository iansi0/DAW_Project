<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Install extends Seeder
{
    public function run()
    {
        // Seeder de User+Roles+SSTT+CENTRE+PROFESSOR+ALUMNE+USERINROLE
        $this->call("USERSSeeder");

        $this->call("COMARCASeeder");
        $this->call("POBLACIOSeeder");
        $this->call("TIPUSDISPOSITIUSSeeder");
        $this->call("TIPUSINTERVENCIOSeeder");
        $this->call("TIPUSINVENTARISeeder");
        $this->call("ESTATSeeder");
        $this->call("TIQUETSeeder");
    }
}
