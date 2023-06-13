<?php

namespace App\Http\Controllers\mongodb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MongoDB;
use App\Models\Postgre\Empleados;
use App\Models\Postgre\Facultades;
use App\Models\Postgre\Programas;
use Synfony\Component\HttpFoundation\Response;

class MongodbController extends Controller
{
    private $request;
    public function __construct(Request $Request, MongoDB $objMongodb, Empleados $objEmpleado, Facultades $objFacultad,
    Programas $objProgramas){
        $this->request = $Request->all();
        $this->objMongodb = $objMongodb;
        $this->objEmpleado = $objEmpleado;
        $this->objFacultad = $objFacultad;
        $this->objProgramas = $objProgramas;
    }

    public function mongo()
    {
        $status = true;
        try {

        $exists = $this->objMongodb->findbyTitle($this->request['titulo']);

        if ($exists) {
            $this->objMongodb->add($this->request);
            $Message = 'Evento creado exitosamente';
        } else {
            $Message = 'Ya existe un evento con ese Titulo';
        }

        } catch (\Exception $th) {
            $status = false;
            $Message = 'Ha ocurrido un error al Crear el evento';
        }
        return response()->json([
            "status" => $status,
            "messaje" => $Message
        ]);
    }

    public function show()
    {
        try {
            $events = $this->objMongodb->showAll();

            $Message = !empty($events) ? 'Registros Listados Correctamente' : 'No se encontro un Registro';
        
        } catch (\Exception $th) {
            $Message = 'Ha ocurrido un error al mostrar todos los eventos';
        }
        return response()->json([
            "data" => $events,
            "messaje" => $Message
        ]);
    }

    public function findbyTitle()
    {
        try {
            $events = $this->objMongodb->findbyTitle($this->request['titulo']);

            $Message = !empty($events) ? 'Evento Listado Correctamente' : 'No existe un evento con ese titulo';
        } catch (\Exception $th) {
            $Message = 'Ha ocurrido un error al actualizar el evento';
        }
        return response()->json([
            "data" => $events,
            "messaje" => $Message
        ]);
    }

    public function updated()
    {
        try {
            $exitschange = true;
            $exits = $this->objMongodb->findbyTitle($this->request['tituloBuscar']);
            if ($this->request['tituloBuscar'] != $this->request['titulo']) {
                $exitschange = empty($this->objMongodb->findbyTitle($this->request['titulo']));
            }
            if ($exits && $exitschange) {
                $this->objMongodb->updatedmongo($this->request);
            }
            
            if (!$exitschange){
                $Message = 'Ya existe un evento con el titulo ha actualizar';
            } else {
                $Message = $exits ? 'El evento fue actualizado correctamente' : 'No existe un evento con ese titulo';
            }
         
        } catch (\Exception $th) {
            $Message = 'Ha ocurrido un error al actualizar el evento';
        }
        return response()->json([
            "messaje" => $Message
        ]);


    }

    public function delete()
    {
        try {
            $events = $this->objMongodb->findbyTitle($this->request['titulo']);
            $this->objMongodb->deletemongo($this->request['titulo']);
            $Message = !empty($events) ? 'Evento eliminado Correctamente' : 'No existe un evento con ese titulo';

        } catch (\Exception $th) {
            $Message = 'Ha ocurrido un error al actualizar el evento';
        }
        return response()->json([
            "messaje" => $Message
        ]);
    }


    public function showPostgre() {
         try { 
            $events = $this->objMongodb->findbyTitlepostgre($this->request['titulo']);
            
            //dd($events[0]['asistentes']); 
            if (!empty($events[0]['asistentes'])) {
                $asistentes = [];
                foreach ($events[0]['asistentes'] as $value) {
                    $Empl = $this->objEmpleado->getPostGre($value['identificador']);
                    if (!empty($Empl)) {
                    unset($Empl['updated_at']);
                    unset($Empl['created_at']);
                    $value['postgre'] = $Empl;
                    }

                    array_push($asistentes, $value);
                }
                $events[0]['asistentes'] = $asistentes;
             }
            if (!empty($events[0]['facultades_organizadoras'])) {
                $facultades = [];
                foreach ($events[0]['facultades_organizadoras'] as $value) {
                    
                    $facul = $this->objFacultad->getPostgre($value);
                    if (!empty($facul)) {
                    $Empl = $this->objEmpleado->getPostGre($facul[0]['id_decano']);
                    unset($facul[0]['id_decano']);
                    unset($Empl['updated_at']);
                    unset($Empl['created_at']); 
                    $value = $facul[0];
                    $value['decano'] = $Empl[0];
                    } 

                    array_push($facultades, $value);
                }
                $events[0]['facultades_organizadoras'] = $facultades; 
            }

            if (!empty($events[0]['programa'])) {
                    $pro = $this->objProgramas->getPostgre($events[0]['programa']);
                    if (!empty($pro)) {
                        $events[0]['programa'] = $pro[0]; 
                    }
            }

            if ($events[0]['conferencistas']) {
                $conferencistas = [];
                foreach ($events[0]['conferencistas'] as $value) {
                    $Empl = $this->objEmpleado->getPostGre($value['identificador']);
                    if (!empty($Empl)) {
                    unset($Empl['updated_at']);
                    unset($Empl['created_at']);
                    $value['postgre'] = $Empl;
                    }

                    array_push($conferencistas, $value);
                }
                $events[0]['conferencistas'] = $conferencistas;
            }
            

             $Message = !empty($events) ? 'Evento Listado Correctamente' : 'No existe un evento con ese titulo';
        } catch (\Exception $th) {
            $Message = 'Ha ocurrido un error al actualizar el evento';
        }
        return response()->json([
            "data" => $events,
            "messaje" => $Message
        ]);
 
    }
    
}
