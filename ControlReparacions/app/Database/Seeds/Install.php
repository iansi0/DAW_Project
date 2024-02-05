<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Install extends Seeder
{
    public function run()
    {
        $this->call("SSTTSeeder");
        $this->call("COMARCASeeder");
        $this->call("POBLACIOSeeder");
        $this->call("CENTRESeeder");
        $this->call("TIPUSDISPOSITIUSSeeder");
        $this->call("TIPUSINTERVENCIOSeeder");
        $this->call("TIPUSINVENTARISeeder");
        $this->call("ESTATSeeder");
        $this->call("PROFESSORSeeder");
        $this->call("ALUMNESeeder");
        $this->call("TIQUETSeeder");
    }
}
