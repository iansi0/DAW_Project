<?php

namespace App\Controllers;

use App\Models\IntervencioModel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use Faker\Factory;


use App\Models\InventariModel;

class InterventionController extends BaseController
{
    public function intervention()
    {
        return view('intervention/intervention');
    }

    public function interventionForm()
    {

        $inventary = new InventariModel();

        $data = [

            "inventary" => $inventary->getInventaryNoAssigned(),

        ];


        return view('intervention/interventionForm', $data);
    }

    public function addIntervention()
    {

        $model = new IntervencioModel();

        $fake = Factory::create("es_ES");

        $id_inventary = $this->request->getPost("id_inventary");

      

        //Añadir intervencion
        $id =  $fake->uuid();
        $descripcio =  $this->request->getPost("description");
        $id_ticket = $this->request->getPost("ticket_id");
        $id_tipus = $id_inventary == 6 ? 1 : 0;
        $id_curs = session('user')['code'];
        $persona_reparadora = session('user')['user'];

        $model->addIntervencio(
            $id,
            $descripcio,
            $id_ticket,
            $id_tipus,
            $id_curs,
            $persona_reparadora
        );

        //Modificar inventario relacionandolo con la intervencion

        $modelInventary = new InventariModel();

        $data = [
            "id" =>  $id_inventary,
            'id_intervencio' => $id,
        ];

        $modelInventary->modifyInventari($id_inventary, $data);


        return redirect()->to(base_url("tickets/" . $id_ticket));
    }
}
