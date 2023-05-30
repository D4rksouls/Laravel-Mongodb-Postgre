<?php

namespace App\Models\Postgre;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;


class Ciudades extends Model
{
    use HasFactory;
    protected $table = 'ciudades';
    protected $primaryKey = 'codigo';

    protected $fillable = [
        'codigo',
        'nombre',
        'cod_dpto'
    ];

    public function AllCiudades(){
        return Ciudades::all();
    }

    public function FindById($id) {
        return Ciudades::find($id);
    }

    public function CreateCiudades ($request) {
      Ciudades::create($request->all());
    }

    public function UpdatedCiudades ($request) {
            $ciudad = Ciudades::find($request['cod']);
            $ciudad->nombre = $request['nom'];
            $ciudad->cod_dpto = $request['dpto'];
            $ciudad->save();
    }

    public function deleteCiudades ($id) {
        Ciudades::find($id)->delete();
    }
}