<?php

namespace App\Http\Controllers\postgre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postgre\Sedes;
use App\Models\Postgre\Ciudades;
use Synfony\Component\HttpFoundation\Response;

class SedesController extends Controller
{

    private $trama;
    public function __construct(Sedes $objSedes, Ciudades $objCiudad){
        $this->objSedes = $objSedes;
        $this->objCiudad = $objCiudad;
    }

    public function findById(Request $request) {
        $Sede =  $this->objSedes->FindById($request['id']);

        $Message = !empty($Sede) ? 'Registro Listado Correctamente' : 'No se encontro un Registro';
        return response()->json([
            "data" => $Sede,
            "messaje" => $Message
        ]);
    }


    public function getAllSedes() {
        $Sedes =  $this->objSedes->AllSedes();
        $Message = !empty($Sedes) ? 'Sedes Listadas Correctamente' : 'No se encontraron sedes';
        return response()->json([
            "data" => $Sedes,
            "messaje" => $Message
        ]);
    }

    public function createSede(Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'La sede fue creada Exitosamente'
        ];

        try {
            $sede = empty($this->objSedes->FindById($request['codigo']));
            $ciudad = !empty($this->objCiudad->FindById($request['cod_ciudad']));
            if ($sede && $ciudad) {
                $this->objSedes->CreateSedes($request);
            } else {
                $mensaje = !$ciudad ? 'No existe la ciudad': 'Ya existe una Sede con ese codigo';
                
                $response = [
                    'status' => true,
                    'messaje' => $mensaje
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Crear la sede'
            ];
        }

        return $response;
    }

    public function updatedSede (Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'La sede fue actualizada Correctamente'
        ];

        try {
            $sede = !empty($this->objSedes->FindById($request['cod']));
            $ciudad = !empty($this->objCiudad->FindById($request['ciu']));
            
            if ($sede && $ciudad) {
                $this->objSedes->UpdatedSedes($request);
            } else {
                $mensaje = !$sede ? 'No existe la sede' : 'No existe una Ciudad con ese codigo';
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


    public function deleteSede (Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'La sede fue eliminada Correctamente'
        ];

        try {
            if (!empty($this->objSedes->FindById($request['cod']))) {
                $this->objSedes->deleteSedes($request['cod']);
            } else {
                $response = [
                    'status' => true,
                    'messaje' => 'No existe una Sede con ese codigo'
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No es posible Eliminar la sede'
            ];
        }

        return $response;
    }
}
