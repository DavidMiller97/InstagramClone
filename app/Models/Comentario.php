<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';
    protected $primaryKey = 'comentario_id';
    
    //Relacion muchos a uno 
    public function user(){

        return $this->belongsTo(User::class);
    }
    //Relacion muchos a uno 
    public function imagen(){

        return $this->belongsTo(Imagen::class, 'imagen_id', 'imagen_id');
    }
}
