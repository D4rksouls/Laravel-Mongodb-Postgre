<?php

namespace App\Http\Controllers\postgre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postgre\Programas;
use App\Models\Postgre\Areas;
use Synfony\Component\HttpFoundation\Response;

class ProgramasController extends Controller
{
    private $request;
    public function __construct(Programas $objProgramas, Areas $objAreas){
        $this->objProgramas = $objProgramas;
        $this->objAreas = $objAreas;
    }

    public function findById(Request $request) {
        $programa =  $this->objProgramas->FindById($request['id']);

        $Message = !empty($programa) ? 'Registro Listado Correctamente' : 'No se encontro un Registro';
        return response()->json([
            "data" => $programa,
            "messaje" => $Message
        ]);
    }


    public function getAllProgramas() {
        $programas =  $this->objProgramas->Allprogramas();
        $Message = !empty($programas) ? 'programas Listadas Correctamente' : 'No se encontraron programas';
        return response()->json([
            "data" => $programas,
            "messaje" => $Message
        ]);
    }

    public function createPrograma(Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'El programa fue creada Exitosamente'
        ];

        try {
            $programa = empty($this->objProgramas->FindById($request['codigo']));
            $area = !empty( $this->objAreas->FindById($request['area_codigo']));
            if ($programa && $area) {
                $this->objProgramas->CreateProgramas($request);
            } else {
                $mensaje = !$programa ? 'Ya existe un programa con ese codigo' : 'No existe el area';
                $response = [
                    'status' => true,
                    'messaje' => $mensaje
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Crear el programa'
            ];
        }

        return $response;
    }

    public function updatedPrograma (Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'El programa fue actualizada Correctamente'
        ];

        try {
            $programa = !empty($this->objProgramas->FindById($request['cod']));
            $area = !empty( $this->objAreas->FindById($request['area']));
            if ($programa && $area) {
                $this->objProgramas->UpdatedProgramas($request);
            } else {
                $mensaje = !$programa ? 'No existe un programa con ese codigo' : 'No existe el area';
                $response = [
                    'status' => true,
                    'messaje' => $mensaje
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No fue posible Actualizar el programa'
            ];
        }

        return $response;
    }

    public function deletePrograma (Request $request) {
        $response = [
            'status' => true,
            'messaje' => 'El programa fue eliminada Correctamente'
        ];

        try {
            if (!empty($this->objProgramas->FindById($request['cod']))) {
                $this->objProgramas->deleteProgramas($request['cod']);
            } else {
                $response = [
                    'status' => true,
                    'messaje' => 'No existe un programa con ese codigo'
                ];
            }
        } catch (\Exception $th) {
            $response = [
                'status' => false,
                'messaje' => 'No es posible Eliminar el programa'
            ];
        }

        return $response;
    }
}
