<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temperatura extends Model
{
    protected $table = 'temperatura';
    protected $fillable = ['temperatura','estado','fecha','label_chart'];
    public $timestamps = false;
}
