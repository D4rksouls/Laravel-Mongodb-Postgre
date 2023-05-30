<?php

namespace App\Models\Postgre;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;


class TipoEmpleados extends Model
{
    use HasFactory;
    protected $table = 'tipos_empleado';


    protected $fillable = [
        'nombre'
    ];

    public function AllTipoEmpleados(){
        return TipoEmpleados::all();
    }

    public function FindById($id) {
        $query = "SELECT * FROM tipos_empleado WHERE nombre = "."'".$id."'";
        return DB::select($query);
    }

    public function CreateTipoEmpleados ($request) {
        TipoEmpleados::insert($request->all());
    }

    public function UpdatedTipoEmpleados ($request) {
        TipoEmpleados::where('nombre',$request['actual'])->update(['nombre' => $request['nuevo']]);
    }

    public function deleteTipoEmpleados ($id) {
        TipoEmpleados::where('nombre',$id)->delete();
    }
}