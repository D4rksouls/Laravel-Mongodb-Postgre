<?php

namespace App\Http\Controllers\postgre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postgre\Empleados;
use App\Models\Postgre\Ciudades;
use App\Models\Postgre\Sedes;
use App\Models\Postgre\Facultades;
use App\Models\Postgre\TipoEmpleados;
use App\Models\Postgre\Contratacion;
use Synfony\Component\HttpFoundation\Response;

class EmpleadosController extends Controller
{
    public function __construct( Empleados $objEmpleados, Ciudades $objCiudad,
    Sedes $objSedes, Facultades $objFacultades, TipoEmpleados $objTipoEmpleados,
    Contratacion $objContratacion){
        $this->objEmpleados = $objEmpleados;
        $this->objCiudad = $objCiudad;
        $this->objSedes = $objSedes;
        $this->objFacultades = $objFacultades;
        $this->objTipoEmpleados = $objTipoEmpleados;
        $this->objContratacion = $objContratacion;
    }

    public function findById(Request $request) {
        $empleado =  $this->objEmpleados->FindById($request['id']);

        $Message = !empty($empleado) ? 'Registro Listado Correctamente' : 'No se encontro un Registro';
        return response()->json([
            "data" => $empleado,
            "messaje" => $Message
        ]);
    }


    public function getAllEmpleados() {
        $empleado =  $this->objEmpleados->AllEmpleados();
        $Message = !empty($empleado) ? 'Empleados Listadas Correctamente' : 'No se encontraron Empleados';
        return response()->json([
            "data" => $empleado,
            "messaje" => $Message
        ]);
    }

    public function createEmpleado(Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'El empleado fue creada Exitosamente'
        ];

        try {
            $empleado = empty($this->objEmpleados->FindById($request['identificacion']));
            $ciudad = !empty($this->objCiudad->FindById($request['lugar_nacimiento']));
            $sede = !empty($this->objSedes->FindById($request['codigo_sede']));
            $facultad = !empty($this->objFacultades->FindById($request['cod_facultad']));
            $tipoEmpleado = !empty($this->objTipoEmpleados->FindById($request['tipo_empleado']));
            $contratacion = !empty($this->objContratacion->FindById($request['tipo_contratacion']));
           


            if ($empleado && $ciudad && 
                $sede && $facultad && 
                $tipoEmpleado && $contratacion) {
                $this->objEmpleados->CreateEmpleados($request);
            } else {
                if (!$empleado) {
                    $mensaje = 'Ya existe un empleado con ese codigo';
                } else if (!$ciudad) {
                    $mensaje = 'No existe un lugar de nacimiento con ese codigo';
                } else if (!$sede) {
                    $mensaje = 'No existe una sede con ese codigo';
                } else if (!$facultad) {
                    $mensaje = 'No existe una facultad con ese codigo';
                } else if (!$tipoEmpleado) {
                    $mensaje = 'No existe un tipo de empleado con ese codigo';
                } else {
                    $mensaje = 'No existe un tipo de contratacion con ese codigo';
                }

                $response = [
                    'status' => true,
                    'messaje' => $mensaje
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Crear el empleado'
            ];
        }

        return $response;
    }

    public function updatedEmpleado (Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'El empleado fue actualizada Correctamente'
        ];

        try {
            $empleado = !empty($this->objEmpleados->FindById($request['ide']));
            $ciudad = !empty($this->objCiudad->FindById($request['nac']));
            $sede = !empty($this->objSedes->FindById($request['sed']));
            $facultad = !empty($this->objFacultades->FindById($request['fac']));
            $tipoEmpleado = !empty($this->objTipoEmpleados->FindById($request['empl']));
            $contratacion = !empty($this->objContratacion->FindById($request['contr']));
           
            if ($empleado && $ciudad && 
                $sede && $facultad && 
                $tipoEmpleado && $contratacion) {
                $this->objEmpleados->UpdatedEmpleados($request);
            } else {
                if (!$empleado) {
                    $mensaje = 'No existe un empleado con ese codigo';
                } else if (!$ciudad) {
                    $mensaje = 'No existe un lugar de nacimiento con ese codigo';
                } else if (!$sede) {
                    $mensaje = 'No existe una sede con ese codigo';
                } else if (!$facultad) {
                    $mensaje = 'No existe una facultad con ese codigo';
                } else if (!$tipoEmpleado) {
                    $mensaje = 'No existe un tipo de empleado con ese codigo';
                } else {
                    $mensaje = 'No existe un tipo de contratacion con ese codigo';
                }
                $response = [
                    'status' => true,
                    'messaje' => $mensaje
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Actualizar el empleado'
            ];
        }

        return $response;
    }

    public function deleteEmpleado (Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'El empleado fue eliminado Correctamente'
        ];

        try {
            if (!empty($this->objEmpleados->FindById($request['cod']))) {
                $this->objEmpleados->deleteEmpleados($request['cod']);
            } else {
                $response = [
                    'status' => true,
                    'messaje' => 'No existe un empleado con ese codigo'
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No es posible Eliminar el empleado'
            ];
        }

        return $response;
    }
}
