<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // resetea el cache el los roles y permisos
        app()['cache']->forget('spatie.permission.cache');

        /// crea los permisos para el crud del usuario
        ///
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'read user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        /// crea los permisos para el crud del equipo

        Permission::create(['name' => 'create equipo']);
        Permission::create(['name' => 'read equipo']);
        Permission::create(['name' => 'update equipo']);
        Permission::create(['name' => 'delete equipo']);

        /// crea los permisos para el crud de la orden

        Permission::create(['name' => 'create orden']);
        Permission::create(['name' => 'read orden']);
        Permission::create(['name' => 'update orden']);
        Permission::create(['name' => 'delete orden']);

        /// crea los permisos para el crud de los registros
        Permission::create(['name' => 'create registros']);
        Permission::create(['name' => 'read registros']);
        Permission::create(['name' => 'update registros']);
        Permission::create(['name' => 'delete registros']);

        //permisos para los clientes
        Permission::create(['name' => 'create tecnico']);
        Permission::create(['name' => 'read tecnico']);
        Permission::create(['name' => 'update tecnico']);
        Permission::create(['name' => 'delete tecnico']);

        //permisos para los tecnicos

        Permission::create(['name' => 'create cliente']);
        Permission::create(['name' => 'read cliente']);
        Permission::create(['name' => 'update cliente']);
        Permission::create(['name' => 'delete cliente']);


        /// cramos los roles para que son admin, tecnico1, tecnico 2, clinete
        $role = Role::create(['name' => 'admin']);

        //asignacion de los permisos al rol admin
        $role->givePermissionTo(Permission::all());


        ///<<<<----------- ROL TECNICO SECUNDARIO PERMISOS ----->>>>
        $role = Role::create(['name' => 'secundario']);
        //asignacion de los permisos al rol TECNICO SECUNDARIO
        $role->givePermissionTo('read user');

        $role->givePermissionTo('create equipo');
        $role->givePermissionTo('read equipo');
        $role->givePermissionTo('update equipo');

        $role->givePermissionTo('create orden');
        $role->givePermissionTo('read orden');

        $role->givePermissionTo('create registros');
        $role->givePermissionTo('read registros');

        $role->givePermissionTo('create cliente');
        $role->givePermissionTo('read cliente');

        $role->givePermissionTo('read tecnico');
        $role->givePermissionTo('update tecnico');

///<<<<----------- ROL TECNICO PRINCIPAL PERMISOS ----->>>>
        $role = Role::create(['name' => 'principal']);

        //asignacion de los permisos al rol admin

        $role->givePermissionTo('read user');

        $role->givePermissionTo('read equipo');

        $role->givePermissionTo('read orden');
        $role->givePermissionTo('update orden');

        $role->givePermissionTo('read registros');
        $role->givePermissionTo('update registros');


        $role->givePermissionTo('read tecnico');
        $role->givePermissionTo('update tecnico');

        $role->givePermissionTo('read cliente');

///<<<<----------- ROL CLIENTE PERMISOS ----->>>>
        $role = Role::create(['name' => 'cliente']);

        $role->givePermissionTo('read user');

        $role->givePermissionTo('read equipo');

        $role->givePermissionTo('read orden');

        $role->givePermissionTo('read registros');

        $role->givePermissionTo('read tecnico');

        $role->givePermissionTo('read cliente');
        $role->givePermissionTo('update cliente');

    }
}
