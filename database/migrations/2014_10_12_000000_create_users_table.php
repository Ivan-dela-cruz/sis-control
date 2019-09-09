<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula_p', 12)->unique();
            $table->string('nombre_p');
            $table->string('apellido_p')->nullable();
            $table->string('telefono_p', 20)->nullable();
            $table->string('direccion_p')->nullable();
            $table->integer('tipo_p');
            $table->boolean('estado_p')->default(true);
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->rememberToken();
            $table->timestamps();
        });
        $user_password = Hash::make('root1234');
        DB::table('users')->insert(array('id' => '1',
            'cedula_p' => '1750474012',
            'nombre_p' => 'admin',
            'apellido_p' => 'admin',
            'telefono_p' => '0985247455',
            'direccion_p' => 's/n',
            'tipo_p' => '0',
            'name' => 'admin',
            'email' => 'admin@gamil.com',
            'password' => $user_password));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
