<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //funcion para identificar y determinar el tipo de usuario

    public function is_admin()
    {
        //0 es para los administradores

        if ($this->tipo_p == 0) {
            return 0;

            // 1 es para los tecnicos
        } elseif ($this->tipo_p == 1) {
            return 1;
        } else {

            //3 para los clientes
            return 3;
        }

    }

    public function tecnico()
    {
        return $this->hasOne(Tecnico::class, 'id');
    }
    public function equipo()
    {
        return $this->hasMany(Equipo::class, 'id_p');
    }
    public function orden()
    {
        return $this->hasMany(OrdenTrabajo::class, 'id_cli');
    }
}
