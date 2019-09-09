<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';


    //funcion para relacionar el equipo con el usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'id_p');
    }


    // funcion para relacionr el registro con el equipo
    public function registro()
    {
        return $this->hasMany(RegistroEquipo::class, 'id_e');
    }
}
