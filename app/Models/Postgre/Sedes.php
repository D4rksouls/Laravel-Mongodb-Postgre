<?php

namespace App\Models\Postgre;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;


class Sedes extends Model
{
    use HasFactory;
    protected $table = 'sedes';
    protected $primaryKey = 'codigo';

    protected $fillable = [
        'codigo',
        'nombre',
        'cod_ciudad'
    ];

    public function AllSedes(){
        return Sedes::all();
    }

    public function FindById($id) {
        return Sedes::find($id);
    }

    public function CreateSedes ($request) {
        Sedes::create($request->all());
    }

    public function UpdatedSedes ($request) {
        $sede = Sedes::find($request['cod']);
        $sede->nombre = $request['nom'];
        $sede->cod_ciudad = $request['ciu'];
        $sede->save();
    }

    public function deleteSedes ($id) {
        Sedes::find($id)->delete();
    }

}