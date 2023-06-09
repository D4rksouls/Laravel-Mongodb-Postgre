<?php

namespace App\Models\Postgre;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;


class Facultades extends Model
{
    use HasFactory;
    protected $table = 'facultades';
    protected $primaryKey = 'codigo';

    protected $fillable = [
        'codigo',
        'nombre',
        'ubicacion',
        'nro_telefono',
        'id_decano'
    ];

    public function AllFacultades(){
        return Facultades::all();
    }

    public function FindById($id) {
        return Facultades::find($id);
    }

    public function CreateFacultades ($request) {
        Facultades::create($request);
    }

    public function UpdatedFacultades ($request) {// probar si da con el codigo fuera del fillable
        $facultad = Facultades::find($request['cod']);
        $facultad->nombre = $request['nom'];
        $facultad->ubicacion = $request['ubi'];
        $facultad->nro_telefono = $request['tel'];
        $facultad->id_decano = $request['dec'];
        $facultad->save();
    }

    public function deleteFacultades ($id) {
        Facultades::find($id)->delete();
    }

    public function getPostgre($title) {
        return Facultades::select(
        'codigo',
        'nombre',
        'ubicacion',
        'nro_telefono',
        'id_decano'
        )
        ->where('nombre',$title)
        ->get()
        ->toArray();

    }
}