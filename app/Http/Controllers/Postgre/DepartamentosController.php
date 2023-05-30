<?php

namespace App\Http\Controllers\postgre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postgre\Departamentos;
use Synfony\Component\HttpFoundation\Response;

class DepartamentosController extends Controller
{
    private $request;
    public function __construct(Request $Request, Departamentos $objDepartamentos){
        $this->request = $Request->all();
        $this->objDepartamentos = $objDepartamentos;
    }

    public function findById(Request $request) {

    }


    public function getAllDepartamentos() {

    }

    public function createDepartamento(Request $request) {
        
    }

    public function updatedDepartamento (Request $request) {
       
    }
}
