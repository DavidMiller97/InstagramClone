<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Imagen extends Model
{
    use HasFactory;

    //Indicar el nombre de la tabla que modificara el modelo
    protected $table = 'imagenes';
    //Relacion de uno a muchos
    public function comentarios(){

        return $this->hasMany(Comentario::class);
    }

    public function likes(){

        return $this->hasMany(Like::class);
    }

    //Relacion de muchos a uno
    public function user(){

        return $this->belongsTo(User::class);
    }
}
