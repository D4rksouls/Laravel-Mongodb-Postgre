<?php

namespace App\Models\Postgre;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;


class Empleados extends Model
{
    use HasFactory;
    protected $table = 'empleados';
    protected $primaryKey = 'identificacion';

    protected $fillable = [
        'identificacion',
        'nombres',
        'apellidos',
        'email',
        'tipo_contratacion',
        'tipo_empleado',
        'cod_facultad',
        'codigo_sede',
        'lugar_nacimiento'
    ];

    public function AllEmpleados(){
        return Empleados::all();
    }

    public function FindById($id) {
        return Empleados::find($id);
    }

    public function CreateEmpleados ($request) {
      Empleados::create($request->all());
    }

    public function UpdatedEmpleados ($request) {
            Empleados::where('identificacion', $request['ide'])->update([
                'identificacion' => $request['ide'],
                'nombres'=> $request['nom'],
                'apellidos'=> $request['ape'],
                'email'=> $request['email'],
                'tipo_contratacion'=> $request['contr'],
                'tipo_empleado'=> $request['empl'],
                'cod_facultad'=> $request['fac'],
                'codigo_sede'=> $request['sed'],
                'lugar_nacimiento'=> $request['nac']
            ]);

    }

    public function deleteEmpleados ($id) {
        Empleados::find($id)->delete();
    }

    public function getPostGre($id) {
        return Empleados::select('identificacion',
                          'nombres',
                          'apellidos',
                          'email',
                          'tipo_contratacion',
                          'facultades.nombre as facultad',
                          'sedes.nombre as Sede',
                          'ciudades.nombre as Ciudad'
                )
                ->leftjoin('facultades','cod_facultad', '=','facultades.codigo')
                ->leftjoin('sedes','codigo_sede', '=','sedes.codigo')
                ->leftjoin('ciudades','lugar_nacimiento', '=','ciudades.codigo')
                ->where('identificacion', $id)->get()->toArray();

    }
}