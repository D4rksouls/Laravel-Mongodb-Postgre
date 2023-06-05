<?php

namespace App\Models\Postgre;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;


class Departamentos extends Model
{
    use HasFactory;
    protected $table = 'departamentos';
    protected $primaryKey = 'codigo';

    protected $fillable = [
        'codigo',
        'nombre',
        'cod_pais'
    ];

    public function AllDepartamentos(){
        return Departamentos::all();
    }

    public function FindById($id) {
        return Departamentos::find($id);
    }

    public function CreateDepartamentos ($request) {
      Departamentos::create($request);
    }

    public function UpdatedDepartamentos ($request) {
            $Departamento = Departamentos::find($request['cod']);
            $Departamento->nombre = $request['nom'];
            $Departamento->cod_pais = $request['pais'];
            $Departamento->save();
    }

    public function deleteDepartamentos ($id) {
        Departamentos::find($id)->delete();
    }
}