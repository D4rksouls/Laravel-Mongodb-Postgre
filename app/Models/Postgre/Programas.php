<?php

namespace App\Models\Postgre;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;


class Programas extends Model
{
    use HasFactory;
    protected $table = 'programas';
    protected $primaryKey = 'codigo';

    protected $fillable = [
        'codigo',
        'nombre',
        'area_codigo'
    ];

    public function AllProgramas(){
        return Programas::all();
    }

    public function FindById($id) {
        return Programas::find($id);
    }

    public function CreateProgramas ($request) {
      Programas::create($request->all());
    }

    public function UpdatedProgramas ($request) {
            $programa = Programas::find($request['cod']);
            $programa->nombre = $request['nom'];
            $programa->area_codigo = $request['area'];
            $programa->save();
    }

    public function deleteProgramas ($id) {
        Programas::find($id)->delete();
    }

    public function getPostgre($name){
        return Programas::select(
        'programas.codigo',
        'programas.nombre',
        'areas.nombre as area'
        )
        ->leftjoin('areas','programas.area_codigo', '=','areas.codigo')
        ->where('programas.nombre', $name)
        ->get()
        ->toArray();
    }
}