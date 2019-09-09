<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroEquipo extends Model
{
    protected $table = 'registro_equipos';

    // funcion para relacionar el registro con el equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_e');
    }
}
