<?php

namespace App\Controllers;

use App\Models\IntervencioModel;
use App\Models\InventariModel;
use App\Models\TiquetModel;

use App\Controllers\BaseController;

use App\Libraries\UUID as LibrariesUUID;


class InterventionController extends BaseController
{
    public function intervention()
    {
        return view('intervention/intervention');
    }

    public function interventionForm($id)
    {

        helper('form');

        $inventary = new InventariModel();

        $data = [
            "id_ticket" => $id,
            "types" => $inventary->getInventaryNoAssigned(),

        ];

        return view('intervention/interventionForm', $data);

    }

    public function addIntervention()
    {

        $arrInterventions = $this->request->getPost('arrInterventions');

        // Forzamos el json_decode
        $arrInterventions = json_decode((string) $arrInterventions);

        // dd($arrInterventions);

        // Creamos un array que irá almacenando los inputs erróneos
        $arrErrors = [];
        $arrValues = [];

        // Hacemos un primer recorrido comprobando que los inputs están correctos
        foreach ($arrInterventions[0] as $inv) {

            $id_intervencio = $inv[0]->id;
            $id_inventari = $inv[1]->id_type;

            if ($id_intervencio == null || $id_intervencio == '') {
                $arrErrors[$id_inventari]["id_type"] = lang('error.id_type');
            }

            if(in_array($id_inventari, $arrValues)) {
                $arrErrors[$id_inventari]["id_type"] = lang('error.id_type');
            } else {
                $arrValues[] = $id_inventari;
            }

        }

        $ticketModel = new TiquetModel();

        if(!$ticketModel->getTicketById($this->request->getPost("id_ticket"))){
            $arrErrors[] = lang('error.id_type');
        };

        // Si detectamos errores, los mandamos de vuelta al front para ser corregidos
        // PD: el flash data no sera ejecutado y no solo eso, se le va a recargar la pagina al cliente borrándole todo
        // PDD: Un cliente normal se quedaria en las validaciones de javascript
        if (count($arrErrors) > 0) {
            session()->setFlashdata('error', $arrErrors);
            return redirect()->back();
        }
           
        $model = new IntervencioModel();

        $id_inventary = $this->request->getPost("id_inventary");

        // Añadir intervencion
        $id = LibrariesUUID::v4();
        $descripcio = $arrInterventions[1][0]->description;
        $id_ticket = $this->request->getPost("id_ticket");

        // dd($id_ticket);

        $modelInventary = new InventariModel();
        $product = $modelInventary->getInventarytById($id_inventary);
        $id_curs = 0;
        // Comprobamos si se ha cambiado el disco duro para hacer la intervencion bloqueante
        $id_tipus = isset($product['id_tipus_inventari']) ? (($product['id_tipus_inventari'] == 6) ? 1 : 0) : 0;

        $persona_reparadora = session('user')['user'];

        $model->addIntervencio(
            $id,
            $descripcio,
            $id_ticket,
            $id_tipus,
            $id_curs,
            $persona_reparadora
        );

        // Modificamos inventario relacionandolo con la intervencion
        foreach ($arrInterventions[0] as $inv) {

            $id_inventari = $inv[1]->id_type;

            $data = [
                "id" =>  $id_inventari,
                'id_intervencio' => $id,
            ];
    
            $modelInventary->modifyInventari($id_inventari, $data);

        }

        return redirect()->to(base_url("tickets/" . $id_ticket));

    }
}
