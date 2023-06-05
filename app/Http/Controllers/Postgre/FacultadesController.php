<?php

namespace App\Http\Controllers\postgre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postgre\Facultades;
use App\Models\Postgre\Empleados;
use Synfony\Component\HttpFoundation\Response;

class FacultadesController extends Controller
{
    private $request;
    public function __construct(Request $Request, Facultades $objFacultades, Empleados $objEmpleados){
        $this->request = $Request->all();
        $this->objFacultades = $objFacultades;
        $this->objEmpleados = $objEmpleados;
    }

    public function findById() {
        $facultad =  $this->objFacultades->FindById($this->request['id']);

        $Message = !empty($facultad) ? 'Registro Listado Correctamente' : 'No se encontro un Registro';
        return response()->json([
            "data" => $facultad,
            "messaje" => $Message
        ]);
    }


    public function getAllFacultades() {
        $facultad =  $this->objFacultades->AllFacultades();
        $Message = !empty($facultad) ? 'Facultades Listadas Correctamente' : 'No se encontraron Facultades';
        return response()->json([
            "data" => $facultad,
            "messaje" => $Message
        ]);
    }

    public function createFacultad() {
        $response = [
            'status' => true,
            'messaje' => 'La facultad fue creada Exitosamente'
        ];

        try {
            $facultad = empty($this->objFacultades->FindById($this->request['codigo']));
            $empleado = !empty( $this->objEmpleados->FindById($this->request['id_decano']));
            if ($facultad && $empleado) {
                $this->objFacultades->CreateFacultades($this->request);
            } else {
                $mensaje = !$empleado ? 'No existe el decano': 'Ya existe una facultad con ese codigo';
                
                $response = [
                    'status' => true,
                    'messaje' => $mensaje
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Crear la facultad'
            ];
        }

        return $response;
    }

    public function updatedFacultad (Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'la facultad fue actualizada Correctamente'
        ];

        try {
            $facultad = !empty($this->objFacultades->FindById($this->request['cod']));
            $empleado = !empty($this->objEmpleados->FindById($this->request['dec']));
            
            if ($facultad && $empleado) {
                $this->objFacultades->UpdatedFacultades($this->request);
            } else {
                $mensaje = !$facultad ? 'No existe la facultad' : 'No existe una Ciudad con ese codigo';
                $response = [
                    'status' => true,
                    'messaje' => $mensaje
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Actualizar la facultad'
            ];
        }

        return $response;
    }

    public function deleteFacultad () {
        $response = [
            'status' => true,
            'messaje' => 'la facultad fue eliminada Correctamente'
        ];

        try {
            if (!empty($this->objFacultades->FindById($this->request['cod']))) {
                $this->objFacultades->deleteFacultades($this->request['cod']);
            } else {
                $response = [
                    'status' => true,
                    'messaje' => 'No existe una facultad con ese codigo'
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No es posible Eliminar la facultad'
            ];
        }

        return $response;
    }
}
