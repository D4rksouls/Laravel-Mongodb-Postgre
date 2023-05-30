<?php

namespace App\Models;


use Jenssegers\mongodb\Eloquent\Model as EloquentModel;

class MongoDB extends EloquentModel
{
    protected $connection = 'mongodb';
    protected $collection = 'Eventos';
}
