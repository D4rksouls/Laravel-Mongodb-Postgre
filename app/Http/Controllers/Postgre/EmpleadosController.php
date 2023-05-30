<?php

namespace App\Http\Controllers\postgre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postgre\Empleados;
use Synfony\Component\HttpFoundation\Response;

class EmpleadosController extends Controller
{
    private $request;
    public function __construct(Request $Request, Empleados $objEmpleados){
        $this->request = $Request->all();
        $this->objEmpleados = $objEmpleados;
    }

    public function findById(Request $request) {

    }


    public function getAllEmpleados() {

    }

    public function createEmpleado(Request $request) {
        
    }

    public function updatedEmpleado (Request $request) {
       
    }
}
