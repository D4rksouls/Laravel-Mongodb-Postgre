<?php

namespace App\Models;


use Jenssegers\mongodb\Eloquent\Model as EloquentModel;

class MongoDB extends EloquentModel
{
    protected $connection = 'mongodb';
    protected $collection = 'Eventos';

    public function add($JSON_ADD) {
        self::insert(
            $JSON_ADD
        );
    }

    public function showPostgre() {
        // se debe de hacer validacion con postgre
    }

    public function showAll() {
        return self::all();
    }

    public function findbyTitle($titulo) {
        return self::where('titulo', $titulo)->get();
    }

    public function updatedmongo($data) { 
        $title = $data['tituloBuscar'];
        unset($data['tituloBuscar']);
        return self::where('titulo', $title)->update($data);
    }

    public function deletemongo($title) {
        self::where('titulo', $title)->delete();
    }

    public function findbyTitlepostgre($titulo) {
        return self::where('titulo', $titulo)->get()->toArray();
    }
}
