<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',40)->unique();
            $table->string('descripcion',120)->nullable();
            $table->boolean('condicion')->default(1);
        });
        DB::table('roles')->insert(array(
                'id'=>1,
                'nombre'=>'Administrador',
                'descripcion'=>'Administrador de area'
                ));
        DB::table('roles')->insert(array(
                'id'=>2,
                'nombre'=>'Vendedor',
                'descripcion'=>'Vendedor área de ventas'
                ));
        DB::table('roles')->insert(array(
                    'id'=>3,
                    'nombre'=>'Almacenero',
                    'descripcion'=>'Almacenero área de compras'
                    ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
