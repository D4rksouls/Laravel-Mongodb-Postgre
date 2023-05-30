<?php

namespace App\Models\Postgre;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;


class Areas extends Model
{
    use HasFactory;
    protected $table = 'areas';
    protected $primaryKey = 'codigo';

    protected $fillable = [
        'codigo',
        'nombre',
        'facultades_codigo',
        'id_coordinador'
    ];

    public function AllAreas(){
        return Areas::all();
    }

    public function FindById($id) {
        return Areas::find($id);
    }

    public function CreateAreas ($request) {
      Areas::create($request->all());
    }

    public function UpdatedAreas ($request) {
            $sede = Areas::find($request['cod']);
            $sede->nombre = $request['nom'];
            $sede->facultades_codigo = $request['cod_fac'];
            $sede->id_coordinador = $request['coor'];
            $sede->save();
    }

    public function deleteAreas ($id) {
        Areas::find($id)->delete();
    }
}