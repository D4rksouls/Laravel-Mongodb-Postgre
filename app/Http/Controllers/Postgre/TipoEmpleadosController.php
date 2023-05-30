<?php

namespace App\Http\Controllers\postgre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postgre\TipoEmpleados;
use Synfony\Component\HttpFoundation\Response;

class TipoEmpleadosController extends Controller
{
    private $request;
    public function __construct(TipoEmpleados $objTipoEmpleados){
        $this->objTipoEmpleados = $objTipoEmpleados;
    }

    public function findById(Request $request) {
        $Tipo =  $this->objTipoEmpleados->FindById($request['id']);

        $Message = !empty($Tipo) ? 'Registro Listado Correctamente' : 'No se encontro un Registro';
        return response()->json([
            "data" => $Tipo,
            "messaje" => $Message
        ]);
    }


    public function getAllTipoEmpleados() {
        $Tipos =  $this->objTipoEmpleados->AllTipoEmpleados();
        $Message = !empty($Tipos) ? 'Tipos de Empleados Listados Correctamente' : 'No se encontraron Tipos de Empleados';
        return response()->json([
            "data" => $Tipos,
            "messaje" => $Message
        ]);
    }

    public function createTipoEmpleado(Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'El Tipo de Empleado fue creado Exitosamente'
        ];

        try {
            $Tipo = empty($this->objTipoEmpleados->FindById($request['nombre']));

            if ($Tipo) {
                $request['updated_at'] = now();
                $request['created_at'] = now();
                $this->objTipoEmpleados->CreateTipoEmpleados($request);
            } else {
                
                $response = [
                    'status' => true,
                    'messaje' => 'Ya existe una Tipo de empleado con ese nombre'
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Crear el Tipo de empleado'
            ];
        }

        return $response;
    }

    public function updatedTipoEmpleado (Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'El Tipo de empleado fue actualizada Correctamente'
        ];

        try {
            $Tipo = !empty($this->objTipoEmpleados->FindById($request['actual']));
            $Tipo2 = empty($this->objTipoEmpleados->FindById($request['nuevo']));

            if ($Tipo && $Tipo2) {
                $this->objTipoEmpleados->UpdatedTipoEmpleados($request);
            } else {
                $mensaje = !$Tipo2 ? 'Ya existe un tipo de empleado con el nombre ha actualizar' : 'No existe el Tipo de empleado'; 
                $response = [
                    'status' => true,
                    'messaje' => $mensaje
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Actualizar el Tipo de empleado'
            ];
        }

        return $response;
    }

    public function deleteTipoEmpleado (Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'La Tipo de empleado fue eliminada Correctamente'
        ];

        try {
            if (!empty($this->objTipoEmpleados->FindById($request['cod']))) {
                $this->objTipoEmpleados->deleteTipoEmpleados($request['cod']);
            } else {
                $response = [
                    'status' => true,
                    'messaje' => 'No existe una Tipo de empleado con ese nombre'
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No es posible Eliminar la Tipo de empleado'
            ];
        }

        return $response;
    }
}
