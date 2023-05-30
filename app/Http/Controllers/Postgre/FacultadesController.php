<?php

namespace App\Http\Controllers\postgre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postgre\Facultades;
use Synfony\Component\HttpFoundation\Response;

class FacultadesController extends Controller
{
    private $request;
    public function __construct(Request $Request, Facultades $objFacultades){
        $this->request = $Request->all();
        $this->objFacultades = $objFacultades;
    }

    public function findById(Request $request) {

    }


    public function getAllFacultades() {

    }

    public function createFacultad(Request $request) {
        
    }

    public function updatedFacultad (Request $request) {
       
    }
}
