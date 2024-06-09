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

        if($arrInterventions[1][0]->description == null || $arrInterventions[1][0]->description == ''){
            $arrErrors[] = lang('error.id_type');
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
        $codi_centre = session('user')['code']??'';
        $id_tipus = 0;

        $persona_reparadora = session('user')['user'];

        $model->addIntervencio(
            $id,
            $descripcio,
            $id_ticket,
            $id_tipus,
            $codi_centre,
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

            // Comprobamos si se ha cambiado el disco duro para hacer la intervencion bloqueante
            $product = $modelInventary->getInventaryById($id_inventary);

            // Comprobamos si se ha cambiado el disco duro para hacer la intervencion bloqueante
            $id_tipus = (isset($product['id_tipus_inventari']) && $product['id_tipus_inventari'] == 6) ? 1 : 0;

            // Actualizamos la intervención si es necesario
            if ($id_tipus == 1) {
                $model->modifyIntervention($id, $id_tipus, $descripcio);        
            }

        }

        return redirect()->to(base_url("tickets/" . $id_ticket));

    }

    public function modifyIntervention($id)
    {
        helper('form');

        $inventary = new InventariModel();
        $intervention = new IntervencioModel();

        $data = [
            "intervention" => $intervention->getInterventionById($id),
            "inventaryNoAssigned" => $inventary->getInventaryNoAssigned(),
            "inventaryAssigned" => $inventary->getInventaryAssigned($id),
        ];

        // dd($data);

        return view('intervention/modifyIntervention', $data);
    }

    public function modifyIntervention_post($id)
    {

        $inventaryModel = new InventariModel();
        $interventionModel = new IntervencioModel();

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

        if(!$interventionModel->getInterventionById($this->request->getPost("id_intervention"))){
            $arrErrors[] = lang('error.id_type');
        };

        if($arrInterventions[1][0]->description == null || $arrInterventions[1][0]->description == ''){
            $arrErrors[] = lang('error.id_type');
        }

        // Si detectamos errores, los mandamos de vuelta al front para ser corregidos
        // PD: el flash data no sera ejecutado y no solo eso, se le va a recargar la pagina al cliente borrándole todo
        // PDD: Un cliente normal se quedaria en las validaciones de javascript
        if (count($arrErrors) > 0) {
            session()->setFlashdata('error', $arrErrors);
            return redirect()->back();
        }

        // Update Inventary
        $descripcio = $arrInterventions[1][0]->description;
        $id = $this->request->getPost("id_intervention");

        // Desasignamos todo el inventario que tenga la intervencion
        $inventaryModel->unassignInventary($id);

        // Asignamos el nuevo inventario a la intervencion
        $id_inventary = $this->request->getPost("id_inventary");

        // Modificamos inventario relacionandolo con la intervencion
        foreach ($arrInterventions[0] as $inv) {

            $id_inventari = $inv[1]->id_type;

            $data = [
                "id" =>  $id_inventari,
                'id_intervencio' => $id,
            ];
    
            $inventaryModel->modifyInventari($id_inventari, $data);

            // Comprobamos si se ha cambiado el disco duro para hacer la intervencion bloqueante
            $product = $inventaryModel->getInventaryById($id_inventary);

            // Comprobamos si se ha cambiado el disco duro para hacer la intervencion bloqueante
            $id_tipus = (isset($product['id_tipus_inventari']) && $product['id_tipus_inventari'] == 6) ? 1 : 0;

            // Actualizamos la intervención si es necesario
            if ($id_tipus == 1) {
                $interventionModel->modifyIntervention($id, $id_tipus, $descripcio);        
            }

        }

        $product = $inventaryModel->getInventaryById($id_inventary);

        // Comprobamos si se ha cambiado el disco duro para hacer la intervencion bloqueante
        $id_tipus = isset($product['id_tipus_inventari']) ? (($product['id_tipus_inventari'] == 6) ? 1 : 0) : 0;

        //Modificar inventario relacionandolo con la intervencion
        $data = [
            "id" =>  $id_inventari,
            'id_intervencio' => $id,
        ];

        $inventaryModel->modifyInventari($id_inventari, $data);

        $descripcio = $arrInterventions[1][0]->description;

        $interventionModel->modifyIntervention($id, $id_tipus, $descripcio);

        // Recuperar la id del ticket para hacer redirect
        $intervention = $interventionModel->getInterventionById($id);

        return redirect()->to(base_url("tickets/" . $intervention['id_ticket']));
    }

    public function deleteIntervention($id)
    {

        $model = new IntervencioModel();

        $model->deleteTicket($id);

        return redirect()->to(previous_url());
    }
}
