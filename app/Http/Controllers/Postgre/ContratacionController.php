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
        $Tipo =  $this->objContratacion->FindById($request['id']);

        $Message = !empty($Tipo) ? 'Registro Listado Correctamente' : 'No se encontro un Registro';
        return response()->json([
            "data" => $Tipo,
            "messaje" => $Message
        ]);
    }


    public function getAllContrataciones() {
        $Tipos =  $this->objContratacion->AllContratacion();
        $Message = !empty($Tipos) ? 'Tipos de Contrataciones Listados Correctamente' : 'No se encontraron Tipos de Contrataciones';
        return response()->json([
            "data" => $Tipos,
            "messaje" => $Message
        ]);
    }

    public function createContratacion(Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'El Tipo de Contratacion fue creado Exitosamente'
        ];

        try {
            $Tipo = empty($this->objContratacion->FindById($request['nombre']));

            if ($Tipo) {
                $request['updated_at'] = now();
                $request['created_at'] = now();
                $this->objContratacion->CreateContratacion($request);
            } else {
                
                $response = [
                    'status' => true,
                    'messaje' => 'Ya existe una Tipo de Contratacion con ese nombre'
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Crear el Tipo de Contratacion'
            ];
        }

        return $response;
    }

    public function updatedContratacion (Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'El Tipo de Contratacion fue actualizada Correctamente'
        ];

        try {
            $Tipo = !empty($this->objContratacion->FindById($request['actual']));
            $Tipo2 = empty($this->objContratacion->FindById($request['nuevo']));

            if ($Tipo && $Tipo2) {
                $this->objContratacion->UpdatedContratacion($request);
            } else {
                $mensaje = !$Tipo2 ? 'Ya existe un tipo de Contratacion con el nombre ha actualizar' : 'No existe el Tipo de Contratacion'; 
                $response = [
                    'status' => true,
                    'messaje' => $mensaje
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Actualizar el Tipo de Contratacion'
            ];
        }

        return $response;
    }

    public function deleteTipoContratacion (Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'La Tipo de Contratacion fue eliminada Correctamente'
        ];

        try {
            if (!empty($this->objContratacion->FindById($request['cod']))) {
                $this->objContratacion->deleteContratacion($request['cod']);
            } else {
                $response = [
                    'status' => true,
                    'messaje' => 'No existe una Tipo de Contratacion con ese nombre'
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No es posible Eliminar la Tipo de Contratacion'
            ];
        }

        return $response;
    }
}
