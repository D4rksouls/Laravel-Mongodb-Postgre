<?php

namespace App\Http\Controllers\postgre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postgre\Ciudades;
use Synfony\Component\HttpFoundation\Response;
use App\Models\Postgre\Departamentos;

class CiudadesController extends Controller
{

    public function __construct(Ciudades $objCiudades, Departamentos $objDepartamentos){
        $this->objCiudades = $objCiudades;
        $this->objDepartamentos = $objDepartamentos;
    }

    public function findById(Request $request) {
        $Ciudad =  $this->objCiudades->FindById($request['id']);

        $Message = !empty($Ciudad) ? 'Registro Listado Correctamente' : 'No se encontro un Registro';
        return response()->json([
            "data" => $Ciudad,
            "messaje" => $Message
        ]);
    }


    public function getAllCiudades() {
        $Ciudad =  $this->objCiudades->AllCiudades();
        $Message = !empty($Ciudad) ? 'Ciudades Listadas Correctamente' : 'No se encontraron Ciudades';
        return response()->json([
            "data" => $Ciudad,
            "messaje" => $Message
        ]);
    }

    public function createCiudad(Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'La Ciudad fue creada Exitosamente'
        ];

        try {
            $ciudad = empty($this->objCiudades->FindById($request['codigo']));
            $departamento = empty($this->objDepartamentos->FindById($request['cod_dpto']));
            if ($ciudad && !$departamento) {
                $this->objCiudades->CreateCiudades($request);
            } else {
                $mensaje = !$ciudad ? 'Ya existe una Ciudad con ese codigo' : 'No existe el Departamento';
                
                $response = [
                    'status' => true,
                    'messaje' => $mensaje
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Crear la Ciudad'
            ];
        }

        return $response;
    }

    public function updatedCiudad (Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'La Ciudad fue actualizada Correctamente'
        ];

        try {
            $ciudad = !empty($this->objCiudades->FindById($request['cod']));
            $departamento = !empty($this->objDepartamentos->FindById($request['dpto']));
            
            if ($ciudad && $departamento) {
                $this->objCiudades->UpdatedCiudades($request);
            } else {
                $mensaje = !$ciudad ? 'No existe la ciudad' : 'No existe una departamento con ese codigo';
                $response = [
                    'status' => true,
                    'messaje' => $mensaje
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Actualizar la ciudad'
            ];
        }

        return $response;
    }

    public function deleteCiudad (Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'La ciudad fue eliminada Correctamente'
        ];

        try {
            if (!empty($this->objCiudades->FindById($request['cod']))) {
                $this->objCiudades->deleteCiudades($request['cod']);
            } else {
                $response = [
                    'status' => true,
                    'messaje' => 'No existe una ciudad con ese codigo'
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No es posible Eliminar la ciudad'
            ];
        }

        return $response;
    }
}
