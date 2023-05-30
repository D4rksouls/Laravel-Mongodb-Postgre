<?php

namespace App\Http\Controllers\postgre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postgre\Contratacion;
use Synfony\Component\HttpFoundation\Response;

class ContratacionController extends Controller
{
    private $request;
    public function __construct(Request $Request, Contratacion $objContratacion){
        $this->request = $Request->all();
        $this->objContratacion = $objContratacion;
    }

    public function findById(Request $request) {

    }


    public function getAllContrataciones() {
        $tipo_contratacion =  $this->objContratacion->ListAll();
        return response()->json([
            "data" => $tipo_contratacion,
            "messaje" => "Si guarda"
        ]);
    }

    public function createContratacion(Request $request) {
        
    }

    public function updatedContratacion (Request $request) {
       
    }
}
