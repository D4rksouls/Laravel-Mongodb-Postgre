<?php

namespace App\Http\Controllers\postgre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postgre\Areas;
use Synfony\Component\HttpFoundation\Response;
use App\Models\Postgre\Facultades;
use App\Models\Postgre\Empleados;

class AreasController extends Controller
{

    public function __construct(Areas $objAreas, Empleados $objEmpleados, Facultades $objFacultades){
        $this->objAreas      = $objAreas;
        $this->objEmpleados  = $objEmpleados;
        $this->objFacultades = $objFacultades;
    }

    public function findById(Request $request) {
        $Area =  $this->objAreas->FindById($request['id']);

        $Message = !empty($Area) ? 'Registro Listado Correctamente' : 'No se encontro un Registro';
        return response()->json([
            "data" => $Area,
            "messaje" => $Message
        ]);
    }


    public function getAllAreas() {
        $Areas =  $this->objAreas->AllAreas();
        $Message = !empty($Areas) ? 'Areas Listadas Correctamente' : 'No se encontraron Areas';
        return response()->json([
            "data" => $Areas,
            "messaje" => $Message
        ]);
    }

    public function createArea(Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'El area fue creada Exitosamente'
        ];

        try {
            $empleado = !empty($this->objEmpleados->FindById($request['id_coordinador']));
            $facultad = !empty($this->objFacultades->FindById($request['facultades_codigo']));
            $area     = empty($this->objAreas->FindById($request['codigo']));
            if ($empleado && $facultad && $area) {
                $this->objAreas->CreateAreas($request);
            } else {

                if (!$area) {
                    $mensaje = 'Ya existe el area que desea crear';
                } else {
                    $mensaje = !$facultad ? 'No existe la facultad': 'No existe el coordinador';
                }
                
                $response = [
                    'status' => true,
                    'messaje' => $mensaje
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Crear el area'
            ];
        }

        return $response;
    }

    public function updatedArea (Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'El area fue actualizada Correctamente'
        ];

        try {
            $empleado = !empty($this->objEmpleados->FindById($request['coor']));
            $facultad = !empty($this->objFacultades->FindById($request['cod_fac']));
            $area     = !empty($this->objAreas->FindById($request['cod']));
            
            if ($empleado && $facultad && $area) {
                $this->objAreas->UpdatedAreas($request);
            } else {
                $mensaje = !$facultad ? 'No existe la facultad': 'No existe el coordinador';
                $response = [
                    'status' => true,
                    'messaje' => $mensaje
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Actualizar la sede'
            ];
        }

        return $response;
    }

    
    public function deleteArea (Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'La Area fue eliminada Correctamente'
        ];

        try {
            if (!empty($this->objAreas->FindById($request['cod']))) {
                $this->objAreas->deleteAreas($request['cod']);
            } else {
                $response = [
                    'status' => true,
                    'messaje' => 'No existe una Area con ese codigo'
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No es posible eliminar el Area'
            ];
        }

        return $response;
    }
}
