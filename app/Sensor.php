<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $table = 'sensor';
    protected $fillable = ['sensor','estado','numero_serie','modelo'];
    public $timestamps = false;
}
