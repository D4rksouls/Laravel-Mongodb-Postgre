<?php

namespace App\Http\Controllers\postgre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postgre\Ciudades;
use Synfony\Component\HttpFoundation\Response;

class CiudadesController extends Controller
{

    private $trama;
    public function __construct(Ciudades $objCiudades){
        $this->objCiudades = $objCiudades;
    }

    public function findById(Request $request) {

    }


    public function getAllCiudades() {

    }

    public function createCiudad(Request $request) {
        
    }

    public function updatedCiudad (Request $request) {
       
    }
}
