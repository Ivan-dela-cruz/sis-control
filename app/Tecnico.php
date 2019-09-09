<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{

    protected $table = 'tecnicos';


    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

}
