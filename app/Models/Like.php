<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';

    //Relacion muchos a uno 
    public function usuario(){

        return $this->belongsTo('App\User', 'id');
    }
    //Relacion muchos a uno 
    public function imagen(){

        return $this->belongsTo('App\Imagen', 'imagen_id');
    }
}
