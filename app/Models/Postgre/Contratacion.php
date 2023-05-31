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
        $query = "SELECT * FROM tipos_contratacion WHERE nombre = "."'".$id."'";
        return DB::select($query);
    }

    public function CreateContratacion ($request) {
        Contratacion::insert($request->all());
    }

    public function UpdatedContratacion ($request) {
        Contratacion::where('nombre',$request['actual'])->update(['nombre' => $request['nuevo']]);
    }

    public function deleteContratacion ($id) {
        Contratacion::where('nombre',$id)->delete();
    }
       
}