<?php

namespace App\Http\Controllers\postgre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postgre\Departamentos;
use App\Models\Postgre\Paises;
use Synfony\Component\HttpFoundation\Response;

class DepartamentosController extends Controller
{
    private $request;
    public function __construct(Request $Request, Departamentos $objDepartamentos, Paises $objPaises){
        $this->request = $Request->all();
        $this->objDepartamentos = $objDepartamentos;
        $this->objPaises = $objPaises;
    }

    public function findById() {
        $dpto =  $this->objDepartamentos->FindById($this->request['id']);

        $Message = !empty($dpto) ? 'Registro Listado Correctamente' : 'No se encontro un Registro';
        return response()->json([
            "data" => $dpto,
            "messaje" => $Message
        ]);
    }


    public function getAllDepartamentos() {
        $dptos =  $this->objDepartamentos->AllDepartamentos();
        $Message = !empty($dptos) ? 'departamentos Listadas Correctamente' : 'No se encontraron dptos';
        return response()->json([
            "data" => $dptos,
            "messaje" => $Message
        ]);
    }

    public function createDepartamento() {
        $response = [
            'status' => true,
            'messaje' => 'El departamento fue creado Exitosamente'
        ];

        try {
            $dpto = empty($this->objDepartamentos->FindById($this->request['codigo']));
            $pais = !empty($this->objPaises->FindById($this->request['cod_pais']));
            if ($dpto && $pais) {
                $this->objDepartamentos->CreateDepartamentos($this->request);
            } else {
                $mensaje = !$pais ? 'No existe el pais': 'Ya existe un Departamento con ese codigo';
                
                $response = [
                    'status' => true,
                    'messaje' => $mensaje
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Crear el departamento'
            ];
        }

        return $response;
    }

    public function updatedDepartamento () {
        $response = [
            'status' => true,
            'messaje' => 'El departamento fue actualizado Correctamente'
        ];

        try {
            $dpto = !empty($this->objDepartamentos->FindById($this->request['cod']));
            $pais = !empty($this->objPaises->FindById($this->request['pais']));
            
            if ($dpto && $pais) {
                $this->objDepartamentos->UpdatedDepartamentos($this->request);
            } else {
                $mensaje = !$dpto ? 'No existe el departamento' : 'No existe un pais con ese codigo';
                $response = [
                    'status' => true,
                    'messaje' => $mensaje
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Actualizar el departamento'
            ];
        }

        return $response;
    }

    public function deleteDepartamento () {
        $response = [
            'status' => true,
            'messaje' => 'El departamento fue eliminado Correctamente'
        ];

        try {
            if (!empty($this->objDepartamentos->FindById($this->request['cod']))) {
                $this->objDepartamentos->deleteDepartamentos($this->request['cod']);
            } else {
                $response = [
                    'status' => true,
                    'messaje' => 'No existe un departamento con ese codigo'
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No es posible Eliminar el departamento'
            ];
        }

        return $response;
    }
}
