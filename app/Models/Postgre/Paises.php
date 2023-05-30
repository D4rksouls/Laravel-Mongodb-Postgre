<?php

namespace App\Models\Postgre;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;


class Paises extends Model
{
    use HasFactory;
    protected $table = 'paises';
    protected $primaryKey = 'codigo';

    protected $fillable = [
        'codigo',
        'nombre'
    ];

    public function AllPaises(){
        return Paises::all();
    }

    public function FindById($id) {
        return Paises::find($id);
    }

    public function CreatePaises ($request) {
      Paises::create($request);
    }

    public function UpdatedPaises ($request) {
        $pais = Paises::find($request['cod']);
        $pais->nombre = $request['nom'];
        $pais->save();
    }

    public function deletePaises ($id) {
        Paises::find($id)->delete();
    }
}