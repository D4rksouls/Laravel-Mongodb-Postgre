<?php

namespace App\Http\Controllers\mongodb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MongoDB;
use Synfony\Component\HttpFoundation\Response;

class MongodbController extends Controller
{
    private $trama;
    public function __construct(Request $Request){
        $this->trama = $Request->all();
    }

    public function mongo() {
        MongoDB::insert(
            [
                'api' => 'valor prueba',
                'otro' => 'prueba'
            ]
        );

        return response()->json(["messaje" => "Si guarda"]);
    }
}
