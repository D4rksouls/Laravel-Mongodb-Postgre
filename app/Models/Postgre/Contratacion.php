<?php

namespace App\Models\Postgre;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Contratacion extends Model
{
    use HasFactory;
    protected $table = 'tipos_contratacion';

    protected $fillable = [
        'nombre'
    ];

    public function AllContratacion(){
        return Contratacion::all();
    }

    public function FindById($id) {
        return Contratacion::find($id);
    }

    public function CreateContratacion ($request) {
      Contratacion::create($request->all());
    }

    public function UpdatedContratacion ($contr) {
            Contratacion::where('nombre', $contr['actual'])->update(['nombre' => $contr['nuevo']]);
            // que actualice las tablas en donde esta por ese valor
    }

    public function deleteContratacion ($id) {
        Contratacion::find($id)->delete();
    }
       
}