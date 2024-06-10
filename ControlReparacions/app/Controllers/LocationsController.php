<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ComarcaModel;
use App\Models\PoblacioModel;

class LocationsController extends BaseController
{
    public function locations($filter = null)
    {
        $searchData = $this->request->getGet();

        if (isset($searchData) && isset($searchData['q'])) {
            $search = $searchData["q"];
        } else {
            $search = "";
        }

        // Get News Data


        if ($filter == null || $filter == 'comarca') {
            $model = new ComarcaModel();
        }else{
            $model = new PoblacioModel();
        }


        if ($search == '') {
            $paginateData = $model->getAllPaged()->paginate(8);
        } else {
            $paginateData = $model->getByTitleOrText($search)->paginate(8);
        }
        

        return view('locations/locations');
    }
}
