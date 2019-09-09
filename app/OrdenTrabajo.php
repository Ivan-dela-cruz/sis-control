<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
    protected $table = 'orden_trabajos';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_cli');
    }
}
