<?php

namespace App\Http\Controllers\postgre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postgre\Paises;
use Synfony\Component\HttpFoundation\Response;

class PaisesController extends Controller
{
    private $request;
    public function __construct(Request $Request, Paises $objPaises){
        $this->request = $Request->all();
        $this->objPaises = $objPaises;
    }

    public function findById() {
        $Pais =  $this->objPaises->FindById($this->request['id']);

        $Message = !empty($Pais) ? 'Registro Listado Correctamente' : 'No se encontro un Registro';
        return response()->json([
            "data" => $Pais,
            "messaje" => $Message
        ]);
    }


    public function getAllPaises() {
        $Paises =  $this->objPaises->AllPaises();
        $Message = !empty($Paises) ? 'Paises Listadas Correctamente' : 'No se encontraron Paises';
        return response()->json([
            "data" => $Paises,
            "messaje" => $Message
        ]);
    }

    public function createPais() {
        $response = [
            'status' => true,
            'messaje' => 'El Pais fue creado Exitosamente'
        ];

        try {
            $Pais = empty($this->objPaises->FindById($this->request['codigo']));
            if ($Pais) {
                $this->objPaises->CreatePaises($this->request);
            } else {
                $response = [
                    'status' => true,
                    'messaje' => 'Ya existe una Pais con ese codigo'
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Crear el Pais'
            ];
        }

        return $response;
    }

    public function updatedPais () {
        $response = [
            'status' => true,
            'messaje' => 'El pais fue actualizado Correctamente'
        ];

        try {
            $pais = !empty($this->objPaises->FindById($this->request['cod']));

            if ($pais) {
                $this->objPaises->UpdatedPaises($this->request);
            } else {
       
                $response = [
                    'status' => true,
                    'messaje' => 'No existe el pais'
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Actualizar el pais'
            ];
        }

        return $response;
    }

    public function deletePais () {
        $response = [
            'status' => true,
            'messaje' => 'El pais fue eliminada Correctamente'
        ];

        try {
            if (!empty($this->objPaises->FindById($this->request['cod']))) {
                $this->objPaises->deletePaises($this->request['cod']);
            } else {
                $response = [
                    'status' => true,
                    'messaje' => 'No existe el pais con ese codigo'
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No es posible Eliminar el pais'
            ];
        }

        return $response;
    }
}
